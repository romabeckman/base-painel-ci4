<?php

namespace App\Database\Seeds\Initialize;

use \CodeIgniter\Database\Seeder;
use \System\Models\RouteModel;

class InsertRoute extends Seeder {

    public function run() {
        $model = new RouteModel();
        if ($model->countAll() == 0) {
            $model->insertBatch([
                ['controller' => \App\Controllers\Authentication\Login::class, 'access' => RouteModel::ACCESS_PUBLIC],
                ['controller' => \App\Controllers\Authentication\Logout::class, 'access' => RouteModel::ACCESS_PUBLIC],
                ['controller' => \App\Controllers\Authentication\Recovery::class, 'access' => RouteModel::ACCESS_PUBLIC],
                ['controller' => \App\Controllers\Home::class, 'access' => RouteModel::ACCESS_PROTECTED],
                ['controller' => \App\Controllers\Administrator\User::class, 'access' => RouteModel::ACCESS_PRIVATE],
                ['controller' => \App\Controllers\Administrator\Group::class, 'access' => RouteModel::ACCESS_PRIVATE],
                ['controller' => \App\Controllers\Administrator\Configuration::class, 'access' => RouteModel::ACCESS_PRIVATE],
            ]);
            echo 'Saved router: ' . PHP_EOL;
        }
    }

}
