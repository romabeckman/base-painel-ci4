<?php

namespace App\Controllers\Authentication;

use \App\Controllers\BaseController;
use \Authorization\Exceptions\InvalidUserEmailException;
use \Authorization\Exceptions\InvalidUserPasswordException;
use \Authorization\Services\LoginService;

class Login extends BaseController {

    /**
     * @autowired
     * @var \Authorization\Libraries\AuthSession
     */
    private $AuthSession;

    function index() {
        $this->AuthSession->destroy();
        return $this->templateLogin();
    }

    function auth(LoginService $loginService) {
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
            return $this->templateLogin(['validation' => $this->validator], 'index');
        }

        try {
            $user = $loginService->handler($post['email'], $post['password']);
            $this->AuthSession->create($user, isset($post['remember_me']));
            return $this->response->redirect('/');
        } catch (InvalidUserEmailException $exc) {
            return $this->templateLogin(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        } catch (InvalidUserPasswordException $exc) {
            return $this->templateLogin(['message_erro' => lang('Auth.invalid_user_auth')], 'index');
        }
    }

}
