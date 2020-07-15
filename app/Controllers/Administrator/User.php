<?php

namespace App\Controllers\Administrator;

use \App\Controllers\BaseController;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class User extends BaseController {

    public function index() {
        $paginate = \Authorization\Config\Services::authRepository()->paginateUser($this->request->getGet('search'));
        $data = [
            'users' => $paginate['itens'],
            'pager' => $paginate['pager']
        ];

        $data['title'] = 'Usuários (' . $paginate['total'] . ')';
        return \Config\Services::template()->templatePainel($data);
    }

    public function create() {
        $data = [
            'users' => 'Novo usuário',
            'breadcrumb' => $this->breadcrumb()
        ];
        return \Config\Services::template()->templatePainel($data);
    }

    public function update() {
        $data = [
            'users' => 'Alterar usuário',
            'breadcrumb' => $this->breadcrumb()
        ];
        return \Config\Services::template()->templatePainel($data);
    }

    public function save() {

    }

    public function delete() {
        $valid = $this->validate(['id' => 'required']);

        if (!$valid) {
            \Config\Services::alertMessages()->setMsgDanger($this->validator->getError('id'));
        }

        $id = $this->request->getPost('id');

        \Authorization\Config\Services::authRepository()->userModel->delete($id);

        \Config\Services::alertMessages()->setMsgSuccess('Usuário removido com sucesso!');

        return redirect()->back();
    }

    private function breadcrumb(): array {
        return [
            'administrator/user' => 'Usuários'
        ];
    }

}
