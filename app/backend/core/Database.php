<?php

class Database
{
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;

    private function __construct()
    {
        try
        {
        $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';'.
                                'dbname='.Config::get('mysql/db_name')
            );
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance))
        {
            self::$_instance = new Database();
        }

        return self::$_instance;
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;

        if ($this->_query = $this->_pdo->prepare($sql))
        {
            $x = 1;
            foreach ($params as $param)
            if (count($param))
            {
                foreach ($param as $key => $val)

                {
                    $this->_query->bindvalue($x, $val);
                    $x++;
                }
            }

            if ($this->_query->execute())
            {
                $this->_results     = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count       = $this->_query->rowCount();
            }
            else
            {
                $this->_error = true;
            }
        }

        return $this;
    }

    public function action($action, $table, $where, $join)
    {
        if (!is_null($where) && !is_null($join))
        {
            $sql = "{$action} FROM {$table} JOIN {$join} WHERE {$where}";

        }
        else if (!is_null($where) && is_null($join))
        {
            $sql = "{$action} FROM {$table} WHERE {$where}";
        }
        else
        {
            $sql = "{$action} FROM {$table}";
        }

        $this-> query($sql);
        return $this;
    }

    public function getAll($table)
    {
        $this->action('SELECT *', $table, null, null);
        return $this->_results;

    }

    public function getWhere($table, $where)
    {
        $this->action('SELECT *', $table, $where, null);
        return $this->_results;
    }

    public function getJoin($tableSelect, $tableFrom, $where, $join)
    {
        $this->action('SELECT ' . $tableSelect .'.*', $tableFrom, $where, $join);
        return $this->_results;
    }

    public function getOneCol($column, $table, $where)
    {
        $this->action('SELECT ' . $column, $table, $where, null);
        return $this->_results;
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fieldsArr = array())
    {
        if (count($fieldsArr[0]))
        {

            $keys   = array_keys($fieldsArr[0]);
            $values = '';

            foreach ($fieldsArr as $array)
            {
                $values .= '(';
                $x = 1;

                    while ($x < count($array))
                    {
                        $values .= '?, ';
                        $x++;
                    }

                $values .='?), ';
            }

            $values = substr($values, 0, -2);

            $sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES {$values}";

            if (!$this->query($sql, $fieldsArr)->error())
            {
                return true;
            }
        }
        return false;
    }

    public function insertMultipleTables($mainTable, $fields = array(), $subordinateTables = array())
    {
        $this->_pdo->beginTransaction();

        try
        {
            $this-> insert($mainTable, [$fields]);
            $last_id = $this->_pdo->lastInsertId();

            foreach ($subordinateTables as &$array)
            {
                foreach ($array as &$row)
                {

                    $row['invoice_id'] = $last_id;
                }
            }
            unset($array, $row);

            foreach ($subordinateTables as $subArrays => $array)
            {
                $this-> insert($subArrays, $array);
            }

            $this->_pdo->commit();
        }
        catch (PDOException $e)
        {
            // Rollback the transaction
            $this->_pdo -> rollback();
            echo "Transaction failed: " . $e->getMessage();
        }
        return true;

    }

    public function update($table, $id, $fields)
    {
        $set    = '';
        $x      = 1;

        foreach ($fields as $name => $value)
        {
            $set .= "{$name} = ?";

            if ($x < count($fields))
            {
                $set .= ', ';
            }

            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE uid = {$id}";

        if (!$this->query($sql, $fields)->error())
        {
            return true;
        }

        return false;
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        return $this->results()[0];
    }

    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->_count;
    }
}
