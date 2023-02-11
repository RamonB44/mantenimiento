<?php

namespace Database\Seeders;

use App\Models\FechaDePedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FechaDePedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FechaDePedido::create([
            'fecha_de_apertura' => '2023-02-06',
            'fecha_de_cierre' => '2023-02-11',
            'fecha_de_pedido' => '2023-02-13',
            'fecha_de_llegada' => '2023-05-01',
        ]);
    }
}
