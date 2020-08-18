<?php

namespace App\Controllers\Authentication;

use \App\Controllers\BaseController;
use \Authorization\Config\Services as AuthorizationServices;

class Logout extends BaseController {

    function index() {
        AuthorizationServices::authSession()->destroy();
        return $this->response->redirect('/authentication/login');
    }

}
