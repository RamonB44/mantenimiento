<?php

namespace App\Http\Livewire\Jefe\ReporteTractorxSolicitante;

use App\Models\ModeloDelImplemento;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Table extends Component
{
    public $data = [];
    public $labels = [];
    public $hidden = [];
    public $tag = [];
    public $netoData = [];

    protected $listeners = [
        'renderBarChart',
    ];

    public function renderBarChart($start, $end)
    {
        $fecha1 = Carbon::parse($start);
        $fecha2 = Carbon::parse($end);
        $diff = $fecha1->diff($fecha2);
        $qry = "";
        $this->labels = array();
        $this->data = [];
        $this->netoData = [];

        $modelo_del_implemento = ModeloDelImplemento::all();

        foreach ($modelo_del_implemento as $key => $value) {
            # code...
            // $label["label"][0][$key] = $value->description;
            $this->tag[$key] = $value->description;
            $this->hidden[$key] = /*!in_array($value->id,$this->config['treg']);*/ false;
            $qry .= "case modelo_de_implemento_id when ".$value->id." then 1 else 0 end as ".$value->description.",";
            $this->netoData[$value->id] = 0;
        }
        $qry .= 'date(fecha) as created_at';

        /*$data = DB::table('vista_reporte_de_implementosxhoras')
        ->whereHas('employes',function($query) use ($area){
            $query->whereHas('funcion',function($query1) use ($area){
                $query1->whereIn('id_area',$area);
            });
        })->whereBetween(DB::raw('UNIX_TIMESTAMP(DATE_FORMAT(created_at, "%Y-%m-%d %H:%i"))'), [strtotime($fecha1->format('Y-m-d H:i')), strtotime($fecha2->addHours(23)->addMinutes(59)->format('Y-m-d H:i'))])
        ->whereIn('id_aux_treg',$tregistro)
        ->whereIn('sede_id',$sede)
        ->select(
                    DB::raw($qry),
                )
        ->orderBy(DB::raw('date(created_at)', 'desc'))->get()->toArray();*/
    }

    public function render()
    {
        return view('livewire.jefe.reporte-tractorx-solicitante.table');
    }
}
