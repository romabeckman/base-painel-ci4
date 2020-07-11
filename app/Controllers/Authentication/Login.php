<?php

namespace App\Controllers\Authentication;

use \App\Controllers\BaseController;
use \Authorization\Exceptions\Login\InvalidUserEmailException;
use \Authorization\Exceptions\Login\InvalidUserPasswordException;
use \Authorization\Models\UserModel;
use \Authorization\Service\Auth\LoginService;
use \Authorization\Service\Auth\SessionService;
use function \lang;
use function \view;

class Login extends BaseController {

    function index(SessionService $sessionService) {
        $sessionService->destroy();
        return $this->autoloadView(['title' => 'Login']);
    }

    function auth(LoginService $loginService, SessionService $sessionService) {
        $post = $this->request->getPost();

        if (empty($post)) {
            return $this->response->redirect('/authentication/login');
        }

        $valid = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$valid) {
            return view('authentication/login/index', ['title' => 'Login', 'validation' => $this->validator]);
        }

        try {
            $user = $loginService->handler($post['email'], $post['password']);

            $sessionService->create($user, isset($post['remember_me']));

            $userModel = new UserModel();
            $userModel->update($user->id, ['last_login_at' => date('Y-m-d H:i:s')]);

            return $this->response->redirect('/');
        } catch (InvalidUserEmailException $exc) {
            return view('authentication/login/index', ['title' => 'Login', 'message_erro' => lang('Auth.invalid_user_auth')]);
        } catch (InvalidUserPasswordException $exc) {
            return view('authentication/login/index', ['title' => 'Login', 'message_erro' => lang('Auth.invalid_user_auth')]);
        }
    }

}
