<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuthRoute extends Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'route' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'access' => [
                'type' => "ENUM",
                'constraint' => ['public', 'private'],
                'default' => 'private'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => NULL,
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default' => NULL,
                'null' => TRUE
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'default' => NULL,
                'null' => TRUE
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('auth_route');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('auth_route');
    }

}
