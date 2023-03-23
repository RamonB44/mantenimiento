<?php

namespace App\Http\Livewire\Jefe\ProgramacionCultivo;

use App\Models\Sede;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class Base extends Component
{
    public $sede_id;
    public $sedes;
    public $fecha;
    public $turno;
    public $supervisor_id;
    public $cultivo_fundo_id;

    public $colors;

    public function mount(){
        $this->sede_id = 0;
        $this->sedes = Sede::select('id','sede')->get();
        $this->supervisor_id = 0;
        $this->cultivo_fundo_id = '0,0';
        $this->fecha = date('Y-m-d');
        $this->turno = "MAÑANA";
        $this->colors = [
            'PROGRAMADO' => '#008000',
            'NO PROGRAMADO' => '#808080',
        ];
    }

    public function updatingSedeId(){
        if($this->sede_id == 0){
            $this->fecha = date('Y-m-d');
            $this->turno = "MAÑANA";
        }
    }

    public function updatedSedeId(){
        $this->supervisor_id = 0;
        $this->cultivo_fundo_id = "0,0";
    }

    public function updatedSupervisorId(){
        $this->cultivo_fundo_id = "0,0";
    }

    public function render()
    {
        $pieChartModel = [];
        $supervisores = [];
        $cultivo_fundos = [];
        $tractores_por_cultivo = [];

        if($this->sede_id > 0 && $this->fecha != "" && $this->turno != ""){
            $supervisores = User::whereHas('roles',function($q){
                $q->where('name','supervisor');
            })->select('id','name')->where('sede_id',$this->sede_id)->get();

            $tractores_no_programados = DB::table('tractors')
            ->select(DB::raw("COUNT(*) as cantidad"),DB::raw("'NO PROGRAMADO' as estado"))
            ->whereNotExists(function ($query) {
                $query->from('programacion_de_tractors')
                    ->select('*')
                    ->where('programacion_de_tractors.tractor_id',DB::raw('tractors.id'))
                    ->where('programacion_de_tractors.fecha',$this->fecha)
                    ->where('turno',$this->turno)
                    ->where('esta_anulado',0);
	    })->whereNotNull('cultivo_id')
	    ->where('sede_id',$this->sede_id);

            $tractores_programados = DB::table('tractors')
            ->select(DB::raw("COUNT(*) as cantidad"),DB::raw("'PROGRAMADO' as estado"))
            ->whereExists(function ($query) {
                $query->from('programacion_de_tractors')
                    ->select('*')
                    ->where('programacion_de_tractors.sede_id',$this->sede_id)
                    ->where('programacion_de_tractors.tractor_id',DB::raw('tractors.id'))
                    ->where('programacion_de_tractors.fecha',$this->fecha)
                    ->where('turno',$this->turno)
                    ->where('esta_anulado',0);
	    })->whereNotNull('cultivo_id')
	    ->where('sede_id',$this->sede_id);
	    $filtrar_por_supervisor = $this->supervisor_id > 0 ? " AND tt.supervisor = ".$this->supervisor_id : "";
            if($this->cultivo_fundo_id == '0,0'){
                $tractores_por_cultivo = DB::table('tractors')
                    ->select('tractors.supervisor','tractors.cultivo_id','tractors.fundo_id','cultivos.cultivo', 'fundos.fundo', DB::raw("COUNT(*) as tractors"), DB::raw("(SELECT COUNT(*) FROM programacion_de_tractors pt INNER JOIN tractors tt ON tt.id = pt.tractor_id WHERE pt.esta_anulado = 0 AND tt.sede_id = ".$this->sede_id." AND tt.cultivo_id = tractors.cultivo_id AND COALESCE(tt.fundo_id,0) = COALESCE(tractors.fundo_id,0) AND pt.fecha = '".$this->fecha."' AND pt.turno = '".$this->turno."'".$filtrar_por_supervisor.") as programado"))
                    ->join('cultivos','cultivos.id','tractors.cultivo_id')
		    ->leftJoin('fundos','fundos.id','tractors.fundo_id')
	    	    ->where('tractors.sede_id',$this->sede_id);
            }

            if($this->supervisor_id > 0){
                $cultivo_fundos = DB::table('tractors')
                ->select('cultivos.id as cultivo_id','cultivos.cultivo','fundos.id as fundo_id','fundos.fundo')
                ->leftJoin('fundos','fundos.id','tractors.fundo_id')
                ->join('cultivos','cultivos.id','tractors.cultivo_id')
                ->where('tractors.sede_id',$this->sede_id)
                ->whereNotNull('tractors.cultivo_id')
                ->where('tractors.supervisor',$this->supervisor_id)
                ->groupBy('tractors.cultivo_id','tractors.fundo_id')
                ->get();

                $tractores_no_programados = $tractores_no_programados->where('supervisor',$this->supervisor_id);
                $tractores_programados = $tractores_programados->where('supervisor',$this->supervisor_id);

                $cultivo_fundo = explode(",",$this->cultivo_fundo_id);

                if($cultivo_fundo[0] > 0){
                    $tractores_no_programados = $tractores_no_programados->where('cultivo_id',$cultivo_fundo[0]);
                    $tractores_programados = $tractores_programados->where('cultivo_id',$cultivo_fundo[0]);
                    if ($cultivo_fundo[1] > 0) {
                        $tractores_no_programados = $tractores_no_programados->where('fundo_id',$cultivo_fundo[1]);
                        $tractores_programados = $tractores_programados->where('fundo_id',$cultivo_fundo[1]);
                    }else{
                        $tractores_no_programados = $tractores_no_programados->whereNull('fundo_id');
                        $tractores_programados = $tractores_programados->whereNull('fundo_id');
                    }
                }
                if($this->cultivo_fundo_id == '0,0'){
                    $tractores_por_cultivo = $tractores_por_cultivo->where('tractors.supervisor',$this->supervisor_id);
                }
            }

            $tractores_totales = $tractores_no_programados->union($tractores_programados)->get();

            if($this->cultivo_fundo_id == '0,0'){
                $tractores_por_cultivo = $tractores_por_cultivo
                ->groupBy('tractors.cultivo_id','tractors.fundo_id')
                ->get();
            }

            $pieChartModel = $tractores_totales
                ->reduce(function ($pieChartModel, $data) {
                    $type = $data->estado;
                    $value = $data->cantidad;

                    return $pieChartModel->addSlice($type, $value, $this->colors[$type]);
                }, LivewireCharts::pieChartModel()
                    ->setTitle('Resumen de Tractores')
                    ->setAnimated(true)
                    ->setType('donut')
                    //->withOnSliceClickEvent('onSliceClick')
                    //->withoutLegend()
                    ->legendPositionTop()
                    ->legendHorizontallyAlignedCenter()
                    ->withDataLabels()
                    ->setColors($this->colors)
                );
        }

        return view('livewire.jefe.programacion-cultivo.base',compact('pieChartModel','supervisores','cultivo_fundos','tractores_por_cultivo'));
    }
}
