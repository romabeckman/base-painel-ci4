<?php

namespace Authorization\Services;

/**
 * Description of UserService
 *
 * @author Romário Beckman
 */
class UserService {

    function create(array $data) {
        $user = new \Authorization\Entity\User();
        $user->fill($data);
        $pk = \Authorization\Config\Services::authRepository()->userModel->insert($user);
        return $pk;
    }

    public function update(array $data): void {
        $user = new \Authorization\Entity\User();
        $user->fill($data);
        \Authorization\Config\Services::authRepository()->userModel->update($user->id, $user);
    }

}
