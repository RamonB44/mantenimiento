<?php

namespace App\Imports;

use App\Models\Articulo;
use App\Models\UnidadDeMedida;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ArticulosImport implements OnEachRow,WithHeadingRow
{
    public function onRow(Row $row)
    {
        $unidad_de_medida = UnidadDeMedida::firstOrCreate(
            [
                'unidad_de_medida' => $row['unidad_de_medida'],
            ],
            [
                'abreviacion' => $row['unidad_de_medida'],
            ]
        );

        Articulo::firstOrCreate(
            [
                'codigo' => $row['codigo'],
            ],
            [
                'articulo' => $row['descripcion'],
                'unidad_de_medida_id' => $unidad_de_medida->id,
                'precio_estimado' => $row['precio'],
                'tipo' => 'FUNGIBLE',
                'tiempo_de_vida' => $row['vencimiento'] == "" ? 0 : $row['vencimiento'],
            ]
        );

    }
}
