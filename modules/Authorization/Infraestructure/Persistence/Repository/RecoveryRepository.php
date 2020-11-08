<?php

namespace Authorization\Infraestructure\Persistence\Repository;

use \Shared\Persistence\Abstracts\RepositoryBase;
use \Authorization\Models\RecoveryModel;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class RecoveryRepository extends RepositoryBase {

    protected string $modelClass = RecoveryModel::class;

}
