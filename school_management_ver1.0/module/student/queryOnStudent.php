<?php
require_once "function/functions.php";
require_once "./connection.php";
require_once "./models/Student.php";
require_once "./models/User.php";
const STUDENT_TABLE = 'students';
const LIMIT = 10;

$studentModels = new Student();
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    global $conn;
    $myTable = STUDENT_TABLE;
    if ($type == 'view') {
        $table = "students.*, classes.className FROM students 
                LEFT JOIN classes
                ON students.classId = classes.id";
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        if (isset($_POST['filter'])) {
            $link = http_build_query(array_merge($_GET, $_POST));
            header("location: manageStudent.php?$link&page=1");
        }
        if (isset($_GET['filter'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $studentModels->filter(['table'=>"$table",
                                                "limit"=>'-1',
                                                'page'=>$page,
                                                "order"=>"$orderBy",
                                                "direction"=>"$direction",], array_merge($_GET, $_POST));
            $totalStudents = count($result);
            $result = $studentModels->filter(['table'=>"$table",
                                                'page'=>$page,
                                                "order"=>"$orderBy",
                                                "direction"=>"$direction",], array_merge($_GET, $_POST));
        } else if (isset($_GET['order']) && isset($_GET['direction'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $studentModels->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "table"=>"$table",
                "limit"=>'-1']);
            $totalStudents = count($result);
            $result = $studentModels->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "table"=>"$table"]);

        }

        $students = $result;
        $view_file_name = 'module/student/view.php';
    } else if ($type == 'add') {
        if (isset($_POST['fullName'])) {
            $fullName = $_POST['fullName'];
            $classId = $_POST['selectedClass'];
            $contactNumber = $_POST['contactNumber'] ?? '';
            $dob = $_POST['dob'] ?? '';
            $dataStudent = array(
                "fullname" => "$fullName",
                "classId" => "$classId",
                "contactNumber" => "$contactNumber",
                "dob" => "$dob");
            if ($studentModels->insert($dataStudent)) {
                $lastIdStudent = selectLastElement('students');
                $lastId = $lastIdStudent['id'];

                $username = $lastId;
                $salt = generateRandomString();
                $pass = $lastId;
                $passSalt = md5($pass . $salt);


                $lastIdUser = selectLastElement('users');
                $insertUserData = array(
                    "title" => "student",
                    "username" => "$username",
                    "pass" => "$passSalt",
                    "salt" => "$salt",
                    "representName" => "$lastIdStudent[fullName]"
                );
                $insertedUser = new User();
                if ($insertedUser->insert($insertUserData)) {

                    $methodCreate = $_POST['create'];
                    if ($methodCreate == 'create') {
                        header("location: manageStudent.php?type=view&page=1&order=id&direction=DESC&action=added");
                    } else if ($methodCreate == 'continue') {
                        header("location: manageStudent.php?type=add&action=added");

                    } else {
                        echo "<script>alert('Thêm tài khoản thất bại')</script>";
                    }
                }
            }
        }
        $selectClass = createSelectClasses();
        $view_file_name = 'module/student/add.php';

    } else if ($type == 'edit' && isset($_GET['for'])) {
        $updateStatus = -1;
        $id = $_GET['for'];
        $oldData = $studentModels->get($id);
        if (isset($_POST['id1'])) {
            $studentModels->setId($id);
            $updateStatus = $studentModels->update(array('fullName'=>$_POST['fullName'],
                "contactNumber"=>$_POST['contactNumber'],
                "dob"=>$_POST['dob'],
                "classId" => $_POST['selectedClass']));
            header("location: manageStudent.php?type=view&page=1&order=id&direction=DESC&action=edited");
        }
        $selectClass = createSelectClasses($oldData['classId']);

        $view_file_name = 'module/student/edit.php';
    } else if ($type == 'delete' && isset($_GET['for'])) {
        $updateStatus = -1;
        $id = $_GET['for'];
        if ($studentModels->delete($id)) {
            header("location: manageStudent.php?type=view&page=1&order=id&direction=DESC&action=deleted");
        } else {
            header("location: manageStudent.php?type=view&page=1&order=id&direction=DESC&action=noAction");
        }
    } else {
        die('Unhandled');
    }
}



