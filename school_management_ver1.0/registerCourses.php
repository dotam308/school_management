<!DOCTYPE html>
<html lang="en">

<head>
  <title>Đăng ký học</title>
  <?php
    ob_start();
  require_once "includes/headContents.php"?>
</head>

<body>
  <div class="wrapper ">
      <?php $active_menu = 'register'; ?>
      <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
      <?php require_once "includes/header.php"?>
      <div class="content">
        <div class="container-fluid">
        	<?php
                require_once 'function/functions.php';
                require_once 'function/registerQuery.php';
                $type = "";
                if (isset($_GET["type"])) {
                    $type = $_GET["type"];
                    if (isset($_GET["for"])) {
                        $id = $_GET["for"];
                        registerQuery($type,$id);
                    }
                    if ($type == 'login') {
                        echo "<div class='alert alert-warning'>Chức năng này dành cho sinh viên</div>";
                        //SV cần phải đăng nhập, db check tài khoản -> rồi mới quyết định cho phép hay không
                    }
                }
        	?>
        	
        </div>
      </div>

        <?php require_once "includes/footer.php";
            ob_end_flush();
        ?>
    </div>
  </div>
</body>

</html>
