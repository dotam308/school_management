<?php
//require_once 'connection.php';
//require_once '../function/functions.php';

abstract class BaseModel
{
    protected $conn;
    protected $table = 'table';
    protected $id = 0;


    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }
    public function filter($column, $direction = 'DESC', $limit = 10, $page = 1, $table="")
    {
        $condition = '1';
        if ($limit != -1)
        {
            $condition .= ' ORDER BY ' . $column . ' ' . $direction . ' LIMIT ' . ($limit * ($page - 1)) . ', ' . $limit;
        } else {
            $condition .= ' ORDER BY ' . $column . ' ' . $direction;
        }
        if ($table == "" )
        {
            $sqlSelect = "SELECT * FROM {$this->table} WHERE $condition";
        }
        else
        {
            $sqlSelect = "$table" . " WHERE $condition";
        }

//        echo $sqlSelect;
        return $this->conn->query($sqlSelect);
    }

    public function insert($params)
    {
        $sqlInsert = "INSERT INTO {$this->table} (";
        foreach ($params as $key => $value) {
            $sqlInsert .= "`$key`" . ", ";
        }
        $sqlInsert = substr($sqlInsert, 0, strlen($sqlInsert) - 2);
        $sqlInsert .= ") VALUES (";
        foreach ($params as $key => $value) {
            $sqlInsert .= "'$value', ";
        }
        $sqlInsert = substr($sqlInsert, 0, strlen($sqlInsert) - 2);
        $sqlInsert .= ")";
        $result = $this->conn->query($sqlInsert);
        return $result;
    }

    public function get()
    {
        if ($this->id != 0 && $this->id != '') {
            $sqlGet = "select * from {$this->table} where id= '{$this->id}'";
            return $this->conn->query($sqlGet)->fetch_assoc();
        } else {
            $sqlGet = "select * from {$this->table}";
        }
//        echo $sqlGet;
        return $this->conn->query($sqlGet);
    }

    public function delete()
    {
        $sqlDelete = "DELETE from {$this->table} where id= '{$this->id}'";
        echo $sqlDelete;
        return $this->conn->query($sqlDelete);
    }
    public abstract function update($params);
}
