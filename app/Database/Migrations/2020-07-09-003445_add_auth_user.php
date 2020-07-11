<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuthUser extends Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_auth_group' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => TRUE
            ],
            'name' => [
                'type' => 'VARBINARY',
                'constraint' => '255',
                'null' => TRUE
            ],
            'email' => [
                'type' => 'VARBINARY',
                'constraint' => '255',
                'null' => TRUE,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARBINARY',
                'constraint' => '255',
            ],
            'last_login_at' => [
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
        $this->forge->addForeignKey('id_auth_group', 'auth_group', 'id');
        $this->forge->createTable('auth_user');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('auth_user');
    }

}
