<?php

namespace App\Database\Seeds\Initialize;

use \Authorization\Infrastructure\Persistence\Entity\User;
use \Authorization\Infrastructure\Persistence\Models\UserModel;
use \CodeIgniter\Database\Seeder;

class InsertAdmin extends Seeder {

    public function run() {
        $userModel = new UserModel();

        if ($userModel->countAll() == 0) {
            $User = new User();
            $User->id_auth_group = 1;
            $User->name = "Administrador";
            $User->email = "admin@admin.com";
            $User->password = "admin";
            $saved = (new UserModel())->insert($User);
            echo 'Saved user: ' . $saved . PHP_EOL;
        }
    }

}
