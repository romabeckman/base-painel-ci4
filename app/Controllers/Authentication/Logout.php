<?php

namespace App\Controllers\Authentication;

use \Authorization\Config\Services as AuthorizationServices;
use \Shared\Application\Abstracts\ControllerBase;

class Logout extends ControllerBase {

    function index() {
        AuthorizationServices::authSession()->destroy();
        return $this->response->redirect('/authentication/login');
    }

}
