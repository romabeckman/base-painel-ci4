<?php

namespace Authorization\Services;

/**
 * Description of UserService
 *
 * @author Romário Beckman
 */
class GroupService {

    function create(array $data) {
        $group = new \Authorization\Entity\Group();
        $group->fill($data);
        return \Authorization\Config\Services::repository()->groupModel->insert($group);
    }

    public function update(array $data): void {
        $group = new \Authorization\Entity\User();
        $group->fill($data);
        \Authorization\Config\Services::repository()->groupModel->update($group->id, $group);
    }

}
