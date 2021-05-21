<?php

require_once "BaseModel.php";
class Score extends BaseModel
{
    protected $table = 'scores';
    protected $studentId = 0;
    protected $courseId = 0;
    public function __construct($studentId, $courseId)
    {
        global $conn;
        $this->conn = $conn;
        $this->studentId = $studentId;
        $this->courseId = $courseId;
    }

    public function update($score)
    {
        $sqlUpdate = "UPDATE `scores` SET `score`='$score' 
            WHERE `courseId`='$this->courseId' AND `studentId` = '$this->studentId'";
        return $this->conn->query($sqlUpdate);
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