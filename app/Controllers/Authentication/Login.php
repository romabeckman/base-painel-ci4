<?php

namespace App\Controllers\Authentication;

use \Authorization\Application\Exceptions\InvalidUserEmailException;
use \Authorization\Application\Exceptions\InvalidUserPasswordException;
use \Authorization\Config\Services as AuthorizationServices;
use \Config\Services;
use \Shared\Application\Abstracts\BaseController;
use function \env;
use function \lang;

class Login extends BaseController {

    function index() {
        return Services::loginTemplate()->view();
    }

    function auth() {
        $post = $this->request->getPost();
        if (empty($post)) {
            return $this->response->redirect('/authentication/login');
        }

        $reCaptchaV3Api = env('GOOGLE_RECAPTCHA_V3_PUBLIC_KEY');
        $reCaptchaV2Api = env('GOOGLE_RECAPTCHA_V2_PUBLIC_KEY');

        $rules = [
            'email' => ['label' => 'E-amil', 'rules' => 'required|valid_email'],
            'password' => ['label' => 'Senha', 'rules' => 'required'],
        ];

        $reCaptchaV3Api && $rules['grecaptcha'] = ['rules' => 'required|grecaptchav3'];
        $reCaptchaV2Api && $rules['g-recaptcha-response'] = ['label' => '"Eu não sou robô"' , 'rules' => 'required|grecaptchav2'];

        if (!$this->validate($rules)) {
            return Services::loginTemplate()->view(['validation' => $this->validator], 'index');
        }

        try {
            $user = AuthorizationServices::loginService()->handler($post['email'], $post['password']);
            AuthorizationServices::userSession()->create($user, isset($post['remember_me']));
            return $this->response->redirect('/');
        } catch (InvalidUserEmailException $exc) {
            return Services::loginTemplate()->view(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        } catch (InvalidUserPasswordException $exc) {
            return Services::loginTemplate()->view(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        }
    }

}
