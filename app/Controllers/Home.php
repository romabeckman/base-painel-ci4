<?php

namespace App\Controllers;

class Home extends BaseController {

    public function index() {
        return $this->autoloadView(['title' => 'Página inicial']);
    }

}
