<?php
require_once './connection.php';
require_once 'function/functions.php';
require_once './models/Teacher.php';
require_once './models/Course.php';
$type = "";

global $conn;
const LIMIT = 10;
$courseModel = new Course();
$myTable = "courses";
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $newTeacher = new Teacher('');
    $teachers = $newTeacher->get();

    if ($type == 'view') {

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $table = " courses.*, teachers.fullName, (startTime+12) AS start FROM courses
LEFT JOIN teachers ON teachers.id = courses.teacherId";
        if (isset($_POST['filter'])) {
            $link = http_build_query(array_merge($_GET, $_POST));
            header("location: manageCourse.php?$link&page=1");
        }
        if (isset($_GET['filter'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $courseModel->filter(['table'=>"$table",
                "limit"=>'-1',
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST));
            $totalCourses = count($result);
            $result = $courseModel->filter(['table'=>"$table",
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST));
        } else if (isset($_GET['order']) && isset($_GET['direction'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $courseModel->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "table"=>"$table",
                "limit"=>'-1']);
            $totalCourses = count($result);
            $result = $courseModel->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "table"=>"$table"]);

        }
        $courseList = array();
        $courseList = $result;
//        }
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

            if ($courseModel->insert($insertData)) {
                if (isset($_POST['create'])) {
                    header("location: manageCourse.php?type=view&page=1&order=id&direction=DESC&action=added");
                } else if (isset($_POST['continue'])) {
                    header("location: manageCourse.php?type=add&action=added");
                }
            } else if (isset($_POST['back'])) {
                header("location: manageCourse.php?type=view&page=1&order=id&direction=DESC");
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
            $courseModel->setId($id);
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
                    if ($courseModel->update($editData)) {
                        header("location: manageCourse.php?type=view&page=1&order=id&direction=DESC&action=edited");
                    } else {
                        echo $conn->error . "error at update Course";
                    }
                }
            } else if ($t == 'delete') {
                if ($courseModel->delete($id)) {
                    header("location: manageCourse.php?type=view&page=1&order=id&direction=DESC&action=deleted");
                } else {
                    echo $conn->error . " error at delete";
                }
            }
        } else {
            echo $conn->error . " error at selectCourse";
        }
    }
}
