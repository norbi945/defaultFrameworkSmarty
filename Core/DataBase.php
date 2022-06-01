<?php

namespace Core;

use PDO;
use PDOException;

final class DataBase
{
    /**
     * Adatbázis csatlakozás
     */
    public $connection;

    /**
     * Adatbázis kapcsolat kialakításáért felelő függvény
     */
    public function __construct()
    {
        $connectArray = [
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
        ];
    
        if ($this->connection === null) {
            $this->connection = new PDO('mysql:host=' . $connectArray['host'] . ';dbname=3dWebshop', $connectArray['user'], $connectArray['password']);
            $this->connection->exec('set names utf8');
        }
    }

    public static function getInstance()
    {
        return new self();
    }

    /**
     * Adatbázisba szúrás
     * 
     * @param string $table adatbázis neve
     * @param array
     * 
     * @return void
     */
    public function insert(string $table, array $data = []) 
    {
        if (!empty($data)) {
            if ($this->hasColumn($table, 'upTime')) {
                $data['upTime'] = time();
            }

            if ($this->hasColumn($table, 'id') && !array_key_exists('id', $data)) {
                $data['id'] = '';
            }

            $columnsArray = array_keys($data);
            $columns = '';
            $values = '';
            
            $lastDataKey = array_key_last($columnsArray);
            foreach ($columnsArray as $columnKey => $columnName) {
                $comma = '';
                if ($columnKey != $lastDataKey) {
                    $comma = ', ';
                }
                $columns .= '`' . $columnName . '`' . $comma;
                $values .= ':' . $columnName . $comma;
            }
            
            try {
                $this->connection->prepare('INSERT INTO `' . $table . '` (' . $columns . ') VALUES (' . $values . ')')->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * Adatbázisból törlés
     * 
     * @param string $table
     * @param string $where
     * 
     * @return void
     */
    public function delete(string $table, string $where)
    {
        try {
            if ($this->hasColumn($table, 'delTime')) {
                $this->update($table, ['delTime' => time()], $where, true);
            } else {
                $this->connection->prepare('DELETE FROM `' . $table . '` WHERE ' . $where)->execute();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Adatbázisból törlés
     * 
     * @param string $table
     * @param array $data
     * @param string $where
     * @param bool $fromDelete törlés céljából
     * 
     * @return void
     */
    public function update(string $table, array $data, string $where, bool $fromDelete = false)
    {
        try {
            if ($this->hasColumn($table, 'modTime') && !$fromDelete) {
                $data['modTime'] = time();
            }

            $columns = array_keys($data);
            $lastDataKey = array_key_last($data);
            $set = '';
            foreach ($columns as $columnName) {
                $comma = '';
                if ($columnName != $lastDataKey) {
                    $comma = ', ';
                }
                $set .=  ' `' . $columnName . '` = :' . $columnName . $comma;
            }

            $this->connection->prepare('UPDATE `' . $table . '` SET ' . $set . ' WHERE ' . $where)->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Adattábla leírása
     * 
     * @param string $table
     * @param string $column
     * 
     * @return bool
     */
    private function hasColumn(string $table, string $column)
    {
        try {
            return in_array($column, $this->tableDescribe($table));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Tábla oszlopainak lekérése
     */
    public function tableDescribe(string $table)
    {
        $query = $this->connection->prepare("DESCRIBE $table");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * utolsó beszúrt azonosító
     */
    public function getInsertId()
    {
        return $this->connection->lastInsertId();
    }
}