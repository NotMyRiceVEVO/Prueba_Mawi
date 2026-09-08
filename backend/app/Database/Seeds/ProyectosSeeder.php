<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProyectosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nombre' => 'Portal Clientes', 'departamento' => 'TI', 'presupuesto' => 50000.00],
            ['nombre' => 'App Móvil Ventas', 'departamento' => 'Ventas', 'presupuesto' => 30000.00],
            ['nombre' => 'Migración ERP', 'departamento' => 'Finanzas', 'presupuesto' => 80000.00],
        ];

        $this->db->table('proyectos')->insertBatch($data);
    }
}