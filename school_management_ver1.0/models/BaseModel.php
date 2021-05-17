<?php
require_once './connection.php';
require_once './function/functions.php';

abstract class BaseModel
{
    protected $conn;
    protected $table = 'table';
    protected $id_name = 'id';

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function get($id)
    {
        $queryClass = $this->conn->query("select * from {$this->table} where {$this->id_name} = {$id}");
        return $queryClass ? $queryClass->fetch_array(MYSQLI_ASSOC) : null;
    }

    public function delete($id)
    {
        $this->conn->query("DELETE from {$this->table} where {$this->id_name} = {$id}");
    }

    public function insert($params)
    {
        $sqlInsert = "INSERT INTO {$this->table} (";
        foreach ($params as $key => $value) {
            $sqlInsert .= "$key" . ", ";
        }
        $sqlInsert = substr($sqlInsert, 0, strlen($sqlInsert) - 2);
        $sqlInsert .= ") VALUES (";
        foreach ($params as $key => $value) {
            $sqlInsert .= "'$value', ";
        }
        $sqlInsert = substr($sqlInsert, 0, strlen($sqlInsert) - 2);
        $sqlInsert .= ")";
        $result = $this->conn->query($sqlInsert);
    }

    public function filter($column, $direction = 'DESC', $limit = 10, $page = 1)
    {
        $condition = '1';
        $condition .= ' ORDER BY ' . $column . ' ' . $direction . ' LIMIT ' . ($limit * ($page - 1)) . ', ' . $limit;
        $sqlSelect = "SELECT * FROM {$this->table} WHERE $condition";
        return $this->conn->query($sqlSelect);
    }
}
