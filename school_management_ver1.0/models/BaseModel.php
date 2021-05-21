<?php
//require_once 'connection.php';
//require_once '../function/functions.php';

abstract class BaseModel
{
    protected $conn;
    protected $table = 'table';
    protected $searchable = ['id', 'fullName', 'dkdkk'];
    protected $id = 0;


    public function __construct($id = '')
    {
        global $conn;
        $this->conn = $conn;
        $student = new Student();
        $results = $student->filter($_GET);
    }

    public function filter($params, $wheres = [])
    {
        $orderBy = $params['order'] ?? 'id';
        $directBy = $params['order'] ?? 'desc';
        $page = $params['page'] ?? 1;
        $limit = 10;
        $search = [];
        foreach ($this->searchable as $field) {
            if (isset($params[$field])) {
                $search[$field] = $params[$field];
            }
        }
        $searchQuery = $this->buildSearchQuery($search);
        $whereQuery = $this->buildQuery($wheres);

        $fullQuery = 'xxxx';
        return $this->conn->query($sqlSelect);
    }

    private function buildQuery($wheres)
    {
        $res = [];
        foreach ($wheres as $field => $value) {
            $res[] = $field . ' = "%' . $value . '%"';
        }
        $res = join(' AND ', $res);
        return $res;
    }

    private function buildSearchQuery($search)
    {
        if (empty($search)) {
            return null;
        }
        $res = [];
        foreach ($search as $field => $value) {
            $res[] = $field . ' like "%' . $value . '%"';
        }
        $res = join(' AND ', $res);
        return "(" . $res . ")";
    }

    public function filter($column, $direction = 'DESC', $limit = 10, $page = 1, $table = "")
    {
        $condition = '1';
        if ($limit != -1) {
            $condition .= ' ORDER BY ' . $column . ' ' . $direction . ' LIMIT ' . ($limit * ($page - 1)) . ', ' . $limit;
        } else {
            $condition .= ' ORDER BY ' . $column . ' ' . $direction;
        }
        if ($table == "") {
            $sqlSelect = "SELECT * FROM {$this->table} WHERE $condition";
        } else {
            $sqlSelect = "$table";
            if ($limit != -1) {
                $sqlSelect .= " LIMIT " . ($limit * ($page - 1)) . ', ' . $limit;
            }
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

    public function countAll()
    {

    }

    public function delete()
    {
        $sqlDelete = "DELETE from {$this->table} where id= '{$this->id}'";
        echo $sqlDelete;
        return $this->conn->query($sqlDelete);
    }

    public abstract function update($params);
}
