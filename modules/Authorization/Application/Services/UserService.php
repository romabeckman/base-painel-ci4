<?php

namespace Authorization\Application\Services;

use \Authorization\Config\Services as AuthorizationService;
use \Authorization\Infraestructure\Persistence\Entity\User;

/**
 * Description of UserService
 *
 * @author Romário Beckman
 */
class UserService {

    function create(array $data) {
        $user = new User();
        $user->fill($data);
        $pk = AuthorizationService::userRepository()->getModel()->insert($user);
        return $pk;
    }

    public function update(array $data): void {
        $user = new User();
        $user->fill($data);
        AuthorizationService::userRepository()->getModel()->update($user->id, $user);
    }

}
