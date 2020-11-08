<?php

namespace App\Controllers\Authentication;

use \Authorization\Config\Services as AuthorizationServices;
use \Authorization\Exceptions\InvalidUserEmailException;
use \Authorization\Exceptions\InvalidUserPasswordException;
use \Config\Services;
use \Shared\Application\Abstracts\ControllerBase;
use function \env;
use function \lang;

class Login extends ControllerBase {

    function index() {
        AuthorizationServices::userSession()->destroy();
        return Services::template()->templateLogin();
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

        $reCaptchaV3Api && $rules['grecaptcha'] = ['required|grecaptchav3'];
        $reCaptchaV2Api && $rules['g-recaptcha-response'] = ['label' => '"Eu não sou robô"' , 'rules' => 'required|grecaptchav2'];

        if (!$this->validate($rules)) {
            return Services::template()->templateLogin(['validation' => $this->validator], 'index');
        }

        try {
            $post = $this->request->getPost();
            $user = AuthorizationServices::loginService()->handler($post['email'], $post['password']);

            AuthorizationServices::userSession()->create($user, isset($post['remember_me']));

            return $this->response->redirect('/');
        } catch (InvalidUserEmailException $exc) {
            return Services::template()->templateLogin(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        } catch (InvalidUserPasswordException $exc) {
            return Services::template()->templateLogin(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        }
    }

}
