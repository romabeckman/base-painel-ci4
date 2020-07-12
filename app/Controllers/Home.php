<?php

namespace App\Controllers;

use \Authorization\Repository\AuthRepository;

class Home extends BaseController {

    public function index(AuthRepository $authRepository) {
        return $this->templatePainel(['title' => 'Página inicial']);
    }

}
