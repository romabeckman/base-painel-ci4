<?php

namespace App\Database\Seeds\Initialize;

use \Authorization\Models\GroupModel;
use \CodeIgniter\Database\Seeder;

class InsertGroup extends Seeder {

    public function run() {
        $groupModel = new GroupModel();
        if ($groupModel->countAll() == 0) {
            $Group = [
                'name' => 'Administrador',
            ];
            $saved = $groupModel->insert($Group);
            echo 'Saved group: ' . $saved . PHP_EOL;
        }

    }

}
