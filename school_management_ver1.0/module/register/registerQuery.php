<?php
require_once './connection.php';
require_once 'function/functions.php';
require_once './models/Register.php';
require_once './models/RegisterList.php';
require_once './models/Student.php';
require_once './models/Course.php';
global $conn;
if (isset($_GET['for'])) {
    $id = $_GET['for'];
    $type = $_GET['type'];
    global $idStudent;
    $idStudent = $id;

    $newStudent = new Student("$id");
    $getStudent = $newStudent->get();

    $registers = new Register("$id");
    switch ($type) {
        case "view":
            $dataRegis = $registers->get();
            $view_file_name = 'module/register/view.php';
            break;
        case "add":
            $dataRegis = $registers->get("add");
            $sqlSelectCourse = "SELECT * FROM courses c
                        WHERE c.courseName NOT IN (SELECT courseName FROM `registers`
                                    LEFT JOIN courses 
                                    ON registers.courseId = courses.id WHERE studentId = '$id')";
            $courseData = $conn->query($sqlSelectCourse);
            $courseList = array();
            while ($row = $courseData->fetch_assoc()) {
                $idTeacher = $row['teacherId'];
                $teacher = selectElementFrom("teachers", "fullName", "id = '$idTeacher'")
                    ->fetch_assoc()['fullName'];

                $courseList[] = [
                    "courseName" => "$row[courseName]",
                    "courseCode" => "$row[courseCode]",
                    "courseClassCode" => "$row[courseClassCode]",
                    "credit" => "$row[credit]",
                    "teacher" => "$teacher",
                    "time" => "$row[startTime]-$row[endTime]",
                    "place" => "$row[place]",
                    "courseId" => "$row[id]"

                ];
            }
            $view_file_name = 'module/register/add.php';

            if (isset($_POST['btnSubmit'])) {
                if (count($_POST) > 1) {
                    $insertCourses = array();
                    foreach ($_POST as $key=>$value) {
                        if ($value != '') {
                            $course = new Course("$value");
                            $dataCourse = $course->get();

                            $insertRegister = [
                              "id"=>'NULL',
                                "courseId"=>"$dataCourse[id]",
                                "studentId"=> "$id"

                            ];
                            if ($registers->insert($insertRegister)) {
                                header("location: registerCourses.php?type=add&for=19020514&actionNow=added");
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

                $deleteOnRegisters = new RegisterList("$studentId", "$courseId");
                if ($deleteOnRegisters->delete()) {
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