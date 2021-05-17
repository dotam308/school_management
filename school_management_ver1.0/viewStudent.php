<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
    <?php
    require_once "includes/headContents.php";
    ?>

    <title>Cổng thông tin đào tạo</title>
</head>

<body>

<div class="wrapper ">

    <?php $active_menu = 'index'; $sub_active = 'action';
    require_once "function/functions.php";
    require_once "connection.php";
    updateStudentOnGrade();
    ?>

    <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
        <?php
        require_once "includes/header.php";
        require_once "defaultPage.php";
        ?>
     </div>
</div>
</div>
<?php
require_once "includes/footer.php";
?>
</div>
</div>
</body>

</html>
