<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Estudiante'],
            ['name' => 'Docente'],
            ['name' => 'Admin'],
            ['name' => 'Director'],
            ['name' => 'Padre de familia'],
        ];

        DB::table('roles')->insert($roles);
    }
}
