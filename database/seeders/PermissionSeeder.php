<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Crear materias', 'description' => 'Crear nuevos materias', 'path' => '/', 'code' => 'CREATE_SUBJECTS', 'category_id' => 4], //1
            ['name' => 'Crear tareas', 'description' => 'Crear nuevas tareas', 'path' => '/', 'code' => 'CREATE_ASSIGNMENTS', 'category_id' => 4], //2
            ['name' => 'Publicar anuncios', 'description' => 'Publicar anuncions de clase', 'path' => '/', 'code' => 'PUBLISH_ANNOUNCEMENTS', 'category_id' => 4], //3
            ['name' => 'Matricular estudiantes', 'description' => 'Matricular a los estudiantes respectivos dentro de la materia', 'path' => '/', 'code' => 'ENROLL_STUDENTS', 'category_id' => 4], //4
            ['name' => 'Visualizar mis materias', 'description' => 'Permite unicamente ver las materias donde el usuario esta matriculado/a o es docente.', 'path' => '/', 'code' => 'VIEW_MY_SUBJECTS', 'category_id' => 4], //5
            ['name' => 'Visualizar las materias', 'description' => 'Permite visualizar las materias que fueron creadas.', 'path' => '/', 'code' => 'VIEW_SUBJECTS', 'category_id' => 4], //6
            ['name' => 'Crear usuarios', 'description' => 'Crear nuevos usuarios en el sistema', 'path' => '/', 'code' => 'CREATE_USERS', 'category_id' => 5], //7
            ['name' => 'Eliminar usuarios', 'description' => 'Eliminar usuarios del sistema', 'path' => '/', 'code' => 'DELETE_USERS', 'category_id' => 5], //8
            ['name' => 'Visualizar perfil del instituto', 'description' => 'Permite la visualizacion y edicion de la informacion del instituto', 'path' => '/', 'code' => 'INSTITUTE_SHOW', 'category_id' => 6], //9
            ['name' => 'Crear niveles', 'description' => 'Crear nuevos niveles academicos en el sistema', 'path' => '/', 'code' => 'CREATE_ACADEMIC_LEVELS', 'category_id' => 8], //10
            ['name' => 'Subir tareas', 'description' => 'Permite a los estudiantes poder subir la resolucion de sus tareas.', 'path' => '/', 'code' => 'SUBMIT_ASSIGNMENT', 'category_id' => 4], //11
            ['name' => 'Revision de tareas', 'description' => 'Permite a los docentes revisar y asignar un puntaje a la tarea enviada por el estudiante.', 'path' => '/', 'code' => 'REVIEW_ASSIGNMENT', 'category_id' => 4], //12
            ['name' => 'Crear programas', 'description' => 'Crear nuevos programas academicos en el sistema', 'path' => '/', 'code' => 'CREATE_ACADEMIC_PROGRAMS', 'category_id' => 7], //13
            ['name' => 'Crear cursos', 'description' => 'Crear nuevos cursos en el sistema', 'path' => '/', 'code' => 'CREATE_ACADEMIC_COURSES', 'category_id' => 9], //14
            ['name' => 'Crear materias', 'description' => 'Crear nuevas materias en el sistema', 'path' => '/', 'code' => 'CREATE_ACADEMIC_SUBJECTS', 'category_id' => 10], //15
        ];

        DB::table('permissions')->truncate();
        DB::table('permissions')->insert($permissions);
    }
}
