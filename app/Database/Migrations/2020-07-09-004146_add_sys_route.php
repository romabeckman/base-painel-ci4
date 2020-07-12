<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSysRoute extends Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'controller' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'method' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'access' => [
                'type' => "ENUM",
                'constraint' => ['public', 'protected', 'private'],
                'default' => 'private'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('sys_route');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('sys_route');
    }

}
