<?php

namespace App\Controllers\Administrator;

use \Authorization\Config\Services as AuthorizationServices;
use \Config\Services;
use \Shared\Application\Abstracts\ControllerBase;
use \Shared\Application\Traits\Breadcrumb;
use \Shared\Application\Traits\Index;
use \Shared\Persistence\Abstracts\RepositoryBase;
use \TheSeer\Tokenizer\Exception;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class User extends ControllerBase {

    protected RepositoryBase $repository;

    use Breadcrumb,
        Index;

    const URL = '/administrator/user/';
    const DESCRIPTION = 'Usuários';

    function __construct() {
        parent::__construct();
        $this->repository = AuthorizationServices::userRepository();
    }

    public function create() {
        $data = [
            'validation' => $this->validator,
            'title' => 'Novo usuário',
            'groups' => AuthorizationServices::groupRepository()->getModel()->dropdown('name', 'id'),
            'breadcrumb' => $this->breadcrumb()
        ];
        return Services::template()->templatePainel($data, 'save');
    }

    public function update(int $id) {
        $user = AuthorizationServices::userRepository()->getModel()->selectDecrypted()->find($id);
        if (empty($user) || $id == 1) {
            Services::alertMessages()->setMsgWarning($id == 1 ? 'O usuário Administrador não pode ser alterado' : 'Usuário não encontrado.');
            return $this->response->redirect('/administrator/group');
        }

        $data = [
            'validation' => $this->validator,
            'user' => $user,
            'title' => 'Alterar usuário',
            'groups' => AuthorizationServices::groupRepository()->getModel()->dropdown('name', 'id'),
            'breadcrumb' => $this->breadcrumb()
        ];
        return Services::template()->templatePainel($data, 'save');
    }

    public function save() {
        $post = $this->request->getPost();

        if (empty($post) || $post['id'] == 1) {
            return $this->response->redirect('/administrator/user');
        }

        $create = empty($post['id']);
        if (!$this->validate($this->rules())) {
            return $create ? $this->create() : $this->update($post['id']);
        }

        try {
            if ($create) {
                AuthorizationServices::userService()->create($post);
                Services::alertMessages()->setMsgSuccess('Usuário cadastrado sucesso!');
            } else {
                AuthorizationServices::userService()->update($post);
                Services::alertMessages()->setMsgSuccess('Usuário alterado sucesso!');
            }

            return $this->response->redirect('/administrator/user');
        } catch (Exception $exc) {
            Services::alertMessages()->setMsgDanger('Erro ao salvar o usuário, verifique os campos e tente novamente.', $exc);
            return $create ? $this->create() : $this->update($post['id']);
        }
    }

    public function delete() {
        $valid = $this->validate(['id' => ['label' => static::DESCRIPTION, 'rules' => 'required']]);

        if (!$valid) {
            Services::alertMessages()->setMsgDanger($this->validator->getError('id'));
            return redirect()->back();
        }

        $id = $this->request->getPost('id');

        $this->repository->getModel()->delete($id);

        $this->repository->getModel()->update($id, ['email' => null, 'name' => null, 'password' => null]);

        Services::alertMessages()->setMsgSuccess(static::DESCRIPTION . ' removida(o) com sucesso!');

        return redirect()->back();
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
        $rules['email'] = ['label' => 'E-mail', 'rules' => 'required|valid_email|is_unique_decrypted[auth_user.email,id,{id}]'];

        return $rules;
    }

}
