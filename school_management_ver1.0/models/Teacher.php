<?php

require_once "BaseModel.php";
class Teacher extends BaseModel
{
    protected $table = 'teachers';
    private $id;
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function update($params)
    {
        if ($this->id == '' || $this->id == 0) return false;
        $sqlUpdate = "UPDATE {$this->table} SET `fullname`='$params[fullName]',`unit`='$params[unit]'
               ,`contactNumber`='$params[contactNumber]'
            WHERE $this->id_name='$this->id'";
        echo $sqlUpdate;
        return $this->conn->query($sqlUpdate);
    }
    public function setId($id){
        $this->id = $id;
    }
}