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

        try {
            $pk = \Authorization\Config\Services::authRepository()->groupModel->insert($group);
            \Config\Services::alertMessages()->setMsgSuccess('Grupo cadastrado sucesso!');
            return $pk;
        } catch (\Exception $exc) {
            \Config\Services::alertMessages()->setMsgDanger('Erro ao salvar o grupo, verifique os campos e tente novamente.');
            return null;
        }
    }

    public function update(array $data): bool {
        $group = new \Authorization\Entity\User();
        $group->fill($data);

        try {
            \Authorization\Config\Services::authRepository()->groupModel->update($group->id, $group);
            \Config\Services::alertMessages()->setMsgSuccess('Grupo alterado sucesso!');
            return true;
        } catch (\Exception $ex) {
            \Config\Services::alertMessages()->setMsgDanger('Erro ao salvar o grupo, verifique os campos e tente novamente.');
            return false;
        }
    }

}
