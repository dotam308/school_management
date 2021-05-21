<?php

require_once './connection.php';
require_once 'function/functions.php';
require_once './models/Teacher.php';
require_once './models/User.php';
global $conn;

$myTable = "teachers";
const LIMIT = 10;
$teacherModel = new Teacher('');
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    if ($type == 'view') {
        $limit = "";
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if (isset($_GET['order'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $teachersData = $teacherModel->filter("$orderBy","$direction",  -1, "$page");

            $totalSelectedTeacher = $teachersData->num_rows;
            $teachersData = $teacherModel->filter("$orderBy","$direction",  LIMIT, "$page");
        }
        $teachers = getTeacherList($teachersData);

        $view_file_name = "module/teacher/view.php";
    }
    if ($type == 'add') {
        $addStatus = -1;
        $view_file_name = "module/teacher/add.php";

        if (isset($_POST['fullName'])) {

            $insertTeacherData = array(
                'fullName' => "$_POST[fullName]",
                'unit' => "$_POST[unit]",
                "contactNumber" => "$_POST[contactNumber]"
            );

            if ($addStatus = $teacherModel->insert($insertTeacherData)) {
                $lastInsertTeacher = selectLastElement('teachers');
                $lastNameTeacher = $lastInsertTeacher['fullName'];

                $salt = generateRandomString(5);
                $username = convert_vi_to_en($lastNameTeacher);
                $passSalt = md5($username . $salt);

                $insertUserData = array(
                    "title" => "admin",
                    "username" => "$username",
                    "pass" => "$passSalt",
                    "salt" => "$salt",
                    "representName" => "$lastNameTeacher"
                );
                $userAdd = new User();
                if ($userAdd->insert($insertUserData)) {
                    if (isset($_POST['create'])) {
                        header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=created");
                    } else if (isset($_POST['continue'])) {
                        header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=created");
                    }
                }
                if (isset($_POST['back'])) {
                    header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC");
                }
            }
        }
    }
    if (isset($_GET['type']) && isset($_GET['for'])) {
        $t = $_GET['type'];
        if ($t != 'view') {
            $id = $_GET['for'];

            $updatedTeacher = new Teacher("$id");
            $oldData = $updatedTeacher->get();
            if ($t == 'edit') {
                $view_file_name = "module/teacher/edit.php";
                if (isset($_POST['update'])) {

                    $dataInsert = array(
                        'fullName'=>"$_POST[fullName]",
                        'unit'=>"$_POST[unit]",
                        'contactNumber'=>"$_POST[contactNumber]"
                    );
//                    dd($dataInsert);
                    if ($updatedTeacher->update($dataInsert)) {
                        header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=edited");
                    } else {
                        header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=editedFailed");
                    }
                }
            } else if ($t == 'delete') {


                if ($updatedTeacher->delete()) {
                    header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=deleted");
                } else {
                    header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=deletedFailed");
                }
            }
        } else {
            echo $conn->error . " error at selectCourse";
        }
    }
}

function getTeacherList($data)
{
    $teachers = array();
    while ($teacher = $data->fetch_assoc()) {
        $teachers[] = [
            'id' => $teacher['id'],
            'fullName' => $teacher['fullName'],
            'unit' => $teacher['unit'],
            'contactNumber' => $teacher['contactNumber']
        ];
    }
    return $teachers;
}
