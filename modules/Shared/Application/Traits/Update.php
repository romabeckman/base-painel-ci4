<?php

namespace Shared\Application\Traits;

use \Config\Services;

/**
 * Description of Update
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
trait Update {

    public function update(?int $id = null) {
        $entity = $this->repository->getModel()->selectDecrypted()->find($id);

        if (empty($entity)) {
            Services::alertMessages()->setMsgWarning(static::DESCRIPTION . ' não encontrada(o).');
            return $this->response->redirect(static::URL);
        }

        $data = [
            'validation' => $this->validator,
            'entity' => $entity,
            'title' => 'Alterar ' . static::DESCRIPTION,
            'breadcrumb' => $this->breadcrumb(),
            'scriptTag' => ['jquery-mask', 'maskmoney']
        ];
        return Services::template()->templatePainel($data, 'save');
    }

}
