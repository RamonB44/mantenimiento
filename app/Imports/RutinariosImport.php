<?php

namespace App\Imports;

use App\Models\Articulo;
use App\Models\Tarea;
use App\Models\UnidadDeMedida;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class RutinariosImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        //Campos: codigo, componente, unidad_de_medida, tiempo_de_vida, tarea
        $unidad_de_medida = UnidadDeMedida::firstOrCreate(
            [
                'unidad_de_medida' => $row['unidad_de_medida'],
            ],
            [
                'abreviacion' => $row['unidad_de_medida'],
            ]
        );

        $articulo = Articulo::firstOrCreate(
            [
                'codigo' => $row['codigo'],
            ],
            [
                'articulo' => $row['componente'],
                'unidad_de_medida_id' => $unidad_de_medida->id,
                'precio_estimado' => 0,
                'tipo' => 'COMPONENTE',
                'tiempo_de_vida' => $row['tiempo_de_vida'] == "" ? 0 : $row['tiempo_de_vida'],
            ]
        );

        Tarea::firstOrCreate(
            [
                'tarea' => $row['tarea'],
                'articulo_id' => $articulo->id,
                'tipo' => 'RUTINARIO',
            ],
            [
                'tiempo_estimado' => 0,
            ]
        );
    }
}
