<?php
    require_once './connection.php';
    require_once 'function/functions.php';
    $type = "";

    global $conn;
    if (isset($_GET["type"])) {
        $type = $_GET["type"];
        $myTable = "teachers";
        if ($type == 'view') {

            $selectTeacher = selectElementFrom("teachers", "*", "1 ORDER BY id DESC");
            $teachers = array();
            while ($row = $selectTeacher->fetch_assoc()) {
                $teachers[] = [
                    "id" => $row['id'],
                    "fullName" => $row['fullName'],
                    "unit"=> $row['unit'],
                    "contactNumber"=> $row['contactNumber']
                ];
            }
            $view_file_name =  'module/teacher/view.php';
        }
        if ($type == 'add') {
            $addStatus = -1;
            if (isset($_POST['fullName'])) {
                $addStatus = addTeacher( $_POST['fullName'], $_POST['unit'], $_POST['contactNumber']);
                if ($_POST['button'] == 'create') {
                    header("location: manageTeacher.php?type=view&action=added");
                }
            }
            ?> alert( $addStatus); <?php
            if ($addStatus !== -1) {
                if ($addStatus) {
                    echo "<div class='alert alert-success'>Added successfully</div>";
                } else {
                    echo "<div class='alert alert-warning'>Added unsuccessfully</div> ";
                }
            }
            $view_file_name = 'module/teacher/add.php';
        }

        if (isset($_GET['for'])) {
            if ($type != 'view') {
                $id = $_GET['for'];
                $teacher = selectElementFrom('teachers', "*", "id='$id'")->fetch_assoc();
                if ($type == 'edit') {
                    if (isset($_POST['fullName'])) {
                        editTeacher($id, $_POST['fullName'], $_POST['unit'], $_POST['contactNumber']);
                        header("location: manageTeacher.php?type=view&action=edited");
                    }
                    $view_file_name = 'module/teacher/edit.php';
                } else if ($type == 'delete') {
                    if (deleteTeacher($id)) {
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
    function deleteTeacher($id) {
        global $conn;
        $sqlDelete = "DELETE FROM `teachers` WHERE id='$id'";
        $query = $conn->query($sqlDelete);
        return ($query) ? true : false;
    }