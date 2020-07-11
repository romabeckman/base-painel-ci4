<?php

namespace App\Controllers;

class Home extends BaseController {

    public function index(\Authorization\Service\Login\EmailService $emailService) {
        $emailService->handler('adm@adm.com');
    }

}
