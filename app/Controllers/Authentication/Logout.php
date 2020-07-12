<?php

namespace App\Controllers\Authentication;

use \App\Controllers\BaseController;

class Logout extends BaseController {

    function index() {
        service('authSession')->destroy();
        return $this->response->redirect('/authentication/login');
    }

}
