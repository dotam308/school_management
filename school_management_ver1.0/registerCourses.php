<?php
require_once "module/register/registerQuery.php";
?>
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
            require_once "$view_file_name";
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
