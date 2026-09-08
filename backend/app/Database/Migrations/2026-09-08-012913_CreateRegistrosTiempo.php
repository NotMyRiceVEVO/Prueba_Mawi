<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRegistrosTiempo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'empleado_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'proyecto_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'fecha'        => ['type' => 'DATE'],
            'tarea'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'horas'        => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('empleado_id', 'empleados', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('proyecto_id', 'proyectos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('registros_tiempo');
    }

    public function down()
    {
        $this->forge->dropTable('registros_tiempo');
    }
}