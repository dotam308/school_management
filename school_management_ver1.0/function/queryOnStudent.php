<?php
require_once './connection.php';
require_once 'functions.php';

const STUDENT_TABLE = 'students';



function queryOnStudent($type)
{
    global $conn;
    $myTable = "students";
    if ($type == 'view') {
        require_once 'module/student/view.php';
    }
    if ($type == 'add') {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            if ($action == 'added') {
                echo "<div class='alert alert-success'>Thêm sinh viên thành công</div>";
            }

        }
        $selectClass = createSelectClasses();
        require_once 'module/student/add.php';
    }
    
    if (isset($_GET['type']) && isset($_GET['for'])) {
        $t = $_GET['type'];
        $updateStatus = - 1;
        
        $id = $_GET['for'];
        
        if ($t == 'edit') {
            
            require_once 'module/student/edit.php';
        } else if ($t == 'delete') {
            
            $sqlDelete = "DELETE FROM `$myTable` WHERE id=$id";
            
            if ($conn->query($sqlDelete)) {
                header("location: manageStudent.php?type=view&action=deleted");
            } else {
                header("location: manageStudent.php?type=view&action=noAction");
            }
        }
    }
}