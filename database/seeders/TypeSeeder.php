<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Universidad'],
            ['name' => 'Colegio/Unidad Educativa'],
            ['name' => 'Instituto Técnico'],
            ['name' => 'Centro de Formación Profesional'],
            ['name' => 'Instituto Alternativo'],
            ['name' => 'Instituto de Idiomas'],
        ];

        DB::table('types')->insert($types);
    }
}
