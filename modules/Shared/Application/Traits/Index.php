<?php

namespace Shared\Application\Traits;

use \Config\Services;
use function \crudPermission;

/**
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
trait Index {

    public function index() {
        $search = $this->request->getGet('search') ?: '';

        $paginate = $this->repository->getPaginated($search, 'id desc');
        
        $data = [
            'entities' => $paginate['itens'],
            'pager' => $paginate['pager'],
            'permission' => crudPermission(static::class)
        ];

        $data['title'] = static::DESCRIPTION . ' (' . $paginate['total'] . ')';
        return Services::painelTemplate()->view($data);
    }

}
