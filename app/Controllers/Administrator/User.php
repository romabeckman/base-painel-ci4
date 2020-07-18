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
            'validation' => $this->validator,
            'title' => 'Novo usuário',
            'groups' => \Authorization\Config\Services::authRepository()->groupModel->dropdown('name', 'id'),
            'breadcrumb' => $this->breadcrumb()
        ];
        return \Config\Services::template()->templatePainel($data, 'save');
    }

    public function update(int $id) {
        $user = \Authorization\Config\Services::authRepository()->userModel->selectDecrypted()->find($id);
        if (empty($user) || $id == 1) {
            \Config\Services::alertMessages()->setMsgWarning($id == 1 ? 'O usuário Administrador não pode ser alterado' : 'Usuário não encontrado.');
            return $this->response->redirect('/administrator/group');
        }

        $data = [
            'validation' => $this->validator,
            'user' => $user,
            'title' => 'Alterar usuário',
            'groups' => \Authorization\Config\Services::authRepository()->groupModel->dropdown('name', 'id'),
            'breadcrumb' => $this->breadcrumb()
        ];
        return \Config\Services::template()->templatePainel($data, 'save');
    }

    public function save() {
        $post = $this->request->getPost();

        if (empty($post) || $post['id'] == 1) {
            return $this->response->redirect('/administrator/user');
        }

        if (!$this->validate($this->rules())) {
            return empty($post['id']) ? $this->create() : $this->update($post['id']);
        }

        $save = empty($post['id']) ?
                \Authorization\Config\Services::authUserService()->create($post) :
                \Authorization\Config\Services::authUserService()->update($post);

        if ($save) {
            return $this->response->redirect('/administrator/user');
        }

        return empty($post['id']) ? $this->create() : $this->update($post['id']);
    }

    public function delete() {
        $valid = $this->validate(['id' => ['label' => 'Usuário', 'rules' => 'required']]);

        if (!$valid) {
            \Config\Services::alertMessages()->setMsgDanger($this->validator->getError('id'));
        }

        $id = $this->request->getPost('id');

        if ($id === \Authorization\Config\Auth::$user->id || $id == 1) {
            \Config\Services::alertMessages()->setMsgWarning($id == 1 ? 'O usuário Administrador não pode ser removido' : 'Você não pode remover seu próprio perfil');
            return redirect()->back();
        }

        \Authorization\Config\Services::authRepository()->userModel->delete($id);

        \Config\Services::alertMessages()->setMsgSuccess('Usuário removido com sucesso!');

        return redirect()->back();
    }

    private function breadcrumb(): array {
        return [
            'administrator/user' => 'Usuários'
        ];
    }

    private function rules(): array {
        $post = $this->request->getPost();

        $rules = [];
        if (empty($post['id']) || isset($post['update_password'])) {
            $rules['password'] = ['label' => 'Sua nova senha', 'rules' => 'required|min_length[8]|max_length[32]|auth_strong_password'];
        } else {
            unset($post['password']);
        }
        $rules['name'] = ['label' => 'Nome', 'rules' => 'required'];
        $rules['id_auth_group'] = ['label' => 'Grupo', 'rules' => 'required'];
        $rules['email'] = ['label' => 'E-mail', 'rules' => 'required|valid_email|is_unique[auth_user.email,id,{id}]'];

        return $rules;
    }

}
