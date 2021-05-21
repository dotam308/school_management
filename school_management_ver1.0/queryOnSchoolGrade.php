<?php
session_start();
ob_start();
require_once 'function/functions.php';
require_once "module/score/queryOnGrades.php";
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
<div class="wrapper ">
    <?php $active_menu = 'student';
    $sub_active = 'score' ?>
    <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <?php
                require_once "$view_file_name";
                ?>

            </div>
        </div>
    </div>
    <?php
    require_once "includes/footer.php";
    ?>
</div>
</body>
</html>
