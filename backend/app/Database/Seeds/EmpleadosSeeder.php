<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nombre' => 'Ana López',    'rol' => 'Backend Developer',  'tarifa_hora' => 250.00],
            ['nombre' => 'Luis Ramírez', 'rol' => 'Frontend Developer', 'tarifa_hora' => 220.00],
            ['nombre' => 'Marta Díaz',   'rol' => 'Data Analyst',       'tarifa_hora' => 280.00],
        ];

        $this->db->table('empleados')->insertBatch($data);
    }
}