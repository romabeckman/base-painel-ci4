<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuthRecovery extends Migration {

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
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'used_at' => [
                'type' => 'DATETIME',
                'default' => NULL,
                'null' => TRUE
            ],
            'valid_until' => [
                'type' => 'DATETIME',
                'default' => NULL,
                'null' => TRUE
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
        $this->forge->addForeignKey('id_auth_user', 'auth_user', 'id');
        $this->forge->createTable('auth_recovery');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('auth_recovery');
    }

}
