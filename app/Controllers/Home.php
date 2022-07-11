<?php

namespace App\Controllers;

use \Config\Services;
use \Shared\Application\Abstracts\BaseController;

class Home extends BaseController {

    public function index() {
        return Services::template()->templatePainel(['title' => 'Página inicial']);
    }

}
