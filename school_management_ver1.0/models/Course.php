<?php
require_once "BaseModel.php";

class Course extends BaseModel
{
    protected $table = "courses";
    protected $fields = ['id', 'courseClassCode', 'courseCode', 'courseName', 'credit', 'endTime', 'startTime',
        'maxStudent', 'teacherId', 'place'];
    private $id='';
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function update($params)
    {
        if ($this->id =='' || $this->id == '0') return false;
        $sqlUpdate = "UPDATE `courses` SET`credit`='$params[credit]',`startTime`='$params[startTime]',
                    `endTime`='$params[endTime]',`place`='$params[place]',`courseCode`='$params[courseCode]',
                    `courseName`='$params[courseName]', `courseClassCode`='$params[courseClassCode]',
                    `maxStudent`='$params[maxStudent]',`teacherId`='$params[teacherId]' WHERE $this->id_name='$this->id'";

        return $this->conn->query($sqlUpdate);
    }
    public function setId($id) {
        $this->id = $id;
    }
}