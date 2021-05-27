<?php
ob_start();
session_start();
require_once 'function/functions.php';
require_once 'module/score/queryOnStudentGrade.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lí điểm</title>
    <?php
        require_once "includes/headContents.php";
    ?>
</head>

<body>
<?php

require_once 'function/functions.php';
$active_menu = 'score';
require_once 'slide_bar.php';


?>
<div class="wrapper ">

    <?php $active_menu = 'score'; ?>
    <?php require_once 'slide_bar.php' ?>

    <div class="main-panel">
        <?php
            require_once "includes/header.php";
        ?>
        <div class="content">
            <div class="container-fluid">
               <?php require_once "$view_file_name";?>
            </div>
        </div>
        <?php
            require_once "includes/footer.php";
        ?>
    </div>
</div>
</body>
</html>