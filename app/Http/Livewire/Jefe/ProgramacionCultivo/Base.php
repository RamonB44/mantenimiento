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

    protected $listeners = [
        'onSliceClick' => 'handleOnSliceClick',
    ];

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

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function render()
    {
        $pieChartModel = [];
        $supervisores = [];
        $cultivo_fundos = [];

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
                    ->where('turno',$this->turno);
            });

            $tractores_programados = DB::table('tractors')
            ->select(DB::raw("COUNT(*) as cantidad"),DB::raw("'PROGRAMADO' as estado"))
            ->whereExists(function ($query) {
                $query->from('programacion_de_tractors')
                    ->select('*')
                    ->where('programacion_de_tractors.sede_id',$this->sede_id)
                    ->where('programacion_de_tractors.tractor_id',DB::raw('tractors.id'))
                    ->where('programacion_de_tractors.fecha',$this->fecha)
                    ->where('turno',$this->turno);
            });

            if($this->supervisor_id > 0){
                $cultivo_fundos = DB::table('tractors')
                ->select('fundos.id as fundo_id', 'fundos.fundo', 'cultivos.id as cultivo_id', 'cultivos.cultivo')
                ->join('fundos','fundos.id','tractors.fundo_id')
                ->join('cultivos','cultivos.id','tractors.cultivo_id')
                ->where('tractors.sede_id',$this->sede_id)
                ->where('tractors.supervisor',$this->supervisor_id)
                ->groupBy('tractors.fundo_id','tractors.cultivo_id')
                ->get();

                $tractores_no_programados = $tractores_no_programados->where('supervisor',$this->supervisor_id);
                $tractores_programados = $tractores_programados->where('supervisor',$this->supervisor_id);

                $cultivo_fundo = explode(",",$this->cultivo_fundo_id);

                if($cultivo_fundo[0] > 0 && $cultivo_fundo[1] > 0){
                    $tractores_no_programados = $tractores_no_programados->where('cultivo_id',$cultivo_fundo[0]);
                    $tractores_programados = $tractores_programados->where('cultivo_id',$cultivo_fundo[0]);
                }
            }

            $tractores_totales = $tractores_no_programados->union($tractores_programados)->get();

            $pieChartModel = $tractores_totales
                ->reduce(function ($pieChartModel, $data) {
                    $type = $data->estado;
                    $value = $data->cantidad;

                    return $pieChartModel->addSlice($type, $value, $this->colors[$type]);
                }, LivewireCharts::pieChartModel()
                    ->setTitle('Resumen de Tractores')
                    ->setAnimated(true)
                    ->setType('donut')
                    ->withOnSliceClickEvent('onSliceClick')
                    //->withoutLegend()
                    ->legendPositionLeft()
                    ->legendHorizontallyAlignedCenter()
                    ->withDataLabels()
                    ->setColors($this->colors)
                );
        }


        $this->emit('scroll_bottom');


        return view('livewire.jefe.programacion-cultivo.base',compact('pieChartModel','supervisores','cultivo_fundos'));
    }
}
