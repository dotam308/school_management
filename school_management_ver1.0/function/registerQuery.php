<?php
require_once './connection.php';
require_once 'functions.php';
function registerQuery($type, $id)
{
    global $conn;
    global $idStudent;
    $idStudent= $id;
    switch ($type) {
        case "view":
            ?>
            <?php
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                if ($action == 'deleted') {
                    echo "<div class='alert alert-success'>Xoá thành công</div>";
                }
            }
            ?>
            <a class='btn btn-info' style="color: black; padding: 0.25rem 0.5rem;" href='manageStudent.php?type=view'>Quay về</a>
            <div style="text-align: center; color: red; font-weight: 800">
                <h3>Danh sách đăng kí</h3>
            </div>
            <?php
            require_once 'module/register/view.php';
            break;
        case "add":
            require_once 'module/register/add.php';
            break;
        case "delete":
            if (isset($_GET['for'])) {
                $courseId = $_GET['ele'];
                $sqlDeleteSelected = "DELETE FROM `registers` WHERE `courseId` = '$courseId'";
                $result = $conn->query($sqlDeleteSelected);
                if ($result) {
                    header("location: ./registerQuery.php?type=view&for=$_GET[for]&action=deleted");

                } else {
                    echo $conn->error;
                }
            }


            break;
        default:
            break;
    }
}