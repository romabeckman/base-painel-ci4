<?php

namespace App\Controllers;

use \Config\Services;
use \Shared\Application\Abstracts\ControllerBase;

class Home extends ControllerBase {

    public function index() {
        return Services::template()->templatePainel(['title' => 'Página inicial']);
    }

}
