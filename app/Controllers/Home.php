<?php

namespace App\Controllers;

class Home extends BaseController {

    public function index() {
        return $this->templatePainel(['title' => 'Página inicial']);
    }

}
