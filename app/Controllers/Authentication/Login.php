<?php

namespace App\Controllers\Authentication;

use \App\Controllers\BaseController;
use function \view;

class Login extends BaseController {

    function index(\Authorization\Service\Login\EmailService $emailService) {
        $emailService->handler('adm@adm.com');
        return view('authentication/login/index', ['title' => 'Login']);
    }

    function forgot_password() {
        return view('authentication/login/index', ['title' => 'Esqueci minha senha']);
    }

}
