<?php

require_once "BaseModel.php";
class RegisterList extends BaseModel
{

    protected $table = 'registers';
    protected $studentId = 0;
    protected $courseId = 0;
    public function __construct($studentId, $courseId)
    {
        global $conn;
        $this->conn = $conn;
        $this->studentId = $studentId;
        $this->courseId = $courseId;
    }
    public function update($params)
    {
        // TODO: Implement update() method.
    }
    public function get()
    {
        $queryClass = $this->conn->query("select * from {$this->table} 
                            WHERE `courseId`='$this->courseId' AND `studentId` = '$this->studentId'");
        return $queryClass ? $queryClass->fetch_array(MYSQLI_ASSOC) : null;
    }

    public function delete()
    {
        return $this->conn->query("DELETE from {$this->table} 
            WHERE `courseId`='$this->courseId' AND `studentId` = '$this->studentId'");
    }
}