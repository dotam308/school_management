<?php
require_once './connection.php';
require_once 'function/functions.php';
const REGISTER_TABLE = 'registers';
$myTable = REGISTER_TABLE;
global $conn;
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == 'view') {

        if (isset($_POST['filter'])) {
            $result = filterRegisterList();
        } else {
            $result = selectElementFrom("$myTable", "*", "1");
        }
        $dataRegis = array();
        while ($row = $result->fetch_assoc()) {

            $queryStudent = selectElementFrom('students', "*", "id='$row[studentId]'");

            $rowStudent = $queryStudent->fetch_assoc();

            $classId = $rowStudent['classId'];

            $queryClass = selectElementFrom('classes', "*", "id='$classId'");
            $thisClass = $queryClass->fetch_assoc();
            $className = $thisClass['className'];

            $queryCourse = selectElementFrom('courses', "*", "id='$row[courseId]'");
            $rowCourse = $queryCourse->fetch_assoc();

            $query = getActionForm('manageRegister.php', $row['studentId'], false, true,
                "$rowCourse[id]", true, false, $row['studentId']);

            $dataRegis[] = [
                "studentId" => "$row[studentId]",
                "fullName" => "$rowStudent[fullName]",
                "className" => "$className",
                "courseCode" => "$rowCourse[courseCode]",
                "courseName" => "$rowCourse[courseName]",
                "courseClassCode" => "$rowCourse[courseClassCode]",
                "credit" => "$rowCourse[credit]",
                "query" => "$query"

            ];
        }
        $view_file_name = "module/registerList/view.php";
    }

    if (isset($_GET['type']) && isset($_GET['for']) && isset($_GET['ele'])) {
        $t = $_GET['type'];

        $studentId = $_GET['for'];
        $courseId = $_GET['ele'];

        if ($t == 'delete') {

            $sqlDelete = "DELETE FROM `$myTable` WHERE studentId='$studentId' AND courseId='$courseId'";
            $sqlDeleteScore = "DELETE FROM `scores` WHERE studentId='$studentId' AND courseId='$courseId'";

            if ($conn->query($sqlDelete) && $conn->query($sqlDeleteScore)) {
                header("location: manageRegister.php?type=view&action=deleted");
            } else {
                header("location: manageRegister.php?type=view&action=notdeleted");
            }
        }
    }
}