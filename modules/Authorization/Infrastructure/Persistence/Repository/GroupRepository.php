<?php

namespace Authorization\Infrastructure\Persistence\Repository;

use \Authorization\Infrastructure\Persistence\Models\GroupModel;
use \Shared\Persistence\Abstracts\BaseRepository;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class GroupRepository extends BaseRepository {

    protected string $modelClass = GroupModel::class;

    protected function filter(array $filter = []): void {
        !empty($filter['search']) && $this->getModel()->like('name', $filter['search']);
    }

}
