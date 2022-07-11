<?php

namespace App\Database\Seeds;

use \App\Database\Seeds\Initialize\InsertAdmin;
use \App\Database\Seeds\Initialize\InsertConfig;
use \App\Database\Seeds\Initialize\InsertGroup;
use \App\Database\Seeds\Initialize\InsertRoute;
use \CodeIgniter\Database\Seeder;

class Init extends Seeder {

    public function run() {
        $this->call(InsertGroup::class);
        $this->call(InsertAdmin::class);
        $this->call(InsertConfig::class);
        $this->call(InsertRoute::class);
    }

}
