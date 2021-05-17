<?php
    session_start();
    $_SESSION['permission'] = false;
    header("location: /login/index.php");
?>
