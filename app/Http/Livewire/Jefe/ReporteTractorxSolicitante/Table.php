<?php

namespace App\Http\Livewire\Jefe\ReporteTractorxSolicitante;

use App\Models\Tractor;
use Carbon\Carbon;
use DateTimeZone;
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

    public function renderBarChart($start, $end, $sede, $solicitante)
    {
        $fecha1 = Carbon::parse($start);
        $fecha2 = Carbon::parse($end);
        $diff = $fecha1->diff($fecha2);
        $qry = "";
        $this->labels = array();
        $this->data = [];
        $this->netoData = [];

        $tractor = Tractor::all();

        foreach ($tractor as $key => $value) {
            # code...
            // $label["label"][0][$key] = $value->description;
            $this->tag[$key] = $value->description;
            $this->hidden[$key] = /*!in_array($value->id,$this->config['treg']);*/ false;
            $qry .= "case modelo_de_implemento_id when " . $value->id . " then 1 else 0 end as " . $value->description . ",";
            $this->netoData[$value->id] = 0;
        }
        $qry .= 'date(fecha) as created_at';

        $data = DB::table('resumen_de_programacion_de_tractores')
            ->whereBetween(DB::raw('UNIX_TIMESTAMP(DATE_FORMAT(fecha, "%Y-%m-%d %H:%i"))'), [strtotime($fecha1->format('Y-m-d H:i')), strtotime($fecha2->addHours(23)->addMinutes(59)->format('Y-m-d H:i'))])
            ->where('sede_id', $sede)
            ->where('solicitante_id', $solicitante)
            ->select(
                DB::raw($qry),
            )
            ->orderBy(DB::raw('date(fecha)', 'desc'))->get()->toArray();

        //to array
        $day = "";
        $week = "";
        $month = "";
        //add here if new value is register
        $contador = 0;
        $bool = true;

        if ($diff->days > 0 and $diff->days < 7) {
            //semana ordenado por dias L,MA,MI,J,V,S,D
            foreach ($data as $key => $value) {
                // $dataTime = DateTime::createFromFormat('Y-m-d H:i:s', $date->created_at);
                $dataTime = Carbon::createFromFormat('Y-m-d H:i:s', $value["fecha"], new DateTimeZone('America/Lima'));

                if ($bool) {
                    $this->labels[$contador] = $dataTime->translatedFormat('l/d');
                    $day = $dataTime->format('D');
                    $bool = false;
                }

                if ($day == $dataTime->format('D')) { //25[] | 27[]

                    foreach ($tractor as $u => $p) {
                        # code...
                        $this->data[$u][$contador] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                        // $newData["hidden"][0] = !in_array(1,$this->config);
                        $this->netoData[$p->id] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                    }
                    //ok 25 [0]
                } else {
                    //ok 27[1]

                    $contador++;

                    $day = $dataTime->format('D');

                    $this->labels[$contador] = $dataTime->translatedFormat('l/d');

                    foreach ($tractor as $u => $p) {
                        # code...
                        $this->data[$p->id] = 0;
                        $this->data["data"][$u][$contador] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                        // $newData["hidden"][0] = !in_array(1,$this->config);
                        $this->netoData[$p->id] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                    }
                }
            }
        } elseif ($diff->days > 7 and $diff->days < 31) {
            //mes ordenado por semanas W1,W2,W3,W4
            foreach ($data as $key => $value) {
                // $dataTime = DateTime::createFromFormat('Y-m-d H:i:s', $date->created_at);
                $dataTime = Carbon::createFromFormat('Y-m-d H:i:s', $value["fecha"], new DateTimeZone('America/Lima'));

                if ($bool) {
                    $this->labels[$contador] = "Semana N°" . $dataTime->format('W');
                    $week = $dataTime->format('W');
                    $bool = false;
                }

                if ($week == $dataTime->format('W')) { //05 - 04

                    foreach ($tractor as $u => $p) {
                        # code...
                        $this->data[$u][$contador] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                        // $newData["hidden"][0] = !in_array(1,$this->config);
                        $this->netoData[$p->id] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                    }
                } else {
                    $contador++;

                    $week = $dataTime->format('W');

                    $this->labels[$contador] = "Semana N°" . $dataTime->format('W');

                    foreach ($tractor as $u => $p) {
                        # code...
                        $this->data[$u][$contador] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                        // $newData["hidden"][0] = !in_array(1,$this->config);
                        $this->netoData[$p->id] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                    }
                }
            }
        } elseif ($diff->days > 31 and $diff->days < 365) {
            //año ordenado por meses E,F,MAR,AB,MAY,JUN,JUL,AGO,SEP,OCTU,NOVI,DICI
            foreach ($data as $key => $value) {
                // $dataTime = DateTime::createFromFormat('Y-m-d H:i:s', $date->created_at);
                $dataTime = Carbon::createFromFormat('Y-m-d H:i:s', $value["fecha"], new DateTimeZone('America/Lima'));

                if ($bool) {
                    $this->labels[$contador] = "Mes :" . $dataTime->translatedFormat('M');
                    $month = $dataTime->format('M');
                    $bool = false;
                }

                if ($month == $dataTime->format('M')) { //05 - 04

                    foreach ($tractor as $u => $p) {
                        # code...
                        $this->data[$u][$contador] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                        // $newData["hidden"][0] = !in_array(1,$this->config);
                        $this->netoData[$p->id] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                    }
                } else {
                    $contador++;

                    $month = $dataTime->format('M');

                    $this->labels[$contador] = "Mes: " . $dataTime->translatedFormat('M');

                    foreach ($tractor as $u => $p) {
                        # code...
                        $this->data[$u][$contador] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                        // $newData["hidden"][0] = !in_array(1,$this->config);
                        $this->netoData[$p->id] = (float) $this->netoData[$p->id] + (float) $value[$p["description"]];
                    }
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.jefe.reporte-tractorx-solicitante.table');
    }
}
