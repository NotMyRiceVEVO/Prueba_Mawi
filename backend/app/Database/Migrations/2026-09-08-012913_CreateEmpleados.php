<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmpleados extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nombre'         => ['type' => 'VARCHAR', 'constraint' => 150],
            'rol'            => ['type' => 'VARCHAR', 'constraint' => 100],
            'tarifa_hora'    => ['type' => 'DECIMAL', 'constraint' => '8,2'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('empleados');
    }

    public function down()
    {
        $this->forge->dropTable('empleados');
    }
}