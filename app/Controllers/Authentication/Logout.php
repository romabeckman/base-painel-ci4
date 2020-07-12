<?php

namespace App\Controllers\Authentication;

use \App\Controllers\BaseController;
use \Authorization\Services\SessionService;

class Logout extends BaseController {

    function index(SessionService $sessionService) {
        $sessionService->destroy();
        return $this->response->redirect('/authentication/login');
    }

}
