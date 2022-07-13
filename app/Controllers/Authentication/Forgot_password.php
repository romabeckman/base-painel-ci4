<?php

namespace App\Controllers\Authentication;

use \Authorization\Application\Exceptions\InvalidUserEmailException;
use \Authorization\Application\Exceptions\RecoveryPasswordFailException;
use \Authorization\Config\Services as AuthorizationServices;
use \Config\Services;
use \Shared\Application\Abstracts\BaseController;
use function \env;
use function \lang;

class Forgot_password extends BaseController {

    function index() {
        return Services::loginTemplate()->view();
    }

    function recovery() {
        $post = $this->request->getPost();
        if (empty($post)) {
            return $this->response->redirect('/authentication/login');
        }

        $reCaptchaV3Api = env('GOOGLE_RECAPTCHA_V3_PUBLIC_KEY');
        $reCaptchaV2Api = env('GOOGLE_RECAPTCHA_V2_PUBLIC_KEY');

        $rules = [
            'email' => ['label' => 'E-amil', 'rules' => 'required|valid_email'],
        ];

        $reCaptchaV3Api && $rules['grecaptcha'] = ['rules' => 'required|grecaptchav3'];
        $reCaptchaV2Api && $rules['g-recaptcha-response'] = ['label' => '"Eu não sou robô"' , 'rules' => 'required|grecaptchav2'];

        if (!$this->validate($rules)) {
            return Services::loginTemplate()->view(['validation' => $this->validator], 'index');
        }

        try {
            db_connect()->transBegin();
            AuthorizationServices::forgotPassowrdService()->handler($post['email']);
            db_connect()->transCommit();
            Services::alertMessages()->setMsgSuccess('Uma nova senha foi enviado por e-mail');
            return $this->response->redirect('/authentication/login');
        } catch (RecoveryPasswordFailException | InvalidUserEmailException $exc) {
            db_connect()->transRollback();
            return Services::loginTemplate()->view(['message_erro' => $exc->getMessage()], 'index');
        }
    }

}
