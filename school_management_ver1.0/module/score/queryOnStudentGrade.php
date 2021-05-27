<?php
require_once 'function/functions.php';
require_once 'connection.php';
require_once './models/Register.php';
require_once './models/Student.php';
require_once './models/Score.php';

updateStudentOnGrade();
global $conn;

$idStudent = isset($_GET['for']) ? $_GET['for'] : "";
if ($idStudent != "") {
    $view_file_name = "module/score/viewStudentGrade.php";

    $sum = 0;
    $toTalCredit = 0;
    $studentModel = new Student();
    $currentStudent = $studentModel->get($idStudent);
    $studentName = $currentStudent['fullName'];
    $scoreModel = new Score();
    $table = "(SELECT scores.*, courses.courseName, courses.credit, courses.courseCode FROM `scores` 
             LEFT JOIN courses
              ON scores.courseId = courses.id
              WHERE studentId='$idStudent') scores";
    $scoreModel->setTable($table);
    $queryStudent = $scoreModel->get();
//    dd($queryStudent);

}
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
    $updateData = $_POST;
//    dd($updateData);
    $success = false;
    $countSuccess = 0;
    foreach ($updateData as $key => $value) {
        if ($key == 'submit') break;
        $info = getDetailData($key);

        $courseIdPart = $info[0];
        $studentId = $info[1];
        $sqlUpdate = "UPDATE `scores` SET `score`= $value WHERE `courseId`='$courseIdPart' AND `studentId` = '$studentId'";
//        dd($sqlUpdate);
        if ($conn->query($sqlUpdate)) {
            $countSuccess++;
        } else {
        }
    }
    if ($countSuccess == (count($updateData) - 1)) {
        header("location: queryOnStudentGrade.php?for=$idStudent&action=updated");
    }
}