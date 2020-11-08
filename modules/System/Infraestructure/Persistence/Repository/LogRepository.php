<?php

namespace System\Infraestructure\Persistence\Repository;

use \Authorization\Config\Services as AuthorizationService;
use \Shared\Persistence\Abstracts\RepositoryBase;
use \System\Config\Services;
use \System\Infraestructure\Persistence\Entity\Log;
use \System\Infraestructure\Persistence\Models\LogModel;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class LogRepository extends RepositoryBase {

    protected string $modelClass = LogModel::class;

    public function saveLog(string $description, ?int $idUser = null, array $options = []): void {
        $log = new Log();
        $log->id_auth_user = $idUser;
        $log->description = [
            'description' => $description,
            'options' => $options
        ];
        $log->ip = Services::request()->getIPAddress();
        $this->getModel()->insert($log);
    }

    public function saveAccessLog(string $description, ?int $idUser = null, array $options = []): void {
        $post = Services::request()->getPost();
        if (empty($post)) {
            return;
        }

        foreach ($post as $key => $value) {
            $post[$key] = strpos($key, 'password') === false ? $value : '***';
        }

        $log = new Log();
        $log->id_auth_user = $idUser;
        $log->description = [
            'description' => $description,
            'options' => $options
        ];
        $log->ip = Services::request()->getIPAddress();
        $log->data = json_encode($post);
        $this->getModel()->insert($log);
    }

    protected function filter(array $filter = array()): void {
        empty($filter['search']) ||
                $this->getModel()->like('description', $filter['search']);
    }

    protected function subSelect(): void {
        $this->getModel()->subSelect('id_auth_user', AuthorizationService::userRepository()->getModel(), 'name', 'user');
    }

}
