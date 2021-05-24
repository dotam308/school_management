<?php
require_once "function/functions.php";
require_once "./connection.php";
require_once "./models/Student.php";
require_once "./models/User.php";
const STUDENT_TABLE = 'students';
const LIMIT = 10;

$studentModels = new Student('');
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    global $conn;
    $myTable = STUDENT_TABLE;
    if ($type == 'view') {
        $table = "SELECT students.*, classes.className FROM students 
                LEFT JOIN classes
                ON students.classId = classes.id";
        if (isset($_POST['filter'])) {
            $result = filterStudents();
        } else if (isset($_GET['order']) && isset($_GET['direction'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $start = ($page - 1) * LIMIT;
                $limit = LIMIT;
                $result = $studentModels->filter("$orderBy", "$direction", LIMIT, "$page", "$table");
            }
        } else if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $start = ($page - 1) * LIMIT;
            $limit = LIMIT;
            $result = $studentModels->filter("id", "DESC", LIMIT, "$page", "$table");

        } else {
            $result = $studentModels->filter("id", "DESC", LIMIT, "1", "$table");

        }

        $students = [];
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $queryClass = selectElementFrom('classes', "*", "id = '$row[classId]'");
            $rowClass = $queryClass->fetch_assoc();
            $students[] = [
                'id' => $row['id'],
                'fullName' => $row['fullName'],
                'className' => $rowClass['className'],
                'contactNumber' => $row['contactNumber'],
                'dob' => $row['dob'],
                'index' => $index
            ];
            $index++;
        }
        $view_file_name = 'module/student/view.php';
    } else if ($type == 'add') {
        if (isset($_POST['fullName'])) {

            $dataStudent = array("id" => "NULL",
                "fullname" => "$_POST[fullName]",
                "classId" => "$_POST[selectedClass]",
                "contactNumber" => "$_POST[contactNumber]",
                "dob" => "$_POST[dob]");
            $studentModel = new Student('');
            $studentModel->insert($dataStudent);

            $lastIdStudent = selectLastElement('students');
            $lastId = $lastIdStudent['id'];

            $username = $lastId;
            $salt = generateRandomString();
//            $pass = (empty($_POST['pass'])) ? $lastId : $_POST['pass'];
            $pass = $lastId;
            $passSalt = md5($pass . $salt);


            $lastIdUser = selectLastElement('users');
            $insertUserData = array("id" => "NULL",
                "title" => "student",
                "username" => "$username",
                "pass" => "$passSalt",
                "salt" => "$salt",
                "representName" => "$lastIdStudent[fullName]",
                "img-personal" => "NULL"
            );
//            $sqlInsert = "INSERT INTO `users`(`id`, `title`, `username`, `pass`,`salt`, `representName`, `img-personal`)
//            VALUES (NULL,'student','$username','$passSalt', '$salt','$lastIdStudent[fullName]',NULL)";
            $insertedUser = new User();
            if ($insertedUser->insert($insertUserData)) {

//                $newLastIdUser = selectLastElement('users');
                $methodCreate = $_POST['create'];
                    if ($methodCreate == 'create') {
                        header("location: manageStudent.php?type=view&page=1&order=id&direction=DESC&action=added");
                    } else if ($methodCreate == 'continue') {
                        header("location: manageStudent.php?type=add&page=1&order=id&direction=DESC&action=added");

                } else {
                    echo "<script>alert('Thêm tài khoản thất bại')</script>";
                }
            }
        }
        $selectClass = createSelectClasses();
        $view_file_name = 'module/student/add.php';

    } else if ($type == 'edit' && isset($_GET['for'])) {
        $updateStatus = -1;
        $id = $_GET['for'];
        $oldDataStudent = new Student("$id");
        $oldData = $oldDataStudent->get();
        if (isset($_POST['id1'])) {
            $updateStudent = new Student("$id");
            $updateStatus = $updateStudent->update(array($_POST['fullName'], $_POST['contactNumber'], $_POST['dob'], $_POST['selectedClass']));
            header("location: manageStudent.php?type=view&action=edited");
        }
        $selectClass = createSelectClasses($oldData['classId']);

        $view_file_name = 'module/student/edit.php';
    } else if ($type == 'delete' && isset($_GET['for'])) {
        $updateStatus = -1;
        $id = $_GET['for'];
        $deletedStudent = new Student("$id");
        if ($deletedStudent->delete()) {
            header("location: manageStudent.php?type=view&action=deleted");
        } else {
            header("location: manageStudent.php?type=view&action=noAction");
        }
    } else {
        die('Unhandled');
    }
}



