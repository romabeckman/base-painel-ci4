<?php

namespace App\Controllers\Administrator;

use \Authorization\Config\Services as AuthorizationServices;
use \Config\Services;
use \Exception;
use \Shared\Application\Abstracts\ControllerBase;
use \Shared\Application\Traits\Breadcrumb;
use \Shared\Application\Traits\Delete;
use \Shared\Application\Traits\Index;
use \Shared\Persistence\Abstracts\RepositoryBase;
use \System\Config\Services as SystemServices;
use function \db_connect;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Group extends ControllerBase {

    protected RepositoryBase $repository;

    use Breadcrumb,
        Index,
        Delete;

    const URL = '/administrator/group/';
    const DESCRIPTION = 'Grupos';

    function __construct() {
        parent::__construct();
        $this->repository = AuthorizationServices::groupRepository();
    }

    public function create() {
        $data = [
            'validation' => $this->validator,
            'routes' => SystemServices::routeRepository()->getAllRouterPermission(),
            'title' => 'Novo grupo',
            'breadcrumb' => $this->breadcrumb()
        ];
        return Services::template()->templatePainel($data, 'save');
    }

    public function update(?int $id = null) {
        $group = $this->repository->getModel()->find($id);
        if (empty($group) || $id == 1) {
            Services::alertMessages()->setMsgWarning($id == 1 ? 'O grupo Administrador não pode ser alterado' : 'Grupo não encontrado.');
            return $this->response->redirect('/administrator/group');
        }

        $data = [
            'validation' => $this->validator,
            'group' => $group,
            'routes' => SystemServices::routeRepository()->getAllRouterPermission($id),
            'title' => 'Alterar grupo',
            'breadcrumb' => $this->breadcrumb()
        ];
        return Services::template()->templatePainel($data, 'save');
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
            $this->repository->getModel()->save($post);
            empty($post['id']) && $post['id'] = $this->repository->getModel()->insertID();

            AuthorizationServices::permissionService()->saveByGroup($post['id'], $post['permissions'] ?? []);

            Services::alertMessages()->setMsgSuccess('Dados foram salvos com sucesso.');

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
