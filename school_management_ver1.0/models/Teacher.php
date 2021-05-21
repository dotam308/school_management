<?php

require_once "BaseModel.php";
class Teacher extends BaseModel
{
    protected $table = 'teachers';
    public function __construct($id)
    {
        global $conn;
        $this->conn = $conn;
        $this->id = $id;
    }

    public function update($params)
    {
        $sqlUpdate = "UPDATE {$this->table} SET `fullname`='$params[fullName]',`unit`='$params[unit]'
               ,`contactNumber`='$params[contactNumber]'
            WHERE id='$this->id'";
        echo $sqlUpdate;
        return $this->conn->query($sqlUpdate);
    }
}