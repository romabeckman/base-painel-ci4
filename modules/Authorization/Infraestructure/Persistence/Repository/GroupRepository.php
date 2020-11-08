<?php

namespace Authorization\Infraestructure\Persistence\Repository;

use \Shared\Persistence\Abstracts\RepositoryBase;
use \Authorization\Models\GroupModel;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class GroupRepository extends RepositoryBase {

    protected string $modelClass = GroupModel::class;

    protected function filter(array $filter = []): void {
        !empty($filter['search']) && $this->getModel()->like('name', $filter['search']);
    }

}
