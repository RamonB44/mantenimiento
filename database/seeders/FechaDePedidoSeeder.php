<?php

namespace Database\Seeders;

use App\Models\FechaDePedido;
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
            'fecha_de_apertura' => '2023-02-28',
            'fecha_de_cierre' => '2023-03-01',
            'fecha_de_pedido' => '2023-03-02',
            'fecha_de_llegada' => '2023-05-01',
        ]);
    }
}
