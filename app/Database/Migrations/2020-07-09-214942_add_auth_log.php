<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuthLog extends Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_auth_user' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => TRUE,
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'ip' => [
                'type' => 'VARBINARY',
                'constraint' => '255',
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => NULL,
                'null' => TRUE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_auth_user', 'auth_user', 'id');
        $this->forge->createTable('auth_log');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('auth_log');
    }

}
