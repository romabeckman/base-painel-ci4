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

        $save = array_reduce(array_keys($data), function ($carry, $field) use ($id) {
            if (is_null($id)) {
                $carry[$field] = '';
            } else {
                $carry[$field] = "{$field} = ";
            }

            $carry[$field] .= (in_array($field, $this->encryptFields) ?
                    'AES_ENCRYPT(?, @key)' :
                    '?');

            return $carry;
        }, []);

        $pQuery = $this->db->prepare(function($db) use($data, $save, $id) {
            if (is_null($id)) {
                $sql = "INSERT INTO {$this->table} (" . implode(', ', array_keys($save)) . ") "
                        . "VALUES (" . implode(', ', $save) . ")";
            } else {
                $sql = "UPDATE {$this->table} SET " . implode(', ', $save) . " WHERE {$this->primaryKey} = ?";
            }
            return (new Query($db))->setQuery($sql);
        });

        is_null($id) || $data[$this->primaryKey] = $id;

        $pQuery->execute(...array_values($data));

        $pQuery->close();

        return $this->db->insertID() === false ? $this->db->affectedRows() : $this->db->insertID();
    }

    /**
     * Decrypt data using AES_DECRYPT
     *
     * @return $this
     */
    public function selectDecrypted() {
        if (empty($this->encryptFields)) {
            return;
        }

        $select = array_diff($this->allowedFields, $this->encryptFields);
        $select[] = $this->primaryKey;
        $this->select($select);

        foreach ($this->encryptFields as $field) {
            $this->select(aesDecrypt($field), false);
        }

        return $this;
    }

    public function whereDecrypted(string $field, string $data) {
        $data = $this->escapeString($data);

        $this->where($field, aesEncrypt($data), false);

        return $this;
    }

}
