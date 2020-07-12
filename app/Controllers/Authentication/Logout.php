<?php

namespace App\Controllers\Authentication;

use \App\Controllers\BaseController;

class Logout extends BaseController {

    /**
     * @autowired
     * @var \Authorization\Libraries\AuthSession
     */
    private $AuthSession;

    function index() {
        $this->AuthSession->destroy();
        return $this->response->redirect('/authentication/login');
    }

}
