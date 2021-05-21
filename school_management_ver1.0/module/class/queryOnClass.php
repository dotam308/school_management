<?php
require_once './connection.php';
require_once 'function/functions.php';
require_once "./models/Teacher.php";
require_once "./models/ClassModel.php";
global $conn;
const LIMIT = 10;
$myTable = "classes";
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $selectTeachers = new Teacher("");
    $teachers = $selectTeachers->get();

    $selectClass = new ClassModel("");
    if ($type == 'view') {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $classData = $selectClass->filter("id", "DESC", LIMIT, "$page");
        $classList = array();
        while ($class = $classData->fetch_assoc()) {
            $newClass = new ClassModel("$class[id]");
            $classList[] = $newClass->get();
        }
        $view_file_name = "module/class/view.php";
    }
    if ($type == 'add') {
        $addStatus = -1;
        $selectTeachers = createSelectTeachers($teachers);
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

            $insertData = array(
                'id' => "NULL",
                "className" => "$_POST[className]",
                'maxStudent' => "$_POST[maxStudent]",
                "numOfStudents" => "0",
                'teacherId' => "$_POST[selectTeacher]"
            );

            if ($selectClass->insert($insertData)) {
                if (isset($_POST['create'])) {
                    header("location: manageClass.php?type=view&page=1&action=create");
                } else if (isset($_POST['continue'])) {
                    header("location: manageClass.php?type=add&action=create");
                }
            } else if (isset($_POST['back'])) {
                header("location: manageClass.php?type=view&page=1");
            }
        }
    }

    if (isset($_GET['type']) && isset($_GET['for'])) {
        $t = $_GET['type'];
        if ($t != 'view') {
            $id = $_GET['for'];

            $selectedClass = new ClassModel("$id");
            $oldData = $selectedClass->get();
            $selectTeachers = createSelectTeachers($teachers, $oldData['teacherId']);

            if ($t == 'edit') {
                $view_file_name = "module/class/edit.php";
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
// Thiết lập mảng lưu lỗi => Mặc định rỗng
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
                    $editData = array(
                      "className"=>"$_POST[className]",
                      "maxStudent"=>"$_POST[maxStudent]",
                      "teacherId"=> "$_POST[selectTeacher]"

                    );
                    if ($selectedClass->update($editData)) {
                        header("location: manageClass.php?type=view&page=1&action=edited");
                    } else {
                        echo $conn->error . "error at update Course";
                    }
                }
            } else if ($t == 'delete') {
                if ($selectedClass->delete()) {
                    header("location: manageClass.php?type=view&page=1&action=deleted");
                } else {
                    header("location: manageClass.php?type=view&page=1&action=deletedError");
                }
            }
        } else {
            echo $conn->error . " error at selectCourse";
        }
    }
}