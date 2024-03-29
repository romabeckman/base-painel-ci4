<?php

namespace Authorization\Infrastructure\Persistence\Entity;

use \Authorization\Config\Services;
use \CodeIgniter\Entity;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class User extends Entity {

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'force_change_password' => 'boolean'
    ];

    public function setPassword(string $password) {
        $this->attributes['password'] = Services::hmacService()->hash($password);
        return $this;
    }

}
