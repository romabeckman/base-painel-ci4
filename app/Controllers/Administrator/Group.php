<?php

namespace App\Controllers\Administrator;

use \Authorization\Config\Services as AuthorizationServices;
use \Config\Services;
use \Exception;
use \Shared\Application\Abstracts\ControllerBase;
use \System\Config\Services as SystemServices;
use function \crudPermission;
use function \db_connect;
use function \redirect;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Group extends ControllerBase {

    public function index() {
        $paginate = AuthorizationServices::repository()->paginateGroup($this->request->getGet('search'));
        $data = [
            'groups' => $paginate['itens'],
            'pager' => $paginate['pager'],
            'permission' => crudPermission(static::class)
        ];

        $data['title'] = 'Grupos (' . $paginate['total'] . ')';
        return Services::template()->templatePainel($data);
    }

    public function create() {
        $data = [
            'validation' => $this->validator,
            'routes' => SystemServices::repository()->getAllRouterPermission(),
            'title' => 'Novo grupo',
            'breadcrumb' => $this->breadcrumb()
        ];
        return Services::template()->templatePainel($data, 'save');
    }

    public function update(?int $id = null) {
        $group = AuthorizationServices::repository()->groupModel->find($id);
        if (empty($group) || $id == 1) {
            Services::alertMessages()->setMsgWarning($id == 1 ? 'O grupo Administrador não pode ser alterado' : 'Grupo não encontrado.');
            return $this->response->redirect('/administrator/group');
        }

        $data = [
            'validation' => $this->validator,
            'group' => $group,
            'routes' => SystemServices::repository()->getAllRouterPermission($id),
            'title' => 'Alterar grupo',
            'breadcrumb' => $this->breadcrumb()
        ];
        return Services::template()->templatePainel($data, 'save');
    }

    public function delete() {
        $valid = $this->validate(['id' => ['label' => 'Usuário', 'rules' => 'required']]);

        if (!$valid) {
            Services::alertMessages()->setMsgDanger($this->validator->getError('id'));
        }

        $id = $this->request->getPost('id');

        if ($id == 1) {
            Services::alertMessages()->setMsgWarning('Você não pode remover o grupo Administrador');
            return redirect()->back();
        }

        AuthorizationServices::repository()->groupModel->delete($id);

        Services::alertMessages()->setMsgSuccess('Grupo removido com sucesso!');

        return redirect()->back();
    }

    public function save() {
        $post = $this->request->getPost();

        if (empty($post) || $post['id'] == 1) {
            return $this->response->redirect('/administrator/group');
        }

        $create = empty($post['id']);

        $rules = ['name' => ['rules' => 'required', 'label' => 'Nome']];
        if (!$this->validate($rules)) {
            return $create ? $this->create() : $this->update($post['id']);
        }

        $db = db_connect();
        $db->transBegin();
        try {
            if ($create) {
                $post['id'] = AuthorizationServices::groupService()->create($post);
                $messageSuccess = 'Grupo cadastrado com sucesso!';
            } else {
                AuthorizationServices::groupService()->update($post);
                $messageSuccess = 'Grupo alterado com sucesso!';
            }

            AuthorizationServices::permissionService()->saveByGroup($post['id'], $post['permissions'] ?? []);

            Services::alertMessages()->setMsgSuccess($messageSuccess);

            $db->transCommit();
            return $this->response->redirect('/administrator/group');
        } catch (Exception $exc) {
            $db->transRollback();
            Services::alertMessages()->setMsgDanger('Erro ao salvar o grupo, verifique os campos e tente novamente.', $exc);
            return $create ? $this->create() : $this->update($post['id']);
        }
    }

    private function breadcrumb(): array {
        return [
            'administrator/group' => 'Grupos'
        ];
    }

}
