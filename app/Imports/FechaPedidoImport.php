<?php

namespace App\Imports;

use App\Models\FechaDePedido;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithGroupedHeadingRow;
use Maatwebsite\Excel\Row;

class FechaPedidoImport implements OnEachRow,WithGroupedHeadingRow
{
    public function onRow(Row $row)
    {
        //Campos: fecha_de_apertura, fecha_de_cierre, fecha_de_pedido, fecha_de_llegada, fecha_de_
        FechaDePedido::create([
            'fecha_de_apertura' => $row['fecha_de_apertura'],
            'fecha_de_cierre' => $row['fecha_de_cierre'],
            'fecha_de_pedido' => $row['fecha_de_pedido'],
            'fecha_de_llegada' => $row['fecha_de_llegada'],
        ]);
    }
}
