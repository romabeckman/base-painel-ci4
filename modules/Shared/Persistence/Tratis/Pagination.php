<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Shared\Persistence\Tratis;

/**
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
trait Pagination {

    public function getPaginated(string $search = '', string $orderBy = 'name', array ...$params) {
        $search = trim($search);
        $params['search'] = $search;

        $this->filter($params);
        $this->subSelect();

        return [
            'itens' => $this->model
                    ->selectDecrypted()
                    ->orderBy($orderBy)
                    ->paginate(PAGE_ITENS),
            'pager' => $this->model->pager,
            'total' => $this->model->countAllResults()
        ];
    }

    protected function filter(array $filter = []): void {

    }

    protected function subSelect(): void {

    }

}
