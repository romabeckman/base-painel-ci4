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
        service('authSession')->destroy();
        return Services::template()->templateLogin();
    }

    function auth() {
        $post = $this->request->getPost();

        if (empty($post)) {
            return $this->response->redirect('/authentication/login');
        }

        $valid = $this->validate(
                [
                    'email' => 'required|valid_email',
                    'password' => 'required',
                    'grecaptcha' => 'required|auth_grecaptcha'
                ]
        );
        if (!$valid) {
            return Services::template()->templateLogin(['validation' => $this->validator], 'index');
        }

        try {
            $user = service('authLogin')->handler($post['email'], $post['password']);
            service('authSession')->create($user, isset($post['remember_me']));
            return $this->response->redirect('/');
        } catch (InvalidUserEmailException $exc) {
            return Services::template()->templateLogin(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        } catch (InvalidUserPasswordException $exc) {
            return Services::template()->templateLogin(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        }
    }

}
