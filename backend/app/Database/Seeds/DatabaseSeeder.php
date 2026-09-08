<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('App\Database\Seeds\ProyectosSeeder');
        $this->call('App\Database\Seeds\EmpleadosSeeder');
        $this->call('App\Database\Seeds\RegistrosTiempoSeeder');
    }
}