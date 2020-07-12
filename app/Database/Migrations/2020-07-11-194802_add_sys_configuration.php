<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSysConfiguration extends Migration {

    public function up() {
        $this->forge->addField([
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'value' => [
                'type' => 'TEXT',
                'default' => null,
                'null' => TRUE,
            ]
        ]);
        $this->forge->addKey('key', TRUE);
        $this->forge->createTable('sys_configuration');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('sys_configuration');
    }

}
