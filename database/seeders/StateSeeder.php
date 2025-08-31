<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Pando', 'country_id' => 1],
            ['name' => 'Beni', 'country_id' => 1],
            ['name' => 'Santa Cruz', 'country_id' => 1],
            ['name' => 'Cochabamba', 'country_id' => 1],
            ['name' => 'Chuquisaca', 'country_id' => 1],
            ['name' => 'Tarija', 'country_id' => 1],
            ['name' => 'La Paz', 'country_id' => 1],
            ['name' => 'Oruro', 'country_id' => 1],
            ['name' => 'Potosí', 'country_id' => 1],
        ];

        DB::table('states')->insert($states);
    }
}
