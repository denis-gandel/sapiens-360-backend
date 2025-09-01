<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // Pando
            ['name' => 'Cobija', 'state_id' => 1],
            ['name' => 'El Sena', 'state_id' => 1],
            ['name' => 'Porvenir', 'state_id' => 1],

            // Beni
            ['name' => 'Trinidad', 'state_id' => 2],
            ['name' => 'Riberalta', 'state_id' => 2],
            ['name' => 'Guayaramerín', 'state_id' => 2],

            // Santa Cruz
            ['name' => 'Santa Cruz de la Sierra', 'state_id' => 3],
            ['name' => 'Montero', 'state_id' => 3],
            ['name' => 'Warnes', 'state_id' => 3],

            // Cochabamba
            ['name' => 'Cochabamba', 'state_id' => 4],
            ['name' => 'Quillacollo', 'state_id' => 4],
            ['name' => 'Sacaba', 'state_id' => 4],

            // Chuquisaca
            ['name' => 'Sucre', 'state_id' => 5],
            ['name' => 'Yotala', 'state_id' => 5],
            ['name' => 'Zudáñez', 'state_id' => 5],

            // Tarija
            ['name' => 'Tarija', 'state_id' => 6],
            ['name' => 'Entre Ríos', 'state_id' => 6],
            ['name' => 'Villamontes', 'state_id' => 6],

            // La Paz
            ['name' => 'La Paz', 'state_id' => 7],
            ['name' => 'El Alto', 'state_id' => 7],
            ['name' => 'Viacha', 'state_id' => 7],

            // Oruro
            ['name' => 'Oruro', 'state_id' => 8],
            ['name' => 'Caracollo', 'state_id' => 8],
            ['name' => 'Huanuni', 'state_id' => 8],

            // Potosi
            ['name' => 'Potosí', 'state_id' => 9],
            ['name' => 'Uyuni', 'state_id' => 9],
            ['name' => 'Tupiza', 'state_id' => 9],
        ];

        DB::table('cities')->insert($cities);
    }
}
