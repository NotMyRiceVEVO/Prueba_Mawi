<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RegistrosTiempoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['empleado_id' => 1, 'proyecto_id' => 1, 'fecha' => '2026-08-01', 'tarea' => 'Diseño de API', 'horas' => 8],
            ['empleado_id' => 1, 'proyecto_id' => 1, 'fecha' => '2026-08-02', 'tarea' => 'Implementación CRUD', 'horas' => 6],
            ['empleado_id' => 2, 'proyecto_id' => 1, 'fecha' => '2026-08-02', 'tarea' => 'Maquetado UI',       'horas' => 5],
            ['empleado_id' => 3, 'proyecto_id' => 2, 'fecha' => '2026-08-03', 'tarea' => 'Análisis de datos',  'horas' => 7],
            ['empleado_id' => 2, 'proyecto_id' => 2, 'fecha' => '2026-08-04', 'tarea' => 'Pantallas móviles',  'horas' => 8],
            ['empleado_id' => 1, 'proyecto_id' => 3, 'fecha' => '2026-08-05', 'tarea' => 'Migración de tablas','horas' => 9],
        ];

        $this->db->table('registros_tiempo')->insertBatch($data);
    }
}