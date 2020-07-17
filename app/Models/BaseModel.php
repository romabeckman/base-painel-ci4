<?php

namespace App\Models;

use \CodeIgniter\Database\ConnectionInterface;
use \CodeIgniter\Database\Query;
use \CodeIgniter\Model;
use \CodeIgniter\Validation\ValidationInterface;
use \stdClass;

/**
 * Description of BaseModel
 *
 * @author Romário Beckman
 */
class BaseModel extends Model {

    protected $encryptFields = [];

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null) {
        parent::__construct($db, $validation);

        helper('mysql');
    }

    public function insert($data = null, bool $returnID = true) {
        if (empty($this->encryptFields)) {
            return parent::insert($data, $returnID);
        } else {
            return $this->_save($data);
        }
    }

    public function update($id = null, $data = null): bool {
        if (empty($this->encryptFields)) {
            return parent::update($id, $data);
        } else {
            return $this->_save($data, $id);
        }
    }

    private function _save($data, $id = null) {
        if (empty($data)) {
            return;
        }

        // If $data is using a custom class with public or protected
        // properties representing the table elements, we need to grab
        // them as an array.
        if (is_object($data) && !$data instanceof stdClass) {
            $data = static::classToArray($data, $this->primaryKey, $this->dateFormat, false);
        }

        // If it's still a stdClass, go ahead and convert to
        // an array so doProtectFields and other model methods
        // don't have to do special checks.
        if (is_object($data)) {
            $data = (array) $data;
        }

        // Validate data before saving.
        if ($this->skipValidation === false) {
            if ($this->cleanRules()->validate($data) === false) {
                return false;
            }
        }

        // Must be called first so we don't
        // strip out created_at values.
        $data = $this->doProtectFields($data);

        // Set created_at and updated_at with same time
        $date = $this->setDate();

        if ($this->useTimestamps && is_null($id) && !empty($this->createdField) && !array_key_exists($this->createdField, $data)) {
            $data[$this->createdField] = $date;
        }

        if ($this->useTimestamps && !empty($this->updatedField) && !array_key_exists($this->updatedField, $data)) {
            $data[$this->updatedField] = $date;
        }

        helper('mysql');

        $pQuery = $this->db->prepare(function($db) use($data, $id) {
            $save = array_reduce(array_keys($data), function ($carry, $field) use ($id) {
                $carry .= is_null($id) ? '' : "{$field} = ";
                $carry .= (in_array($field, $this->encryptFields) ?
                        aesEncrypt('?') :
                        '?');
                return $carry . ', ';
            }, '');
            $save = substr($save, 0, -2);

            $sql = is_null($id) ?
                    "INSERT INTO {$this->table} (" . implode(', ', array_keys($data)) . ") VALUES (" . $save . ")" :
                    "UPDATE {$this->table} SET " . $save . " WHERE {$this->primaryKey} = ?";

            return (new Query($db))->setQuery($sql);
        });

        is_null($id) || $data[$this->primaryKey] = $id;

        $pQuery->execute(...array_values($data));

        $pQuery->close();

        return $this->db->insertID() === false ? $this->db->affectedRows() : $this->db->insertID();
    }

    /**
     *
     * @param array $select
     * @return $this
     */
    public function selectDecrypted(array $select = []) {
        if (empty($select)) {
            $select = $this->allowedFields;
            $select[] = $this->primaryKey;
            $this->createdField && $select[] = $this->createdField;
            $this->updatedField && $select[] = $this->updatedField;
            $this->deletedField && $select[] = $this->deletedField;
        }
        foreach ($select as $field) {
            $field = $this->escapeString($field);
            $this->select(in_array($field, $this->encryptFields) ? aesDecrypt('`' . $field . '`', $field) : '`' . $field . '`', false);
        }

        return $this;
    }

    /**
     *
     * @param string $field
     * @param string $data
     * @return \self
     */
    public function whereDecrypted(string $field, string $data): self {
        $data = $this->escapeString($data);

        $this->where($field, aesEncrypt($data), false);

        return $this;
    }

    /**
     *
     * @param string $field current model
     * @param \App\Models\BaseModel $model
     * @param string $fkField target, example: name
     * @param string $as
     * @return \self
     */
    public function subSelect(string $field, BaseModel $model, string $fkField, string $as = ''): self {
        $fkField = $this->escapeString($fkField);
        $field = $this->escapeString($field);

        $select = in_array($fkField, $model->encryptFields) ?
                aesDecrypt($fkField, $fkField) :
                $fkField;

        $sql = $model
                ->select($select, false)
                ->where($this->table . '.' . $field, $model->table . '.' . $model->primaryKey, false)
                ->limit(1)
                ->getCompiledSelect();

        $this->select('(' . $sql . ') as `' . (empty($as) ? $model->table . '_' . $fkField : $as) . '`', false);

        return $this;
    }

    /**
     *
     * @param string $fied
     * @param string $key
     * @param array $where
     * @param string $orderBy
     * @return type
     */
    public function dropdown(string $fied, string $key, array $where = [], string $orderBy = '') {
        $result = $this
                ->selectDecrypted([$fied, $key])
                ->where($where)
                ->orderBy($orderBy)
                ->findAll();

        return array_column($result, $fied, $key);
    }

}
