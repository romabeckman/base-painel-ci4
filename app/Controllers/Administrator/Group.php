<?php

namespace App\Controllers\Administrator;

use \App\Controllers\BaseController;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Group extends BaseController {

    public function index() {
        $paginate = \Authorization\Config\Services::authRepository()->paginateGroup($this->request->getGet('search'));
        $data = [
            'groups' => $paginate['itens'],
            'pager' => $paginate['pager']
        ];

        $data['title'] = 'Grupos (' . $paginate['total'] . ')';
        return \Config\Services::template()->templatePainel($data);
    }

    public function create() {
        $data = [
            'validation' => $this->validator,
            'routes' => \System\Config\Services::sysRepository()->getAllRouterPermission(),
            'title' => 'Novo grupo',
            'breadcrumb' => $this->breadcrumb()
        ];
        return \Config\Services::template()->templatePainel($data, 'save');
    }

    public function update(?int $id = null) {
        $group = \Authorization\Config\Services::authRepository()->groupModel->find($id);
        if (empty($group)) {
            \Config\Services::alertMessages()->setMsgWarning('Grupo não encontrado.');
            return $this->response->redirect('/administrator/group');
        }

        $data = [
            'validation' => $this->validator,
            'group' => $group,
            'routes' => \System\Config\Services::sysRepository()->getAllRouterPermission($id),
            'title' => 'Alterar grupo',
            'breadcrumb' => $this->breadcrumb()
        ];
        return \Config\Services::template()->templatePainel($data, 'save');
    }

    public function delete() {
        $valid = $this->validate(['id' => ['label' => 'Usuário', 'rules' => 'required']]);

        if (!$valid) {
            \Config\Services::alertMessages()->setMsgDanger($this->validator->getError('id'));
        }

        $id = $this->request->getPost('id');

        if ($id == 1) {
            \Config\Services::alertMessages()->setMsgWarning('Você não pode remover o grupo Administrador');
            return redirect()->back();
        }

        \Authorization\Config\Services::authRepository()->groupModel->delete($id);

        \Config\Services::alertMessages()->setMsgSuccess('Grupo removido com sucesso!');

        return redirect()->back();
    }

    public function save() {
        $post = $this->request->getPost();

        if (empty($post)) {
            return $this->response->redirect('/administrator/group');
        }

        $create = empty($post['id']);

        $rules = ['name' => ['rules' => 'required', 'label' => 'Nome']];
        if (!$this->validate($rules)) {
            return $create ? $this->create() : $this->update($post['id']);
        }

        $db = db_connect();
        $db->transBegin();

        $save = $create ?
                \Authorization\Config\Services::authGroupService()->create($post) :
                \Authorization\Config\Services::authGroupService()->update($post);

        \Authorization\Config\Services::authPermissionService()->saveByGroup($create ? $save : $post['id'], $post['permissions'] ?? []);

        if ($save) {
            $db->transCommit();
            return $this->response->redirect('/administrator/group');
        }

        $db->transRollback();
        return $create ? $this->create() : $this->update($post['id']);
    }

    private function breadcrumb(): array {
        return [
            'administrator/group' => 'Grupos'
        ];
    }

}
