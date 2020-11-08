<?php

namespace Shared\Application\Traits;

use \BadMethodCallException;
use \Config\Services;

/**
 * Description of Update
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
trait Save {

    public function save() {
        $post = $this->request->getPost();

        if (empty($post)) return $this->response->redirect(static::URL);

        $create = empty($post['id']);

        $rules = $this->rules();
        if (!$this->validate($rules)) return $create ? $this->create() : $this->update($post['id']);

        $post = array_map(
                fn($value) => is_array($value) || strlen(trim((string) $value)) > 0 ? $value : null,
                $post
        );

        if ($this->repository->getModel()->save($post)) {
            Services::alertMessages()->setMsgSuccess('Dados foram salvos com sucesso.');
            return $this->response->redirect(static::URL);
        }

        Services::alertMessages()->setMsgDanger('Erro ao salvar, verifique os campos e tente novamente.');

        return $create ? $this->create() : $this->update($post['id']);
    }

}
