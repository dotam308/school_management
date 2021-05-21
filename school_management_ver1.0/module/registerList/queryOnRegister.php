<?php
require_once "function/functions.php";
require_once "./connection.php";
require_once "./models/RegisterList.php";
require_once "./models/Score.php";
const REGISTER_TABLE = 'registers';
const LIMIT = 10;
$myTable = REGISTER_TABLE;
global $conn;
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    if ($type == 'view') {
        $registerList = new RegisterList("", "");
        $limit = "";
        if (isset($_POST['filter'])) {
            $result = filterRegisterList();
            $totalRes = $result->num_rows;
            $result = filterRegisterList($limit);
        } else if (isset($_GET['order'])){
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];

            $table = "SELECT registers.id, registers.studentId, studentList.fullName, className, registers.courseId, credit, courseCode, courseName, courseClassCode FROM `registers` 
                    LEFT JOIN (SELECT students.id studentId, students.fullName, classes.id classId, classes.className className 
                               FROM `students` 
                               LEFT JOIN classes
                               ON students.classId = classes.id  ) studentList
                               ON registers.studentId = studentList.studentId
                    LEFT JOIN courses ON registers.courseId = courses.id";
            $result = $registerList->filter("$orderBy", "$direction", "-1", "$page", "$table");
            $totalRes = $result->num_rows;
            $result = $registerList->filter("$orderBy", "$direction", LIMIT, "$page", "$table");
        } else {
            $result = selectElementFrom("$myTable", "*", "1");
            $totalRes = $result->num_rows;
            $result = selectElementFrom("$myTable", "*", "1", "$limit");
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

        $scoreStudent = new Score("$studentId", "$courseId");
        $registerStudent = new RegisterList("$studentId", "$courseId");
        if ($t == 'delete') {

            if ($scoreStudent->delete() && $registerStudent->delete()) {
                header("location: manageRegister.php?type=view&page=1&order=studentId&direction=DESC&action=deleted");
            } else {
                header("location: manageRegister.php?type=view&page=1&order=studentId&direction=DESC&action=notdeleted");
            }
        }
    }
}
