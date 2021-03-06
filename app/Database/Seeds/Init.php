<?php

namespace App\Database\Seeds;

use \App\Database\Seeds\Initialize\InsertAdmin;
use \App\Database\Seeds\Initialize\InsertConfig;
use \App\Database\Seeds\Initialize\InsertGroup;
use \App\Database\Seeds\Initialize\InsertRoute;
use \CodeIgniter\Database\Seeder;
use \Config\Database;
use \Config\Encryption;

class Init extends Seeder {

    public function run() {
        $db = Database::connect();
        $config = new Encryption();

        $db->query("SET @key = '{$config->key}'");

        $this->call(InsertGroup::class);
        $this->call(InsertAdmin::class);
        $this->call(InsertConfig::class);
        $this->call(InsertRoute::class);
    }

}
