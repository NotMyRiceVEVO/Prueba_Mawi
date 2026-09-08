<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProyectos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nombre'      => ['type' => 'VARCHAR', 'constraint' => 150],
            'departamento'=> ['type' => 'VARCHAR', 'constraint' => 100],
            'presupuesto' => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('proyectos');
    }

    public function down()
    {
        $this->forge->dropTable('proyectos');
    }
}