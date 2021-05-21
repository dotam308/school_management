<?php
require_once "BaseModel.php";

class Course extends BaseModel
{
    protected $table = "courses";
    public function __construct($id)
    {
        global $conn;
        $this->conn = $conn;
        $this->id = $id;
    }

    public function update($params)
    {
        $sqlUpdate = "UPDATE `courses` SET`credit`='$params[credit]',`startTime`='$params[startTime]',
                    `endTime`='$params[endTime]',`place`='$params[place]',`courseCode`='$params[courseCode]',
                    `courseName`='$params[courseName]', `courseClassCode`='$params[courseClassCode]',
                    `maxStudent`='$params[maxStudent]',`teacherId`='$params[teacherId]' WHERE id='$this->id'";

        return $this->conn->query($sqlUpdate);
    }
}