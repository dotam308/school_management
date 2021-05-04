<?php
    require_once 'connection.php';
    function queryOnCourse($type) {
        global $conn;
        
        $myTable = "courses";
        
        $sqlGetTeachers = 'SELECT * FROM `teachers` WHERE 1';
        $teachersData = $conn->query($sqlGetTeachers);
        $teachers = $teachersData->fetch_all();
        
        if ($type == 'view') {
            require_once "module/course/view.php";
        }
        if ($type == 'add') {

            require_once "module/course/add.php";
        }
        
        if (isset($_GET['type']) && isset($_GET['for'])) {
            $t = $_GET['type'];
            if ($t != 'view') {
                $id = $_GET['for'];
                
                $sqlSelectTeacher = "SELECT * FROM `$myTable` WHERE id=$id";
                
                $res = $conn->query($sqlSelectTeacher);
                $oldData = $res->fetch_assoc();
                
                
                if ($t == 'edit') {
                    require_once "module/course/edit.php";
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