<?php
require_once './connection.php';
require_once 'functions.php';

const REGISTER_TABLE = 'registers';

function queryOnRegister($type)
{
    global $conn;
    $myTable = "registers";
    if ($type == 'view') {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'deleted')
                echo '<div class="alert alert-success">Xoá thành công.</div>';
            else
                echo '<div class="alert alert-danger">Xoá thất bại.</div>';
        }
        echo '<h3>Danh sách đăng kí</h3>';
        require_once "module/registerList/view.php";
    }

    if (isset($_GET['type']) && isset($_GET['for']) && isset($_GET['ele'])) {
        $t = $_GET['type'];

        $studentId = $_GET['for'];
        $courseId = $_GET['ele'];

        if ($t == 'delete') {

            $sqlDelete = "DELETE FROM `$myTable` WHERE studentId='$studentId' AND courseId='$courseId'";
            $sqlDeleteScore = "DELETE FROM `scores` WHERE studentId='$studentId' AND courseId='$courseId'";

            if ($conn->query($sqlDelete) && $conn->query($sqlDeleteScore)) {
                header("location: manageRegister.php?type=view&action=deleted");
            } else {
                header("location: manageRegister.php?type=view&action=notdeleted");
            }
        }
    }
}