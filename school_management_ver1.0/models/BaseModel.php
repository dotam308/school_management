<?php
//require_once 'connection.php';
//require_once '../function/functions.php';
abstract class BaseModel
{
    protected $conn;
    protected $table = 'table';
    protected $id_name = 'id';
    protected $fields = [];
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function filter($params, $whereas=[], $refTable=[]) {
//        echo "abc";
//        dd($params);
        $orderBy = $params['order'] ?? 'id';
        $directBy = $params['direction'] ?? 'desc';
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $table = $params['table'] ?? "* FROM $this->table";
        if (in_array($orderBy, $this->fields)) {
            $pref = $this->table . ".";
        } else {
            $pref = '';
        }
        if ($limit == -1){
            $orderMethod = "ORDER BY $pref$orderBy $directBy";
        } else{
            $orderMethod = "ORDER BY $pref$orderBy $directBy LIMIT " . ($page - 1) * $limit . ", " . "$limit";
        }
        $sqlFilter = "SELECT $table WHERE ". $this->filterBy($whereas, $refTable) . " $orderMethod";
//        echo $sqlFilter;
        $result = $this->conn->query($sqlFilter);
        return $result->fetch_all(MYSQLI_ASSOC);

    }
    private function filterBy($condition, $refTables = []) {
//        dd($condition);
        $res = [];
        $ignoredElements = ['type', 'order', 'direction', 'page','filter', 'action'];
        foreach ($condition as $field => $value) {
            if (in_array($field, $ignoredElements)) continue;
            if (!empty($value) || $value === '0') {
                $pointerTable = '';
                foreach ($refTables as $key1=>$value1) {
                    if (in_array($field, $value1)) {
                        $pointerTable = $key1;
                        break;
                    }
                }
                if (in_array($field, $this->fields)) {
                    $res[] = $this->table. "." .$field . " LIKE " . "'$value%'";
                } else if (!empty($pointerTable)) {
                    $res[] = $pointerTable. "." .$field . " LIKE " . "'$value%'";
                } else {
                    $res[] = $field . " LIKE " . "'$value%'";
                }
            }
        }
        $res = implode(" AND ", $res);
        if (empty($res)) {
            return 1;
        }
        return $res;
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

    public function get($id="")
    {
        if ($id != 0 && $id != '') {
            $sqlGet = "select * from {$this->table} where $this->id_name= '$id'";
//            echo $sqlGet;
            return $this->conn->query($sqlGet)->fetch_assoc();
        } else {
            $sqlGet = "select * from {$this->table}";
//            echo $sqlGet;
            return $this->conn->query($sqlGet)->fetch_all(MYSQLI_BOTH);
        }
    }

    public function delete($id)
    {
        $sqlDelete = "DELETE from {$this->table} where $this->id_name= '$id'";
        echo $sqlDelete;
        return $this->conn->query($sqlDelete);
    }
    public function getSize(){
        return count($this->get(''));
    }
    public function setTable($table) {
        $this->table = $table;
    }
    public function getFields() {
        return $this->fields;
    }
    public abstract function update($params);
}
