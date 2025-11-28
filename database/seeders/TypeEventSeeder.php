<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            // Académicos
            ['name' => 'Clase', 'code' => 'CLASS'],
            ['name' => 'Examen Parcial', 'code' => 'MIDTERM_EXAM'],
            ['name' => 'Examen Final', 'code' => 'FINAL_EXAM'],
            ['name' => 'Práctica', 'code' => 'PRACTICE'],
            ['name' => 'Entrega de Trabajo', 'code' => 'ASSIGNMENT_DEADLINE'],
            ['name' => 'Defensa de Tesis', 'code' => 'THESIS_DEFENSE'],

            // Periodo Académico
            ['name' => 'Inicio de Periodo', 'code' => 'TERM_START'],
            ['name' => 'Fin de Periodo', 'code' => 'TERM_END'],
            ['name' => 'Inscripción', 'code' => 'ENROLLMENT'],
            ['name' => 'Retiro de Materia', 'code' => 'WITHDRAWAL'],
            ['name' => 'Revisión de Notas', 'code' => 'GRADE_REVIEW'],

            // Administrativos / Eventos
            ['name' => 'Reunión', 'code' => 'MEETING'],
            ['name' => 'Ceremonia de Apertura', 'code' => 'OPENING_CEREMONY'],
            ['name' => 'Ceremonia de Clausura', 'code' => 'CLOSING_CEREMONY'],
            ['name' => 'Graduación', 'code' => 'GRADUATION'],
            ['name' => 'Feria Académica', 'code' => 'ACADEMIC_FAIR'],
            ['name' => 'Evento Cultural', 'code' => 'CULTURAL_EVENT'],
            ['name' => 'Evento Deportivo', 'code' => 'SPORTS_EVENT'],

            // No académicos / No laborables
            ['name' => 'Feriado', 'code' => 'HOLIDAY'],
            ['name' => 'Día Institucional', 'code' => 'INSTITUTIONAL_DAY'],
            ['name' => 'Suspensión de Clases', 'code' => 'CLASS_SUSPENSION'],
        ];

        DB::table('type_events')->insert($types);
    }
}
