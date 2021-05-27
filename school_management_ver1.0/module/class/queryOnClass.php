<?php
require_once './connection.php';
require_once 'function/functions.php';
require_once "./models/Teacher.php";
require_once "./models/ClassModel.php";
global $conn;
const LIMIT = 10;
$myTable = "classes";
$teacherModel = new Teacher();

$classModel = new ClassModel();
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $teachers = $teacherModel->get('');

    if ($type == 'view') {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $table = "classes.*, teachers.fullName teacherName FROM `classes`
                    LEFT JOIN teachers 
                    ON classes.teacherId = teachers.id";
        if (isset($_POST['filter'])) {
            $link = http_build_query(array_merge($_GET, $_POST));
            header("location: manageClass.php?$link&page=1");
        }
        if (isset($_GET['filter'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $classModel->filter(['table'=>"$table",
                "limit"=>'-1',
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST));
            $totalClasses = count($result);
            $result = $classModel->filter(['table'=>"$table",
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST));
        } else if (isset($_GET['order']) && isset($_GET['direction'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $classModel->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "table"=>"$table",
                "limit"=>'-1']);
            $totalClasses = count($result);
            $result = $classModel->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "table"=>"$table"]);

        }
        $classList = array();
        $classList = $result;
        $view_file_name = "module/class/view.php";
    }
    if ($type == 'add') {
        $addStatus = -1;
        $selectedClass = createSelectTeachers($teachers);
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

            if ($classModel->insert($insertData)) {
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

            $oldData = $classModel->get($id);
//            dd($oldData);
            $teacherModel = createSelectTeachers($teachers, $oldData['teacherId']);
            $classModel->setId($id);
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
                    if ($classModel->update($editData)) {
                        header("location: manageClass.php?type=view&page=1&action=edited");
                    } else {
                        echo $conn->error . "error at update Course";
                    }
                }
            } else if ($t == 'delete') {
                if ($classModel->delete($id)) {
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