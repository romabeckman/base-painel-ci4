<?php

namespace Authorization\Infrastructure\Persistence\Repository;

use \Authorization\Infrastructure\Persistence\Models\RecoveryModel;
use \Shared\Persistence\Abstracts\BaseRepository;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class RecoveryRepository extends BaseRepository {

    protected string $modelClass = RecoveryModel::class;

}
