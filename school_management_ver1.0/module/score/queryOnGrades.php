<?php
$view_file_name ="module/score/view.php";
require_once "function/functions.php";
require_once "./connection.php";
require_once "./models/Score.php";
updateStudentOnGrade();
global $conn;

const LIMIT = 10;
$myTable = 'scores';
$limit = "";

$scoreModel = new Score("", "");
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $limit = "LIMIT " . ($page - 1) * LIMIT . ", " . LIMIT;
}
if (count($_POST) != "" && isset($_POST['submit'])) {
    $updateData = $_POST;
    foreach ($updateData as $key => $value) {
        $courseID = getDetailData($key);
        $updateStudentScore = new Score("$courseID[1]", "$courseID[0]");

        if ($updateStudentScore->update($value)) {
            header("location: queryOnSchoolGrade.php?type=view&page=1&order=studentId&direction=DESC&action=edited");
        } else {
        }
    }

}
if (isset($_POST['filter'])) {
    $result = filterScores();
    $totalRes = $result->num_rows;
    $result = filterScores($limit);

} else if (isset($_GET['order'])) {
    $orderBy = $_GET['order'];
    $direction = $_GET['direction'];
    $table = "SELECT scores.id, scores.studentId, fullName, className, scores.courseId, credit, courseCode, courseName, courseClassCode, scores.score FROM `scores` 
                LEFT JOIN (SELECT students.id studentId, students.fullName, classes.id classId, classes.className className 
                           FROM `students` 
                           LEFT JOIN classes
                           ON students.classId = classes.id  ) studentList
                           ON scores.studentId = studentList.studentId
                LEFT JOIN courses ON scores.courseId = courses.id ";
    $result = $scoreModel->filter("$orderBy", "$orderBy", -1, "$page", "$table");
    $totalRes = $result->num_rows;
    $result = $scoreModel->filter("$orderBy", "$orderBy", LIMIT, "$page", "$table");
} else {
    $result = selectElementFrom('scores', "*", "1");
}

if ($result) {
    $scoreList = array();
    while ($data = $result->fetch_assoc()) {
        $selectStudent = selectElementFrom('students', "*", "id = '$data[studentId]'");
        $student = $selectStudent->fetch_assoc();
        $name = $student['fullName'];
        $classId = $student['classId'];

        $selectClass = selectElementFrom('classes', "*", "id = '$classId'");
        $class = $selectClass->fetch_assoc();

        $class = $class['className'];

        $selectCourse = selectElementFrom('courses', "*", "id = '$data[courseId]'");
        $course = $selectCourse->fetch_assoc();
        $courseName = $course['courseName'];

        $position = $course['id'] . "_" . "$data[studentId]";
        $scoreList[] = [
            "studentId" => $data['studentId'],
            "studentName" => $name,
            "class" => $class,
            "courseName" => $courseName,
            "courseCode" => $course['courseCode'],
            "score" => $data['score'],
            "position" => $position

        ];
    }
} else {
    echo "error at GetData";
}
?>


