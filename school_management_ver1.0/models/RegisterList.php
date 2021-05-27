<?php

require_once "BaseModel.php";
class RegisterList extends BaseModel
{

    protected $table = 'registers';
    protected $fields = ['id', 'studentId', 'courseId'];
    public function update($params)
    {
        // TODO: Implement update() method.
    }
    public function get($registerId="all")
    {
        if ($registerId=='all') {

            $queryClass = $this->conn->query("select * from {$this->table} ");
            return $queryClass ? $queryClass->fetch_all(MYSQLI_ASSOC) : null;
        } else if ($registerId=='nExisted'){
            return false;
        } else {
            $queryClass = $this->conn->query("select * from {$this->table} 
                            WHERE $this->id_name = '$registerId'");
            return $queryClass ? $queryClass->fetch_array(MYSQLI_ASSOC) : null;
        }
    }

    public function delete($registerId)
    {
        return $this->conn->query("DELETE from {$this->table} 
            WHERE $this->id_name = '$registerId'");
    }
    public function getRegisterId($courseId, $studentId)
    {
        $queryRegis = $this->conn->query("SELECT * FROM $this->table 
                        WHERE studentId=$studentId AND courseId=$courseId");
       $registerId = $queryRegis?$queryRegis->fetch_assoc()['id'] : 'nExisted';
       return $registerId;
    }


}