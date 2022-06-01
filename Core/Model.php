<?php

namespace Core;

use Exception;
use Core\DataBase;

abstract class Model
{    
    /** @var string adattábla neve */
    protected static string $dbTableName = '';

    public function __construct($data = 0)
    {
        $db = DataBase::getInstance();

        if ($data === 0) {
            $this->constructNew();
        } elseif (is_numeric($data)) {
            $this->constructRowById((int) $data, $db);
        }
    }

    abstract function constructNew();

    /**
     * Id alapján objektum feltöltése
     */
    protected function constructRowById(int $id, $db)
    {
        $tableName = $this->getDbTableName();
        $row = $db->connection->prepare('SELECT * FROM `' . $tableName . '` WHERE `id` = ?');
        $row->execute([$id]);
        
        $rowObject = $row->fetchObject();

        if (count(get_object_vars($rowObject)) === 0) {
            throw new Exception('Nincs ilyen azonosítójú adat!');
        }

        foreach ($rowObject as $key => $value) {
            if (!property_exists(get_called_class(), $key)) {
                throw new Exception('A az osztály nem rendelkezik ilyen propery-vel');
            }
            $this->$key = $value;
        }
    }

    /**
     * Ttábla nevének meghatározása
     */
    public function getDbTableName()
    {
        if (static::$dbTableName !== '') {
            return static::$dbTableName;
        } else {
            $className = get_called_class();
            return lcfirst(substr($className, strrpos($className, '\\') + 1));
        }
    }

    /**
     * Modeles mentés
     * 
     * @return void
     */
    public function save()
    {
        $db = DataBase::getInstance();
        $data = (array) $this;

        if ($data['id'] == 0) {
            $db->insert($this->getDbTableName(), $this->getDbVars($data, $db));
            $this->id = $db->getInsertId();
        } else {
            $db->update($this->getDbTableName(), $this->getDbVars($data, $db), 'id = ' . $data['id']);
        }
    }

    /**
     * Modeles törlés
     */
    public function delete()
    {
        if ($this->id > 0) {
            $db = DataBase::getInstance();
            $db->delete($this->getDbTableName(), 'id = ' . $this->id);
        }
    }

    /**
     * Model property adatok lekérése
     * 
     * @param array $data
     * 
     * @return array
     */
    private function getDbVars(array $data, $db = null) 
    {
        if ($db === null) {
            $db = DataBase::getInstance();
        }

        $dbVars = [];
        $tableColumns = $db->tableDescribe($this->getDbTableName());
        
        foreach ($tableColumns as $column) {
            if (array_key_exists($column, $data)) {
                $dbVars[$column] = $data[$column];
            }
        }

        return $dbVars;
    }
}