<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $natures = [
            ['name' => 'Publico/Gubernamental'],
            ['name' => 'Privado/Particular'],
            ['name' => 'Convenio'],
        ];

        DB::table('natures')->insert($natures);
    }
}
