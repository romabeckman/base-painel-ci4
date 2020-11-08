<?php

namespace Shared\Application\Traits;

use \Config\Services;

/**
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
trait Delete {

    public function delete() {
        $valid = $this->validate(['id' => ['label' => static::DESCRIPTION, 'rules' => 'required']]);

        if (!$valid) {
            Services::alertMessages()->setMsgDanger($this->validator->getError('id'));
            return redirect()->back();
        }

        $id = $this->request->getPost('id');

        $this->repository->getModel()->delete($id);

        Services::alertMessages()->setMsgSuccess(static::DESCRIPTION . ' removida(o) com sucesso!');

        return redirect()->back();
    }

}
