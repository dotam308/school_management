<?php
    require_once "function/functions.php";
    require_once "connection.php";
    session_start();
    if (isset($_POST['logout'])) {
        $_SESSION['permission'] = false;
        header("location: login/index.php");
    }
    if (isset($_SESSION['permission'])) {
        if ($_SESSION['permission'] == true) {
            $username = $_SESSION['username'];
            $selectUser = selectElementFrom("users", "*", "username='$username'");
            $user = $selectUser->fetch_assoc();
            global $title;
            $title = $user['title'];
            if ($title == 'admin') {
                require_once "viewAdmin.php";
            } else if ($title = 'student') {
                require_once "viewStudent.php";
            }

        } else if ($_SESSION['permission'] == false) {
            session_destroy();
            header("location: login/index.php");
        }
    } else {
        session_destroy();
        header("location: login/index.php");
    }

?>
