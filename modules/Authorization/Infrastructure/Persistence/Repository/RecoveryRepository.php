<?php

namespace Authorization\Infrastructure\Persistence\Repository;

use \Authorization\Infrastructure\Persistence\Models\RecoveryModel;
use \Shared\Persistence\Abstracts\RepositoryBase;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class RecoveryRepository extends RepositoryBase {

    protected string $modelClass = RecoveryModel::class;

}
