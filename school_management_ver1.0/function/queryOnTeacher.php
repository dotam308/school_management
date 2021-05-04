<?php
    require_once 'connection.php';
    
    function getListTeachers() {
        global $conn;
        $myTable = 'teachers';
        $sql = "SELECT * from $myTable";
        $result = $conn->query($sql); 
        return $result;
    }
    
    function addTeacher($name, $unit, $contactNumber) {
        global $conn;
        $myTable = 'teachers';
        $sqlInsert = "INSERT INTO `$myTable` (`id`, `fullname`, `unit`, `contactNumber`)
        VALUES (null, '$name', '$unit', '$contactNumber')";
        $result = $conn->query($sqlInsert);
        
        return $result ? true : false;
    }
    
    function editTeacher($id, $name, $unit, $contactNumber) {
        global $conn;
        $myTable = 'teachers';
        $sqlUpdate = "UPDATE `$myTable` SET `fullName`='$name',`unit`='$unit',`contactNumber`='$contactNumber'
        WHERE id='$id'";
        $query = $conn->query($sqlUpdate);
        
        return $query ? true : false;
    }
    
    function getTeacherById($id) {
        $myTable = 'teachers';
        global $conn;
        $sqlSelectTeacher = "SELECT * FROM `$myTable` WHERE id=$id";
        
        $res = $conn->query($sqlSelectTeacher);
        $data = $res->fetch_assoc();
        return $data;
    }
    
    function queryOnTeacher($type)
    {
        global $conn;
        
        $myTable = "teachers";
        
        if ($type == 'view') {
            require_once 'module/teacher/view.php';
        }
        if ($type == 'add') {
            require_once 'module/teacher/add.php';
        }
        
        if (isset($_GET['type']) && isset($_GET['for'])) {
            $t = $_GET['type'];
            if ($t != 'view') {
                $id = $_GET['for'];
                $teacher = getTeacherById($id);
                
                
                if ($t == 'edit') {
                    require_once 'module/teacher/edit.php';
                } else if ($t == 'delete') {
                    
                    $sqlDelete = "DELETE FROM `$myTable` WHERE id=$teacher[id]";
                    
                    if ($conn->query($sqlDelete)) {
                        header("location: manageTeacher.php?type=view&action=deleted");
                    } else {
                        echo $conn->error . " error at delete";
                    }
                }
            } else {
                echo $conn->error . " error at selectTeachers";
            }
        }
    }