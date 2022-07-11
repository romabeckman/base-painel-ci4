<?php

namespace Shared\Persistence\Abstracts;

use \CodeIgniter\Model;
use \InvalidArgumentException;
use const \PAGE_ITENS;

/**
 * Description of BaseRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
abstract class BaseRepository {

    protected string $modelClass;
    private Model $model;

    function __construct() {
        $this->makeModel();
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    private function makeModel(): void {
        if (is_null($this->modelClass)) throw new InvalidArgumentException('$modelClass must be not empty or null.');

        $this->model = new $this->modelClass();
    }

    /**
     *
     * @param string $fkFieldId current model
     * @param \App\Models\BaseModel $model The Model related
     * @param string $seletcField target, example: name
     * @param string $showAs How it will shown
     * @return \self
     */
    protected function subSelect(string $fkFieldId, BaseModel $model, string $seletcField, string $showAs = ''): BaseModel {
        $seletcField = $this->getModel()->escapeString($seletcField);
        $fkFieldId = $this->getModel()->escapeString($fkFieldId);

        $sql = $model
                ->select($seletcField, false)
                ->where(
                        key: $this->getModel()->getTableName() . '.' . $fkFieldId,
                        value: $model->getTableName() . '.' . $model->primaryKey,
                        escape: false
                )
                ->limit(1)
                ->builder()
                ->getCompiledSelect();

        return $this->getModel()->select('(' . $sql . ') as `' . (empty($showAs) ? $table . '_' . $seletcField : $showAs) . '`', false);
    }

    /**
     * @return Model
     */
    public function getModel(bool $renew = FALSE): BaseModel {
        if ($renew) {
            $this->makeModel();
        }
        return $this->model;
    }

    /**
     * @param string $value
     * @param string $key
     * @param array $filter
     * @param string|null $orderBy
     * @return array
     */
    public function getToDropdown(string $value, string $key, ?array $filter = null, ?string $orderBy = null): array {
        $filter && $this->filter($filter);
        $this->model->orderBy($orderBy ?: $value . ' asc');

        $result = $this->model
                ->select([$value, $key])
                ->findAll();

        return array_column($result, $value, $key);
    }

    /**
     *
     * @param string $search
     * @param string $orderBy
     * @param array $params
     * @return type
     */
    public function getPaginated(string $search = '', string $orderBy = 'name', array ...$params) {
        $model = $this->getModel();

        $search = trim($search);
        $params['search'] = $search;

        $this->subQueries();
        $this->filter($params);

        return [
            'itens' => $model
                    ->select($model->getTableName() . '.*')
                    ->orderBy($orderBy)
                    ->paginate(PAGE_ITENS),
            'pager' => $model->pager,
            'total' => $model->countAllResults()
        ];
    }

    /**
     *
     * @param array $filter
     * @return void
     */
    protected function filter(array $filter = []): void {

    }

    /**
     *
     * @return void
     */
    protected function subQueries(): void {

    }

}
