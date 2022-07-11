<?php

namespace App\Controllers\Authentication;

use \Authorization\Config\Services as AuthorizationServices;
use \Shared\Application\Abstracts\BaseController;

class Logout extends BaseController {

    function index() {
        AuthorizationServices::userSession()->destroy();
        return $this->response->redirect('/authentication/login');
    }

}
