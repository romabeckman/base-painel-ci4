<?php

namespace Authorization\Infraestructure\Persistence\Repository;

use \Authorization\Infraestructure\Persistence\Models\RecoveryModel;
use \Shared\Persistence\Abstracts\RepositoryBase;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class RecoveryRepository extends RepositoryBase {

    protected string $modelClass = RecoveryModel::class;

}
