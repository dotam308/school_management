<?php
require_once './connection.php';
require_once 'function/functions.php';
require_once './models/Register.php';
require_once './models/RegisterList.php';
require_once './models/Student.php';
require_once './models/Course.php';
require_once './models/Score.php';
global $conn;
$studentMod = new Student();
$registers = new Register();
$scoreModel = new Score();
if (isset($_GET['for'])) {
    $id = $_GET['for'];
    $type = $_GET['type'];
    global $idStudent;
    $idStudent = $id;

    $registers->setId($_GET['for']);
    $getStudent = $studentMod->get("$id");

    switch ($type) {
        case "view":
            $dataRegis = $registers->get("$_GET[for]");
            $view_file_name = 'module/register/view.php';
            break;
        case "add":
            $dataRegis = $registers->get("add");
            $courseTable = "(SELECT c.*, teachers.fullName
                         FROM courses c 
                         LEFT JOIN teachers 
                         ON c.teacherId = teachers.id WHERE c.courseName NOT IN 
                                (SELECT courseName 
                                 FROM `registers` 
                                 LEFT JOIN courses 
                                 ON registers.courseId = courses.id 
                                 WHERE registers.studentId = '$id' )) courses";
            $courseMod = new Course();
            $courseMod->setTable($courseTable);
            $courseList = $courseMod->get();
            $view_file_name = 'module/register/add.php';

            if (isset($_POST['btnSubmit'])) {
                if (count($_POST) > 1) {
                    $insertCourses = array();
                    foreach ($_POST as $key=>$value) {
                        if ($value != '') {
                            $course = new Course();
                            $dataCourse = $course->get($value);

                            $insertRegister = [
                                "courseId"=>"$dataCourse[id]",
                                "studentId"=> "$id"

                            ];
                            $insertScore = [
                                "courseId"=>"$dataCourse[id]",
                                "studentId"=> "$id",
                                "score"=>"0.0"

                            ];
                            if ($registers->insert($insertRegister) && $scoreModel->insert($insertScore)) {
                                header("location: registerCourses.php?type=add&for=$id&actionNow=added");
                            }

                        }
                    }

                }
            }
            break;
        case "delete":
            if (isset($_GET['for'])) {
                $courseId = $_GET['ele'];
                $studentId = $_GET['for'];
                $deleteOnRegisters = new RegisterList();
                $registerId = $deleteOnRegisters->getRegisterId($courseId, $studentId);
                $scoreStudent = new Score();
                $scoreId = $scoreStudent->getScoreId("$courseId", "$studentId");
                if ($deleteOnRegisters->delete($registerId) && $scoreStudent->delete($scoreId)) {
                    if (isset($_GET['combine'])) {
                        header("location: registerCourses.php?type=add&for=$studentId&actionNow=added&action=deleted");
                    }else {
                        header("location: ./queryOnRegister.php?type=view&for=$studentId&action=deleted");
                    }
                }   else {
                    echo $conn->error;
                }
            }
            break;
        default:
            break;
    }
}