<?php
require_once "function/functions.php";
require_once "./connection.php";
require_once "./models/RegisterList.php";
require_once "./models/Score.php";
require_once "./models/ClassModel.php";
require_once "./models/Course.php";
require_once "./models/Student.php";
const REGISTER_TABLE = 'registers';
const LIMIT = 10;
$myTable = REGISTER_TABLE;
global $conn;
$registerList = new RegisterList();
$classModel = new ClassModel();
$courseModel = new Course();
$studentModel = new Student();
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    if ($type == 'view') {
        $table = " registers.id, registers.studentId, studentList.fullName, className, registers.courseId, credit,
                        courseCode, courseName, courseClassCode FROM `registers` 
                    LEFT JOIN (SELECT students.id studentId, students.fullName, classes.id classId, classes.className className 
                               FROM `students` 
                               LEFT JOIN classes
                               ON students.classId = classes.id  ) studentList
                               ON registers.studentId = studentList.studentId
                    LEFT JOIN courses ON registers.courseId = courses.id";
        $refTable = [
            "studentList" => ['studentId', 'fullName', 'classId', 'className', ],
            "courses" => $courseModel->getFields()
        ];
        if (isset($_POST['filter'])) {
            $link = http_build_query(array_merge($_GET, $_POST));
            header("location: manageRegister.php?$link&page=1");
        }
        if (isset($_GET['filter'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $registerList->filter(['table'=>"$table",
                "limit"=>'-1',
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST), $refTable);
            $totalRegister = count($result);
            $result = $registerList->filter(['table'=>"$table",
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST), $refTable);
        } else if (isset($_GET['order']) && isset($_GET['direction'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $registerList->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "table"=>"$table",
                "limit"=>'-1']);
            $totalRegister = count($result);
            $result = $registerList->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "table"=>"$table"]);

        }

        $dataRegis = array();
        $dataRegis = $result;
        $view_file_name = "module/registerList/view.php";
    }

    if (isset($_GET['type']) && isset($_GET['for']) && isset($_GET['ele'])) {
        $t = $_GET['type'];

        $studentId = $_GET['for'];
        $courseId = $_GET['ele'];
        $scoreStudent = new Score();
        $scoreId = $scoreStudent->getScoreId("$courseId", "$studentId");
        $registerStudent = new RegisterList();
        $registerId = $registerStudent->getRegisterId("$courseId", "$studentId");
        if ($t == 'delete') {

            if ($scoreStudent->delete($scoreId) && $registerStudent->delete($registerId)) {
                header("location: manageRegister.php?type=view&page=1&order=studentId&direction=DESC&action=deleted");
            } else {
                header("location: manageRegister.php?type=view&page=1&order=studentId&direction=DESC&action=notdeleted");
            }
        }
    }
}
