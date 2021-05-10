<?php
require_once './connection.php';
require_once 'function/functions.php';
global $conn;
if (isset($_GET['for'])) {
    $id = $_GET['for'];
    $type = $_GET['type'];
    global $idStudent;
    $idStudent = $id;
    switch ($type) {
        case "view":
            $queryStudent = selectElementFrom('students', '*', "id='$id'");
            $getStudent = $queryStudent->fetch_assoc();

            $dataRegis = array();
            $selectRegis = selectElementFrom("registers", "*", "studentId = '$id'");
            while ($row = $selectRegis->fetch_assoc()) {

                $registeredCourses = selectElementFrom("courses", "`credit`, `courseName`,
                        `courseClassCode`, startTime, endTime, place, `teacherId`", "`id` = '$row[courseId]'")
                    ->fetch_all();

                for ($j = 0; $j < count($registeredCourses); $j++) {


                    $courseClassCode = $registeredCourses[$j][2];
                    $credit = $registeredCourses[$j][0];
                    $courseName = $registeredCourses[$j][1];
                    $time = $registeredCourses[$j][3] . "-" . $registeredCourses[$j][4];
                    $place = $registeredCourses[$j][5];

                    $idTeacher = $registeredCourses[$j][6];
                    $teacher = selectElementFrom("teachers", "fullName", "id = '$idTeacher'")
                        ->fetch_assoc()['fullName'];
                    $queryClass = selectElementFrom('classes', "*", "id='$getStudent[classId]'");
                    $getClass = $queryClass->fetch_assoc();
                    $courseId = $row['courseId'];
                    $queryAction = getActionForm('queryOnRegister.php', $row['studentId'], false, true,
                        "$courseId", false);
                    $dataRegis[] = [
                        "studentId" => "$getStudent[id]",
                        "fullName" => "$getStudent[fullName]",
                        "className" => "$getClass[className]",
                        "courseName" => "$courseName",
                        "courseClassCode" => "$courseClassCode",
                        "credit" => "$credit",
                        "teacher" => "$teacher",
                        "time" => "$time",
                        "place" => "$place",
                        "queryAction" => "$queryAction",
                    ];


                }
            }
            $view_file_name = 'module/register/view.php';
            break;
        case "add":
            $courseData = selectElementFrom("courses", "*", "1");
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

                ];
            }
            $view_file_name = 'module/register/add.php';
            break;
        case "delete":
            if (isset($_GET['for'])) {
                $courseId = $_GET['ele'];
                $sqlDeleteSelected = "DELETE FROM `registers` WHERE `courseId` = '$courseId'";
                $result = $conn->query($sqlDeleteSelected);
                if ($result) {
                    header("location: ./queryOnRegister.php?type=view&for=$_GET[for]&action=deleted");

                } else {
                    echo $conn->error;
                }
            }


            break;
        default:
            break;
    }
}

function checkExist( $data)
{
    global $idStudent;
    global $conn;
    $courseExits = array();
    $result = selectElementFrom("courses", "*", 1);
    foreach ($data as $key => $value) {
        while ($row = $result->fetch_assoc()) {

            if ($row['courseCode'] == $key) {
                $registeredCourses = array();

                $sqlGetRC = "SELECT `courseId` FROM `registers` WHERE `studentId` = '$idStudent'";
                $resFromGetRC = $conn->query($sqlGetRC)->fetch_all();

                $registeredCourses = array();
                for ($index = 0; $index < count($resFromGetRC); $index++) {
                    $registeredCourses[] = $resFromGetRC[$index][0];
                }
                global $exist;
                $exist = false;

                if (gettype($registeredCourses) == "array") {
                    for ($index = 0; $index < count($registeredCourses); $index++) {

                        $courseId = $registeredCourses[$index];

                        $sqlFindCourseNameThroughId = "SELECT`courseCode` FROM `courses` WHERE `id` = '$courseId'";
                        $courseN = $conn->query($sqlFindCourseNameThroughId)->fetch_all()[0][0];


                        if ($key == $courseN) {
                            $courseExits[] = $key;
                            $exist = true;
                        }
                    }
                }

                if (!$exist) {
                    $sqlUpdateRegisCourse = "INSERT INTO `registers` (`id`, `courseId`, `studentId`)
    VALUES (NULL, '$row[id]', '$idStudent');";

                    $sqlUpdateScore = "INSERT INTO `scores` (`id`, `score`, `courseId`, `studentId`)
    VALUES (NULL,0, '$row[id]', '$idStudent');";
                    if ($conn->query($sqlUpdateRegisCourse) && $conn->query($sqlUpdateScore)) {
                        header("location: queryOnRegister.php?type=view&for=$id");
                    } else {
                        echo 'error AT UpdateRegisCourse' . $conn->error;
                    }
                }
            }
        }

        $result = selectElementFrom("courses", "*", 1);
    }
    return $courseExits;
}