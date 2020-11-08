<?php

namespace Authorization\Infraestructure\Persistence\Entity;

use \Authorization\Config\Services;
use \CodeIgniter\Entity;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class User extends Entity {

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function setPassword(string $password) {
        $this->attributes['password'] = Services::hmacService()->hash($password);
        return $this;
    }

}
