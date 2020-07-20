<?php

namespace App\Database\Seeds\Initialize;

use \CodeIgniter\Database\Seeder;
use \System\Models\RouteModel;

class InsertRoute extends Seeder {

    public function run() {
        $model = new RouteModel();
        if ($model->countAll() == 0) {
            $routes = [
                //PUBLIC
                ['controller' => \App\Controllers\Authentication\Login::class, 'name' => 'Login', 'group' => 'Authentication', 'access' => RouteModel::ACCESS_PUBLIC],
                ['controller' => \App\Controllers\Authentication\Logout::class, 'name' => 'Login', 'group' => 'Authentication', 'access' => RouteModel::ACCESS_PUBLIC],
                //PROTECTED
                ['controller' => \App\Controllers\Profile\Password::class, 'name' => 'Password', 'group' => 'Profile', 'access' => RouteModel::ACCESS_PROTECTED],
                ['controller' => \App\Controllers\Home::class, 'name' => 'Home', 'group' => null, 'access' => RouteModel::ACCESS_PROTECTED],
                //PRIVATE
                ['controller' => \App\Controllers\Administrator\User::class, 'name' => 'User', 'group' => 'Administrator', 'access' => RouteModel::ACCESS_PRIVATE],
                ['controller' => \App\Controllers\Administrator\Group::class, 'name' => 'Group', 'group' => 'Administrator', 'access' => RouteModel::ACCESS_PRIVATE],
                ['controller' => \App\Controllers\Administrator\Configuration::class, 'name' => 'Configuration', 'group' => 'Administrator', 'access' => RouteModel::ACCESS_PRIVATE],
                ['controller' => \App\Controllers\Administrator\Log::class, 'name' => 'Log', 'group' => 'Administrator', 'access' => RouteModel::ACCESS_PRIVATE],
            ];
            $model->insertBatch($routes);
            echo 'Saved router: ' . PHP_EOL;
        }
    }

}
