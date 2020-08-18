<?php

namespace Authorization\Services;

use \Authorization\Config\Services;
use \Authorization\Entity\User;

/**
 * Description of UserService
 *
 * @author Romário Beckman
 */
class UserService {

    function create(array $data) {
        $user = new User();
        $user->fill($data);
        $pk = Services::repository()->userModel->insert($user);
        return $pk;
    }

    public function update(array $data): void {
        $user = new User();
        $user->fill($data);
        Services::repository()->userModel->update($user->id, $user);
    }

}
