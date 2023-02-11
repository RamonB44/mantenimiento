<?php

namespace Database\Seeders;

use App\Models\DetalleMontoCeco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleMontoCecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetalleMontoCeco::create([
            'centro_de_costo_id' => 1,
            'monto' => 2500,
            'fecha_de_asignacion' => '2023-01-01'
        ]);
        DetalleMontoCeco::create([
            'centro_de_costo_id' => 1,
            'monto' => 3000,
            'fecha_de_asignacion' => '2023-02-01'
        ]);
        DetalleMontoCeco::create([
            'centro_de_costo_id' => 1,
            'monto' => 3000,
            'fecha_de_asignacion' => '2023-03-01'
        ]);
        DetalleMontoCeco::create([
            'centro_de_costo_id' => 2,
            'monto' => 3000,
            'fecha_de_asignacion' => '2023-01-01'
        ]);
        DetalleMontoCeco::create([
            'centro_de_costo_id' => 2,
            'monto' => 4000,
            'fecha_de_asignacion' => '2023-02-01'
        ]);
        DetalleMontoCeco::create([
            'centro_de_costo_id' => 2,
            'monto' => 4000,
            'fecha_de_asignacion' => '2023-03-01'
        ]);
    }
}
