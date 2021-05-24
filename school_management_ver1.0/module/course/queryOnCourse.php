<?php
require_once './connection.php';
require_once 'function/functions.php';
require_once './models/Teacher.php';
require_once './models/Course.php';
$type = "";

global $conn;
const LIMIT = 10;
$selectedCourses = new Course("");
$myTable = "courses";
if (isset($_POST['filter'])) {
    unset($filterPart);
    $filterPost = array();
    foreach ($_POST as $key=>$value) {
        if (!empty($_POST[$key])) $filterPost[$key] = $value;
    }
    $filterGet = array();
    foreach ($_GET as $key=>$value) {
        $filterGet[$key] = $value;
        if ($key=="direction") break;
    }
    $getLink = http_build_query(array_merge($filterGet, $filterPost));
    unset($_GET);
    header("location: manageCourse.php?$getLink");
//    dd($_POST);
}
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $newTeacher = new Teacher('');
    $teachers = $newTeacher->get();

    if ($type == 'view') {

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $table = "SELECT courses.*, teachers.fullName, (startTime+12) AS start FROM courses
LEFT JOIN teachers ON teachers.id = courses.teacherId";
        if (isset($_GET['order'])) {
            $selectCourses = $selectedCourses->filter("$_GET[order]", "$_GET[direction]", LIMIT,
                "$page", "$table");
        } else {

            $selectCourses = $selectedCourses->filter("id", "DESC", LIMIT, "$page", "$table");
        }
        $courseList = array();
        while ($course = $selectCourses->fetch_assoc()) {
            $newCourse = new Course("$course[id]");
            $courseList[] = $newCourse->get();
        }
        $view_file_name = "module/course/view.php";
    }

    if ($type == 'add') {
        $selectTeachers = createSelectTeachers($teachers);
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

            $insertData = array(
                "id"=>"NULL",
                "credit"=>"$_POST[credit]",
                "startTime"=>"$_POST[startTime]",
                "endTime"=>"$_POST[endTime]",
                "place"=>"$_POST[place]",
                "courseCode"=>"$_POST[courseCode]",
                "courseName"=>"$_POST[courseName]",
                "courseClassCode"=>"$_POST[courseClassCode]",
                "maxStudent"=>"$_POST[maxStudent]",
                "teacherId"=>"$_POST[selectTeacher]",
            );

//            $sqlInsert = "INSERT INTO `courses` (`id`, `credit`, `startTime`, `endTime`, `place`, `courseCode`, `courseName`,
//                       `courseClassCode`, `maxStudent`, `teacherId`)
//                VALUES (NULL, '$_POST[credit]', '$_POST[startTime]', '$_POST[endTime]', '$_POST[place]', '$_POST[courseCode]', '$_POST[courseName]', '$_POST[courseClassCode]', '$_POST[maxStudent]', '$_POST[selectTeacher]')";

            if ($selectedCourses->insert($insertData)) {
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

            $updatedCourse = new Course("$oldData[id]");
            if ($t == 'edit') {
                $selectTeachers = createSelectTeachers($teachers, "$oldData[teacherId]");
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
                    $editData = array(
                        "id"=>"$oldData[id]",
                        "credit"=>"$_POST[credit]",
                        "startTime"=>"$_POST[startTime]",
                        "endTime"=>"$_POST[endTime]",
                        "place"=>"$_POST[place]",
                        "courseCode"=>"$_POST[courseCode]",
                        "courseName"=>"$_POST[courseName]",
                        "courseClassCode"=>"$_POST[courseClassCode]",
                        "maxStudent"=>"$_POST[maxStudent]",
                        "teacherId"=>"$_POST[selectTeacher]",
                    );
                    if ($updatedCourse->update($editData)) {
                        header("location: manageCourse.php?type=view&action=edited");
                    } else {
                        echo $conn->error . "error at update Course";
                    }
                }
            } else if ($t == 'delete') {
                if ($updatedCourse->delete()) {
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
