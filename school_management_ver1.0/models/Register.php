<?php
require_once "BaseModel.php";

class Register extends BaseModel
{
    protected $table = "registers";
    public function __construct($id)
    {
        global $conn;
        $this->conn = $conn;
        $this->id = $id;
    }

    public function get($position="")
    {
        $selectRegister = "SELECT registers.id, registers.courseId, registers.studentId, students.fullName, className, courses.teacherId, teachers.fullName teacher,
                            classId, courseName, courseClassCode, credit, startTime, endTime, place FROM `registers`
                            LEFT JOIN students ON registers.studentId = students.id
                            LEFT JOIN courses ON registers.courseId = courses.id
                            LEFT JOIN classes ON students.classId = classes.id
                            LEFT JOIN teachers ON courses.teacherId = teachers.id
                             WHERE studentId = '$this->id'";
//        echo $selectRegister;
        $registers = $this->conn->query($selectRegister);
        $dataRegis = array();
        while ($row = $registers->fetch_assoc()) {

            if ($position == "") {

                $queryAction = getActionForm('queryOnRegister.php', "$row[studentId]", false, true,
                    "$row[courseId]", false);
            } else {
                $queryAction = getActionForm("queryOnRegister.php?combine=$position", "$row[studentId]", false, true,
                    "$row[courseId]", false, false, "", "combine");
            }
            $dataRegis[] = [
                "studentId" => "$this->id",
                "fullName" => "$row[fullName]",
                "className" => "$row[className]",
                "courseName" => "$row[courseName]",
                "courseClassCode" => "$row[courseClassCode]",
                "credit" => "$row[credit]",
                "teacher" => "$row[teacher]",
                "time" => "$row[startTime] - $row[endTime]",
                "place" => "$row[place]",
                "queryAction" => "$queryAction",
            ];
        }



        return $dataRegis;
    }

    public function update($params)
    {
        // TODO: Implement update() method.
    }
}