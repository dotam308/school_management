<?php
require_once './connection.php';
require_once './function/functions.php';

const STUDENT_TABLE = 'students';

function updateStudent($id, $fullName, $phone, $dob, $classId)
{
    global $conn;
    $myTable = STUDENT_TABLE;
    $date = strtotime($dob);
    $dob = date('Y-m-d', $date);

    $sqlUpdate = "UPDATE `$myTable` SET `fullname`='$fullName',`classId`='$classId',`contactNumber`='$phone',`dob`='$dob' WHERE id='$id'";

    return $conn->query($sqlUpdate);
}

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    global $conn;
    $myTable = STUDENT_TABLE;
    if ($type == 'view') {
        if (isset($_POST['filter'])) {
            $result = filterStudents();
        } else {
            $result = selectElementFrom("$myTable", "*", "1 ORDER BY `students`.`id` DESC");
        }
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $queryClass = selectElementFrom('classes', "*", "id = '$row[classId]'");
            $rowClass = $queryClass->fetch_assoc();
            $students[] = [
                'id' =>  $row['id'],
                'fullName' =>  $row['fullName'],
                'className' =>  $rowClass['className'],
                'contactNumber' =>  $row['contactNumber'],
                'dob' =>  $row['dob'],
            ];
        }
        $view_file_name = 'module/student/view.php';
    } else if ($type == 'add') {
        if (isset($_POST['fullName'])) {
            // TODO convert to insert function
            $sqlInsert = "INSERT INTO `$myTable` (`id`, `fullname`, `classId`, `contactNumber`, `dob`) VALUES (NULL, '$_POST[fullName]', '$_POST[selectedClass]', '$_POST[contactNumber]', '$_POST[dob]')";
            $result = $conn->query($sqlInsert);
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
        // TODO convert to getStudent function
        $sqlSelectStudent = "SELECT * FROM `$myTable` WHERE id=$id";
        $res = $conn->query($sqlSelectStudent);
        $oldData = $res->fetch_all()[0];
        if (isset($_POST['id1'])) {
            $updateStatus = updateStudent($id, $_POST['fullName'], $_POST['contactNumber'], $_POST['dob'], $_POST['selectedClass']);
            header("location: manageStudent.php?type=view&action=edited");
        }
        $selectClass = createSelectClasses($oldData[2]);

        $view_file_name = 'module/student/edit.php';
    } else if ($type == 'delete' && isset($_GET['for'])) {
        $updateStatus = - 1;
        $id = $_GET['for'];
        // TODO convert to deleteStudent function
        $sqlDelete = "DELETE FROM `$myTable` WHERE id=$id";
        if ($conn->query($sqlDelete)) {
            header("location: manageStudent.php?type=view&action=deleted");
        } else {
            header("location: manageStudent.php?type=view&action=noAction");
        }
    } else {
        die('Unhandled');
    }
}
