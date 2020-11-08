<?php

namespace Shared\Application\Traits;

use \Config\Services;

/**
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
trait Create {

    public function create() {
        $data = [
            'validation' => $this->validator,
            'title' => 'Novo(a) ' . static::DESCRIPTION,
            'breadcrumb' => $this->breadcrumb(),
            'scriptTag' => ['jquery-mask', 'maskmoney']
        ];
        return Services::template()->templatePainel($data, 'save');
    }

}
