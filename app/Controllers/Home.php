<?php

namespace App\Controllers;

use \System\Config\Services;

class Home extends BaseController {

    public function index() {
        return Services::template()->templatePainel(['title' => 'Página inicial']);
    }

}
