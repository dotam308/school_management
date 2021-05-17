<?php

require_once './connection.php';
require_once 'function/functions.php';
global $conn;

$myTable = "classes";
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $sqlGetTeachers = 'SELECT * FROM `teachers` WHERE 1';
    $teachersData = $conn->query($sqlGetTeachers);
    $teachers = $teachersData->fetch_all();

    if ($type == 'view') {
        $classData = selectElementFrom("$myTable", "*", "1 ORDER BY id DESC");
        $classList = array();
        while ($class = $classData->fetch_assoc()) {
            $classList[] = [
                "id" => "$class[id]",
                "className" => "$class[className]",
                "maxStudent" => "$class[maxStudent]",
                "numOfStudents" => "$class[numOfStudents]",
                "teacherId" => "$class[teacherId]"
            ];
        }
        $view_file_name = "module/class/view.php";
    }
    if ($type == 'add') {
        $addStatus = -1;
        $selectTeachers = "
        <select name='selectTeacher' class='form-control'>
            <option value='' selected>----select----</option>";
            for ($i = 0; $i < count($teachers); $i++) {
                $fullName = $teachers[$i][1];
                $id = $teachers[$i][0];
                $showTeacher = $fullName . "-" . $id;
                $selectTeachers .= "<option  value='$id'>$showTeacher</option>";
            }
        $selectTeachers .= '</select>';
        $view_file_name = "module/class/add.php";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $error = array();
            if (empty($_POST['selectTeacher'])) {
                $error['selectTeacher'] = "Bạn cần chọn giáo viên";
            } else {
                $selected = $_POST['selectTeacher'];
            }
            if (empty($error)) {
            }
        }

        if (isset($_POST['className'])) {
            $sqlInsert = "INSERT INTO `classes`(`id`, `className`, `maxStudent`, `numOfStudents`, `teacherId`)
VALUES (NULL,'$_POST[className]','$_POST[maxStudent]','0','$_POST[selectTeacher]')";

            if ($addStatus = $conn->query($sqlInsert)) {
                if (isset($_POST['create'])) {
                    header("location: manageClass.php?type=view&action=create");
                } else if (isset($_POST['continue'])) {
                    header("location: manageClass.php?type=add&action=create");
                }
            } else if (isset($_POST['back'])) {
                header("location: manageClass.php?type=view");
            }
        }
    }

    if (isset($_GET['type']) && isset($_GET['for'])) {
        $t = $_GET['type'];
        if ($t != 'view') {
            $id = $_GET['for'];

            $sqlSelectTeacher = "SELECT * FROM `$myTable` WHERE id=$id";

            $res = $conn->query($sqlSelectTeacher);
            $oldData = $res->fetch_assoc();
            if ($t == 'edit') {
                $view_file_name = "module/class/edit.php";
            } else if ($t == 'delete') {

                $sqlDelete = "DELETE FROM `$myTable` WHERE id=$oldData[id]";

                if ($conn->query($sqlDelete)) {
                    header("location: manageClass.php?type=view&action=deleted");
                } else {
                    header("location: manageClass.php?type=view&action=deletedError");
                }
            }
        } else {
            echo $conn->error . " error at selectCourse";
        }
    }
}