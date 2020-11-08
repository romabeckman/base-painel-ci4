<?php

namespace Shared\Application\Traits;

/**
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
trait Breadcrumb {

    private function breadcrumb(): array {
        return [
            static::URL => static::DESCRIPTION
        ];
    }

}
