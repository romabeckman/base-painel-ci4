<?php

namespace App\Controllers\Profile;

use \Authorization\Config\Services as AuthorizationServices;
use \Config\Services;
use \Shared\Application\Abstracts\BaseController;

/**
 * Description of Password
 *
 * @author Romário Beckman
 */
class Password extends BaseController {

    public function index() {
        return Services::painelTemplate()->view(['title' => 'Alterar minha senha']);
    }

    public function update() {
        $post = $this->request->getPost();

        if (empty($post)) {
            return $this->response->redirect('/profile/password');
        }

        $validation = Services::validation();
        $validation->setRule('password', 'Sua nova senha', 'required|min_length[8]|max_length[32]|auth_strong_password');
        $validation->setRule('confirm_password', 'Repita sua nova senha', 'required|matches[password]', ['matches' => 'Sua senha em "Repita sua nova senha" com "Sua nova senha" estão diferentes']);
        $validation->setRule('old_password', 'Senha atual', 'required|auth_current_password');

        if (!$validation->run($post)) {
            return Services::painelTemplate()->view(['validation' => $validation], 'index');
        }

        AuthorizationServices::updatePasswordService()->handler($post['password']);
        Services::alertMessages()->setMsgSuccess('Senha foi alterada com sucesso!');

        return $this->response->redirect('/profile/password');
    }

}
