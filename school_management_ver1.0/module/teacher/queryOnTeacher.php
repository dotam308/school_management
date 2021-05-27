<?php

require_once './connection.php';
require_once 'function/functions.php';
require_once './models/Teacher.php';
require_once './models/User.php';
global $conn;

$myTable = "teachers";
const LIMIT = 10;
$teacherModel = new Teacher();
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    if ($type == 'view') {
        $limit = "";
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if (isset($_POST['filter'])) {
            $link = http_build_query(array_merge($_GET, $_POST));
            header("location: manageTeacher.php?$link&page=1");
        }
        if (isset($_GET['filter'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $teacherModel->filter([
                "limit"=>'-1',
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST));
            $totalSelectedTeacher = count($result);
            $result = $teacherModel->filter([
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST));
        } else if (isset($_GET['order']) && isset($_GET['direction'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $teacherModel->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "limit"=>'-1']);
            $totalSelectedTeacher = count($result);
            $result = $teacherModel->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page"]);

        }

        $teachers = $result;

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
                $idLastTeacher = $lastInsertTeacher['id'];
                $salt = generateRandomString(5);
                $username = convert_vi_to_en($lastNameTeacher).$idLastTeacher;
                $passSalt = md5($username . $salt);

                $insertUserData = array( "userId" => "$idLastTeacher",
                    "title" => "admin",
                    "username" => "$username",
                    "pass" => "$passSalt",
                    "salt" => "$salt",
                    "representName" => "$lastNameTeacher"
                );
                $userAdd = new User();
                if ($userAdd->insert($insertUserData)) {

                    if (isset($_POST['create'])) {
                        $type = $_POST['create'];
                        if ($type == 'create') {
                            header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=created");
                        } else {
                            header("location: manageTeacher.php?type=add&action=created");
                        }
                    }

                }
                if (isset($_POST['back'])) {
                    header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC");
                }
            }
            dd($_POST);
        }
    }
    if (isset($_GET['type']) && isset($_GET['for'])) {
        $t = $_GET['type'];
        if ($t != 'view') {
            $id = $_GET['for'];
            $oldData = $teacherModel->get($id);
            if ($t == 'edit') {
                $view_file_name = "module/teacher/edit.php";
                if (isset($_POST['update'])) {

                    $dataInsert = array(
                        'fullName'=>"$_POST[fullName]",
                        'unit'=>"$_POST[unit]",
                        'contactNumber'=>"$_POST[contactNumber]"
                    );
//                    dd($dataInsert);
                    $teacherModel->setId($id);
                    if ($teacherModel->update($dataInsert)) {
                        header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=edited");
                    } else {
                        header("location: manageTeacher.php?type=view&page=1&order=id&direction=DESC&action=editedFailed");
                    }
                }
            } else if ($t == 'delete') {


                if ($teacherModel->delete($id)) {
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
