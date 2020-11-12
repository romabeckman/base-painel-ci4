<?php

namespace Authorization\Infrastructure\Persistence\Repository;

use \Authorization\Infrastructure\Persistence\Models\GroupModel;
use \Shared\Persistence\Abstracts\RepositoryBase;

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
