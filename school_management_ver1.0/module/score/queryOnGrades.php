<?php
$view_file_name ="module/score/view.php";
require_once "function/functions.php";
require_once "./connection.php";
require_once "./models/Score.php";
require_once "./models/Course.php";
updateStudentOnGrade();
global $conn;

const LIMIT = 10;
$myTable = 'scores';
$limit = "";

$scoreModel = new Score();
$courseModel = new Course();
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (count($_POST) != "" && isset($_POST['submit'])) {
//    dd($_POST);
    $updateData = $_POST;
    foreach ($updateData as $key => $value) {
        $courseID = getDetailData($key);
        $updateStudentScore = new Score();
        $updateStudentScore->setScoreId("", "$courseID[0]", "$courseID[1]");

        if ($updateStudentScore->update($value)) {
            header("location: queryOnSchoolGrade.php?type=view&page=1&order=studentId&direction=DESC&action=edited");
        } else {
        }
    }

}
$refTable = [
    "studentList" => ['studentId', 'fullName', 'classId', 'className' ],
    "courses" => $courseModel->getFields()
];
$table = "scores.id, scores.studentId, fullName, className, scores.courseId, credit, courseCode, courseName, courseClassCode, scores.score FROM `scores` 
                LEFT JOIN (SELECT students.id studentId, students.fullName, classes.id classId, classes.className className 
                           FROM `students` 
                           LEFT JOIN classes
                           ON students.classId = classes.id  ) studentList
                           ON scores.studentId = studentList.studentId
                LEFT JOIN courses ON scores.courseId = courses.id ";
if (isset($_POST['filter'])) {
    $link = http_build_query(array_merge($_GET, $_POST));
    header("location: queryOnSchoolGrade.php?$link&page=1");
}
if (isset($_GET['filter'])) {
    $orderBy = $_GET['order'];
    $direction = $_GET['direction'];
    $result = $scoreModel->filter(['table'=>"$table",
        "limit"=>'-1',
        'page'=>$page,
        "order"=>"$orderBy",
        "direction"=>"$direction",], array_merge($_GET, $_POST), $refTable);
    $totalRes = count($result);
    $result = $scoreModel->filter(['table'=>"$table",
        'page'=>$page,
        "order"=>"$orderBy",
        "direction"=>"$direction",], array_merge($_GET, $_POST), $refTable);
} else if (isset($_GET['order']) && isset($_GET['direction'])) {
    $orderBy = $_GET['order'];
    $direction = $_GET['direction'];
    $result = $scoreModel->filter(["order"=>"$orderBy",
        "direction"=>"$direction",
        "page"=>"$page",
        "table"=>"$table",
        "limit"=>'-1']);
    $totalRes = count($result);
    $result = $scoreModel->filter(["order"=>"$orderBy",
        "direction"=>"$direction",
        "page"=>"$page",
        "table"=>"$table"]);

}
$scoreList = array();
$scoreList = $result;
?>


