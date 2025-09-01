<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periods = [
            ['name' => 'Trimestral', 'duration' => 3],
            ['name' => 'Semestral', 'duration' => 6],
            ['name' => 'Anual', 'duration' => 12],
        ];

        DB::table('periods')->insert($periods);
    }
}
