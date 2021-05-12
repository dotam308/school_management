<?php
ob_start();
require_once 'function/functions.php';
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
                <?php
                require_once 'function/functions.php';
                require_once 'connection.php';

                updateStudentOnGrade();
                global $conn;

                if ($conn->connect_error) {
                    echo $conn->error;
                }
                $idStudent = isset($_GET['for']) ? $_GET['for'] : "";
                if ($idStudent != "") {
                        showScores($_GET['for']);
                }
                if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
                    $updateData = $_POST;

                    $success = false;
                    foreach ($updateData as $key => $value) {

                        $info = getDetailData($key);

                        $courseIdPart = $info[0];
                        $studentId = $info[1];
                        $sqlUpdate = "UPDATE `scores` SET `score`= $value WHERE `courseId`='$courseIdPart' AND `studentId` = '$studentId'";

                        if ($conn->query($sqlUpdate)) {
                            $success = true;
                        } else {
                        }
                    }
                    header("location: queryOnStudentGrade.php?for=$idStudent#");
            }
                ?>

            </div>
        </div>
        <?php
            require_once "includes/footer.php";
        ?>
    </div>
</div>
</body>
</html>