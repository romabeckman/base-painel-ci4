<?php

namespace App\Controllers\Authentication;

use \App\Controllers\BaseController;
use \Authorization\Exceptions\InvalidUserEmailException;
use \Authorization\Exceptions\InvalidUserPasswordException;
use \Config\Services;
use function \lang;
use function \service;

class Login extends BaseController {

    function index() {
        \Authorization\Config\Services::authSession()->destroy();
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
            $user = service('authLogin')->handler($post['email'], $post['password']);

            \Authorization\Config\Services::authSession()->create($user, isset($post['remember_me']));

            return $this->response->redirect('/');
        } catch (InvalidUserEmailException $exc) {
            return Services::template()->templateLogin(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        } catch (InvalidUserPasswordException $exc) {
            return Services::template()->templateLogin(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        }
    }

}
