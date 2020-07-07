<?php

namespace Authorization\Entity;

use \CodeIgniter\Entity;
use \Config\Encryption;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class User extends Entity {

    public function setPassword(string $password) {
        $config = new Encryption();
        $pwd_peppered = hash_hmac($config->passwordAlgo, $password, $config->key);
        $this->attributes['password'] = password_hash($pwd_peppered, PASSWORD_BCRYPT);
        return $this;
    }

    public function validatePassword(string $password): bool {
        $config = new Encryption();
        $pwd_peppered = hash_hmac($config->passwordAlgo, $password, $config->key);
        return password_verify($pwd_peppered, $this->attributes['password']);
    }

}
