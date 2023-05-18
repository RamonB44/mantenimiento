<?php

namespace App\Imports;


use App\Models\Tarea;
use App\Models\Articulo;
use App\Models\ArticuloParaTarea;
use App\Models\ComponentePorImplemento;
use App\Models\ComponentePorModelo;
use App\Models\Epp;
use App\Models\EppPorRiesgo;
use App\Models\FrecuenciaMantenimiento;
use App\Models\Implemento;
use App\Models\PiezaPorModelo;
use App\Models\Riesgo;
use App\Models\Sede;
use App\Models\Sistema;
use App\Models\TareaPorRiesgo;
use App\Models\UnidadDeMedida;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ComponentesImport implements OnEachRow,WithHeadingRow
{
    public function onRow(Row $row)
    {

        Sede::firstOrCreate(['sede'=> $row['sede']],[
            'sede' => $row['sede'],
        ]);

        $sistemaRecord = Sistema::firstOrCreate(['sistema' => $row['sistema']],[
            'sistema' => $row['sistema'],
        ]);

        $unidadRecord = UnidadDeMedida::firstOrCreate(['unidad_de_medida' => $row["unidad_de_medida"]],[
            'unidad_de_medida' => $row["unidad_de_medida"],
        ]);

        $componenteRecord = Articulo::firstOrCreate(['codigo' => $row["codigo_componente"]], [
            'articulo' => $row['componente'],
            'unidad_de_medida_id' => $unidadRecord->id,
            'precio_estimado' =>  isset($row["precio_estimado"]) ? $row['precio_estimado'] : 0.00,
            'tipo' => 2, // 1 => FUNGIBLE, 2 => COMPONENTE, 3 => PIEZA, 4 => HERRAMIENTA
            'esta_activo' => true,
        ]);


        $piezaRecord = Articulo::firstOrCreate(['codigo' => $row["codigo_pieza"]], [
            'articulo' => $row['pieza'],
            'unidad_de_medida_id' => $unidadRecord->id,
            'precio_estimado' =>  isset($row["precio_estimado"]) ? $row['precio_estimado'] : 0.00,
            'tipo' => 3, // 1 => FUNGIBLE, 2 => COMPONENTE, 3 => PIEZA, 4 => HERRAMIENTA
            'esta_activo' => true,
        ]);

        $tareaRecord = Tarea::firstOrCreate(['tarea' => $row['tarea']],[
            'tarea' => $row['tarea'],
            'articulo_id' => $componenteRecord->id, // COMPONENTE
            'tipo'=> $row['tipo_mantenimiento'],
            'tiempo_estimado' => $row["tiempo_estimado"]
        ]);

        ArticuloParaTarea::firstOrCreate(['articulo_id' => $piezaRecord->id, 'tarea_id' => $tareaRecord->id],[
            'articulo_id' => $piezaRecord->id, // PIEZA, HERRAMIENTA, FUNGIBLES
            'tarea_id' => $tareaRecord->id,
            'cantidad' => $row["cantidad"]
        ]);

        $eppRecord = Epp::firstOrCreate(['epp'=> $row["epp"]], [
            'epp'=> $row["epp"]
        ]);

        $riesgoRecord = Riesgo::firstOrCreate(['riesgo' => $row['riesgo']],[
            'riesgo' => $row["riesgo"]
        ]);

        TareaPorRiesgo::firstOrCreate(['tarea_id' => $tareaRecord->id],[
            'tarea_id' => $tareaRecord->id,
            'riesgo_id' => $riesgoRecord->id
        ]);

        EppPorRiesgo::firstOrCreate(['epp_id' => $eppRecord->id, 'riesgo_id' => $riesgoRecord->id],[
            'epp_id' => $eppRecord->id,
            'riesgo_id' => $riesgoRecord->id
        ]);

        // X COMPONENTE
        FrecuenciaMantenimiento::firstOrCreate(['articulo_id'=> $componenteRecord->id],[
            'articulo_id'=> $componenteRecord->id,
            'frecuencia' => isset($row['frecuencia_horas_componente']) ? $row['frecuencia_horas_componente'] : null,
            'tiempo_de_vida' => isset($row['tiempo_vida_componente']) ? $row['tiempo_vida_componente'] : null,
        ]);
        // X PIEZA
        FrecuenciaMantenimiento::firstOrCreate(['articulo_id'=> $piezaRecord->id],[
            'articulo_id'=> $piezaRecord->id,
            'frecuencia' => isset($row['tiempo_vida_pieza']) ? $row['tiempo_vida_pieza'] : null,
            'tiempo_de_vida' => isset($row['tiempo_vida_pieza']) ? $row['tiempo_vida_pieza'] : null,
        ]);


        $implementoRecord = Implemento::whereHas('ModeloDelImplemento', function($query) use ($row) {
            $query->where('modelo_de_implemento', explode('#',$row["implemento"])[0]);
        })->where('numero', explode('#',$row["implemento"])[1])->first();

        ComponentePorModelo::firstOrCreate(['articulo_id'=> $componenteRecord->id,'modelo_id'=> $implementoRecord->modelo_del_implemento_id],[
            'articulo_id'=> $componenteRecord->id,
            'modelo_id'=> $implementoRecord->modelo_del_implemento_id,
            'sistema_id'=> $sistemaRecord->id,
        ]);

        // EN DEPURACION
        PiezaPorModelo::firstOrCreate(["pieza" => $piezaRecord->id],[
            'pieza' => $piezaRecord->id,
            'articulo_id' => $componenteRecord->id,
        ]);

        ComponentePorImplemento::firstOrCreate(['articulo_id'=> $componenteRecord->id , 'implemento_id' => $implementoRecord->id],[
            'horas' => 0,
            'estado' => 1,
        ]);


        // $piezaxModelo = PiezaPorModelo::firstOrCreate([''])

        // ComponentePorImplemento::firstOrCreate();
    }
}
