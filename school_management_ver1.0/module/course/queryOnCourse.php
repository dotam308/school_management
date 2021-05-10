<?php
require_once './connection.php';
require_once 'function/functions.php';
$type = "";

global $conn;

$myTable = "courses";
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $sqlGetTeachers = 'SELECT * FROM `teachers` WHERE 1';
    $teachersData = $conn->query($sqlGetTeachers);
    $teachers = $teachersData->fetch_all();


    if ($type == 'view') {
        $selectCourses = selectElementFrom("$myTable", "*", "1");
        $courseList = array();
        while ($course = $selectCourses->fetch_assoc()) {
            $courseList[] = [
                "id" => "$course[id]",
                "credit" => "$course[credit]",
                "startTime" => "$course[startTime]",
                "endTime" => "$course[endTime]",
                "place" => "$course[place]",
                "courseName" => "$course[courseName]",
                "courseCode" => "$course[courseCode]",
                "courseClassCode" => "$course[courseClassCode]",
                "maxStudent" => "$course[maxStudent]",
                "teacherId" => "$course[teacherId]"

            ];
        }
        $view_file_name = "module/course/view.php";
    }

    if ($type == 'add') {
        $selectTeachers = "
        <select name='selectTeacher' class='form-control'>
        <option value='' selected>----select----</option>";
        for ($i = 0; $i < count($teachers); $i++) {
            $fullName = $teachers[$i][1];
            $id = $teachers[$i][0];
            $showTeacher = $fullName . "-" . $id;
            $flag = '';
            $selectTeachers .= "<option value='$id'>$showTeacher</option>";
        }
        $selectTeachers .= '</select>';
        $view_file_name = "module/course/add.php";

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
        if (isset($_POST['credit'])) {
            $sqlInsert = "INSERT INTO `courses` (`id`, `credit`, `startTime`, `endTime`, `place`, `courseCode`, `courseName`, `courseClassCode`, `maxStudent`, `teacherId`)
                VALUES (NULL, '$_POST[credit]', '$_POST[startTime]', '$_POST[endTime]', '$_POST[place]', '$_POST[courseCode]', '$_POST[courseName]', '$_POST[courseClassCode]', '$_POST[maxStudent]', '$_POST[selectTeacher]')";

            if ($result = $conn->query($sqlInsert)) {
                if (isset($_POST['create'])) {
                    header("location: manageCourse.php?type=view&action=added");
                } else if (isset($_POST['continue'])) {
                    header("location: manageCourse.php?type=add&action=added");
                }
            } else if (isset($_POST['back'])) {
                header("location: manageCourse.php?type=view");
            } else {
                header("location: manageCourse.php?type=add&action=failed");
            }
        }
    }

    if (isset($_GET['type']) && isset($_GET['for'])) {
        $t = $_GET['type'];
        if ($t != 'view') {
            $id = $_GET['for'];

            $oldData = selectElementFrom("$myTable", "*", "id='$id'")->fetch_assoc();
            if ($t == 'edit') {
                $selectTeachers = "
                    <select name='selectTeacher' class='form-control'>
                        <option value='' selected='selected'>----select----</option>";
                for ($i = 0; $i < count($teachers); $i++) {
                    $fullName = $teachers[$i][1];
                    $id = $teachers[$i][0];
                    $showTeacher = $fullName . "-" . $id;
                    $flag = '';
                    if ((isset($selected) && $selected == $id) || $oldData['teacherId'] == $id) {
                        $flag = 'selected';
                    }

                    $selectTeachers .= "<option $flag value='$id'>$showTeacher</option>";
                }
                $selectTeachers .= '</select>';
                $view_file_name = "module/course/edit.php";

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
                if (isset($_POST['credit'])) {


                    $sqlUpdate = "UPDATE `courses` SET`credit`='$_POST[credit]',`startTime`='$_POST[startTime]',
                    `endTime`='$_POST[endTime]',`place`='$_POST[place]',`courseCode`='$_POST[courseCode]',`courseName`='$_POST[courseName]',
                    `courseClassCode`='$_POST[courseClassCode]',`maxStudent`='$_POST[maxStudent]',`teacherId`='$_POST[selectTeacher]' WHERE id='$oldData[id]'";
                    if ($conn->query($sqlUpdate)) {
                        header("location: manageCourse.php?type=view&action=edited");
                    } else {
                        echo $conn->error . "error at update Course";
                    }
                }
            } else if ($t == 'delete') {
                $sqlDelete = "DELETE FROM `$myTable` WHERE id=$oldData[id]";
                if ($conn->query($sqlDelete)) {
                    header("location: manageCourse.php?type=view&action=deleted");
                } else {
                    echo $conn->error . " error at delete";
                }
            }
        } else {
            echo $conn->error . " error at selectCourse";
        }
    }
}
