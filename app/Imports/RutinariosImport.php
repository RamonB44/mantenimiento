<?php

namespace App\Imports;

use App\Models\Articulo;
use App\Models\ComponentePorModelo;
use App\Models\ModeloDelImplemento;
use App\Models\Sistema;
use App\Models\Tarea;
use App\Models\UnidadDeMedida;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class RutinariosImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        //Campos: sistema,modelo_del_implemento, codigo, componente, unidad_de_medida, tarea
        $sistema = Sistema::firstOrCreate([
            'sistema' => strtoupper($row['sistema'])
        ]);

        $modelo_del_implemento = ModeloDelImplemento::firstOrCreate([
            'modelo' => strtoupper($row['modelo_del_implemento'])
        ]);

        $unidad_de_medida = UnidadDeMedida::firstOrCreate([
            'unidad_de_medida' => strtoupper($row['unidad_de_medida'])
        ]);

        $articulo = Articulo::firstOrCreate(
            [
                'codigo' => $row['codigo'],
            ],
            [
                'articulo' => strtoupper($row['componente']),
                'unidad_de_medida_id' => $unidad_de_medida->id,
                'precio_estimado' => 0,
                'tipo' => 'COMPONENTE',
            ]
        );


        ComponentePorModelo::firstOrCreate([
            'articulo_id' => $articulo->id,
            'modelo_id' => $modelo_del_implemento->id,
            'sistema_id' => $sistema->id
        ]);

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
