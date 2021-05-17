<?php
require_once './connection.php';
require_once './function/functions.php';

const STUDENT_TABLE = 'students';
const LIMIT = 10;

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    global $conn;
    $myTable = STUDENT_TABLE;
    if ($type == 'view') {
        if (isset($_POST['filter'])) {
            $result = filterStudents();
        } else if (isset($_GET['order'])) {
            $method = $_GET['order'];
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $start = ($page-1)*LIMIT;
                $limit = LIMIT;
                $result = selectStudentWithCondition($method, "LIMIT $start, $limit");
            }
        } else if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $start = ($page-1)*LIMIT;
            $limit = LIMIT;
            $result = selectStudentWithCondition("studentIdOrderDown", "LIMIT $start, $limit");
        } else {
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`id` DESC");
        }

        $students = [];
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $queryClass = selectElementFrom('classes', "*", "id = '$row[classId]'");
            $rowClass = $queryClass->fetch_assoc();
            $students[] = [
                'id' =>  $row['id'],
                'fullName' =>  $row['fullName'],
                'className' =>  $rowClass['className'],
                'contactNumber' =>  $row['contactNumber'],
                'dob' =>  $row['dob'],
                'index'=> $index
            ];
            $index++;
        }
        $view_file_name = 'module/student/view.php';
    } else if ($type == 'add') {
        if (isset($_POST['fullName'])) {
            // TODO convert to insertStudent function->done
            $dataStudent = array("id" => "NULL",
                "fullname" => "$_POST[fullName]",
                "classId" => "$_POST[selectedClass]",
                "contactNumber" => "$_POST[contactNumber]",
                "dob" => "$_POST[dob]");
            $result = insertElementFrom("$myTable", $dataStudent);

            $methodCreate = $_POST['create'];
            if ($methodCreate == 'create') {
                header("location: manageStudent.php?type=view&action=added");
            } else if ($methodCreate == 'continue') {
                header("location: manageStudent.php?type=add&action=added");
            }
        }
        $selectClass = createSelectClasses();
        $view_file_name = 'module/student/add.php';
    } else if ($type == 'edit' && isset($_GET['for'])) {
        $updateStatus = - 1;
        $id = $_GET['for'];
        // TODO convert to getStudent function->done
        $oldData = getStudent($id);
        if (isset($_POST['id1'])) {
            $updateStatus = updateStudent($id, $_POST['fullName'], $_POST['contactNumber'], $_POST['dob'], $_POST['selectedClass']);
            header("location: manageStudent.php?type=view&action=edited");
        }
        $selectClass = createSelectClasses($oldData['classId']);

        $view_file_name = 'module/student/edit.php';
    } else if ($type == 'delete' && isset($_GET['for'])) {
        $updateStatus = - 1;
        $id = $_GET['for'];
        // TODO convert to deleteStudent function ->done
        if (deleteStudent($id)) {
            header("location: manageStudent.php?type=view&action=deleted");
        } else {
            header("location: manageStudent.php?type=view&action=noAction");
        }
    } else {
        die('Unhandled');
    }
}
function getStudent($id){
    return selectElementFrom("students", "*", "id='$id'")->fetch_assoc();
}
function deleteStudent($id) {
    global $conn;
    $sqlDelete = "DELETE FROM `students` WHERE id=$id";
    return $conn->query($sqlDelete);
}
function updateStudent($id, $fullName, $phone, $dob, $classId)
{
    global $conn;
    $myTable = STUDENT_TABLE;
    $date = strtotime($dob);
    $dob = date('Y-m-d', $date);

    $sqlUpdate = "UPDATE `$myTable` SET `fullname`='$fullName',`classId`='$classId',`contactNumber`='$phone',`dob`='$dob' WHERE id='$id'";

    return $conn->query($sqlUpdate);
}

function selectStudentWithCondition($method, $limit="") {
    $myTable = 'students';
    switch ($method) {
        case "studentIdOrderUp":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`id` ASC $limit");
            break;
        case "studentIdOrderDown":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`id` DESC $limit");
            break;
        case "studentNameOrderUp":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`fullName` ASC $limit");
            break;
        case "studentNameOrderDown":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`fullName` DESC $limit");
            break;
        case "classOrderUp":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`classId` ASC $limit");
            break;
        case "classOrderDown":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`classId` DESC $limit");
            break;
        case "contactNumOrderUp":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`contactNumber` ASC $limit");
            break;
        case "contactNumOrderDown":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`contactNumber` DESC $limit");
            break;
        case "dobOrderUp":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`dob` ASC $limit");
            break;
        case "dobOrderDown":
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`dob` DESC $limit");
            break;
        default:
            break;
    }
    return $result;
}