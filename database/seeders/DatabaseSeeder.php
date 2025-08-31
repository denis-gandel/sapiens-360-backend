<?php

namespace Database\Seeders;

use App\Modules\Academics\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            TypeSeeder::class,
            NatureSeeder::class,
            PeriodSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class
        ]);
    }
}
