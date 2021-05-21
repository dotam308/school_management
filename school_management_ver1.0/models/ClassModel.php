<?php
require_once "BaseModel.php";

class ClassModel extends BaseModel
{
    protected $table = "classes";
    public function __construct($id)
    {
        global $conn;
        $this->conn = $conn;
        $this->id = $id;
    }

    public function update($params)
    {
        $sqlUpdate = "UPDATE `$this->table`
                            SET `className`='$params[className]',`maxStudent`='$params[maxStudent]',
                            `teacherId`='$params[teacherId]'
                            WHERE id='$this->id'";
        return $this->conn->query($sqlUpdate);
    }
}