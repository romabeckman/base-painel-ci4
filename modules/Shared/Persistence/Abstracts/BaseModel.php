<?php

namespace Shared\Persistence\Abstracts;

use \CodeIgniter\Model;

/**
 * Description of BaseRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
abstract class BaseModel extends Model {

    public function getTableName(): string {
        return $this->table;
    }

}
