<?php

namespace Shared\Persistence\Abstracts;

use \App\Models\BaseModel;
use \InvalidArgumentException;
use \Shared\Persistence\Tratis\Pagination;

/**
 * Description of RepositoryBase
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
abstract class RepositoryBase {

    use Pagination;

    protected string $modelClass;
    private BaseModel $model;

    function __construct() {
        $this->makeModel();
    }

    private function makeModel(): void {
        if (is_null($this->modelClass)) throw new InvalidArgumentException('$modelClass must be not empty or null.');

        $this->model = new $this->modelClass();
    }

    public function getModel(): BaseModel {
        return $this->model;
    }

    public function getToDropdown(string $value, string $key, ?array $filter = null, ?string $orderBy = null): array {
        $filter && $this->filter($filter);
        $this->model->orderBy($orderBy ?: $value . ' asc');

        $result = $this->model
                ->selectDecrypted([$value, $key])
                ->findAll();

        return array_column($result, $value, $key);
    }

}
