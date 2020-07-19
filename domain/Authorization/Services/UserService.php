<?php

namespace Authorization\Services;

use \Exception;

/**
 * Description of UserService
 *
 * @author Romário Beckman
 */
class UserService {

    function create(array $data) {
        $user = new \Authorization\Entity\User();
        $user->fill($data);

        try {
            $pk = \Authorization\Config\Services::authRepository()->userModel->insert($user);
            \Config\Services::alertMessages()->setMsgSuccess('Usuário cadastrado sucesso!');
            return $pk;
        } catch (Exception $exc) {
            \Config\Services::alertMessages()->setMsgDanger('Erro ao salvar o usuário, verifique os campos e tente novamente.', $exc);
            return null;
        }
    }

    public function update(array $data): bool {
        $user = new \Authorization\Entity\User();
        $user->fill($data);

        try {
            \Authorization\Config\Services::authRepository()->userModel->update($user->id, $user);
            \Config\Services::alertMessages()->setMsgSuccess('Usuário alterado sucesso!');
            return true;
        } catch (Exception $exc) {
            \Config\Services::alertMessages()->setMsgDanger('Erro ao salvar o usuário, verifique os campos e tente novamente.', $exc);
            return false;
        }
    }

}
