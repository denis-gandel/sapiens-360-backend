<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Categorías principales
            ['id' => 1, 'name' => 'LMS', 'parent_id' => null, 'path' => '/lms', 'code' => 'LMS_PAGE'],
            ['id' => 2, 'name' => 'Usuarios', 'parent_id' => null, 'path' => '/users', 'code' => 'USERS_PAGE'],
            ['id' => 3, 'name' => 'Institución', 'parent_id' => null, 'path' => '/institute', 'code' => 'INSTITUTE_PAGE'],

            // Subcategorías de LMS
            ['id' => 4, 'name' => 'Materias', 'parent_id' => 1, 'path' => '/subjects', 'code' => 'SUBJECTS_PAGE'],

            // Subcategorías de Usuarios
            ['id' => 5, 'name' => 'Administrar usuarios', 'parent_id' => 2, 'path' => '/management', 'code' => 'USERS_MANAGEMENT_PAGE'],

            // Subcategorias de Instituto
            ['id' => 6, 'name' => 'Instituto', 'parent_id' => 3, 'path' => '/', 'code' => 'INSTITUTE_MANAGEMENT_PAGE'],
            ['id' => 7, 'name' => 'Programas academicos', 'parent_id' => 3, 'path' => '/academic-programs', 'code' => 'ACADEMIC_PROGRAMS_PAGE'],
            ['id' => 8, 'name' => 'Niveles academicos', 'parent_id' => 3, 'path' => '/academic-levels', 'code' => 'ACADEMIC_LEVELS_PAGE'],
            ['id' => 9, 'name' => 'Cursos', 'parent_id' => 3, 'path' => '/courses', 'code' => 'COURSES_PAGE'],
            ['id' => 10, 'name' => 'Materias', 'parent_id' => 3, 'path' => '/subjects', 'code' => 'SUBJECTS_PAGE'],
        ];

        DB::table('categories')->truncate();
        DB::table('categories')->insert($categories);
    }
}
