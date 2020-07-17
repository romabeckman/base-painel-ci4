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

        $valid = $this->validate(
                [
                    'email' => ['label' => 'E-amil', 'rules' => 'required|valid_email'],
                    'password' => ['label' => 'Senha', 'rules' => 'required'],
//                    'grecaptcha' => 'required|grecaptchav3',
                    'g-recaptcha-response' => ['label' => '"Eu não sou robô"' , 'rules' => 'required|grecaptchav2']
                ]
        );
        if (!$valid) {
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
