<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuthPermission extends Migration {

    public function up() {
        $this->forge->addField([
            'id_auth_group' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => TRUE,
            ],
            'id_sys_route' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => TRUE,
            ]
        ]);
        $this->forge->addKey(['id_auth_group', 'id_sys_route'], TRUE);
        $this->forge->addForeignKey('id_auth_group', 'auth_group', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('id_sys_route', 'sys_route', 'id', 'cascade', 'cascade');
        $this->forge->createTable('auth_permission');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('auth_permission');
    }

}
