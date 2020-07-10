<?php

namespace Authorization\Entity;

use \Authorization\Service\HmacService;
use \CodeIgniter\Entity;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class User extends Entity {

    public function setPassword(string $password) {
        $this->attributes['password'] = (new HmacService())->hash($password);
        return $this;
    }

}
