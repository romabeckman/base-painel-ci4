<?php

namespace Authorization\Entity;

use \CodeIgniter\Entity;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Recovery extends Entity {

    public function setToken() {
        $this->attributes['token'] = hash_hmac('sha256', uniqid(), '');
    }

}
