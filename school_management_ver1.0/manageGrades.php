<?php
session_start();
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
      <?php $active_menu = 'score'; ?>
      <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
      <?php require_once "includes/header.php"?>
      <div class="content">
        <div class="container-fluid">
        	<?php    
        	
        	require_once 'function/functions.php';
        	echo "<h3>Sinh viên đăng nhập</h3>";
        	echo "
                 <form method='post' action='queryOnStudentGrade.php'>
                    Mã sinh viên<input name='id' type='text'/>
                    <button type='submit'>Go</button>
                  </form>
                ";

        	?>
        	
        </div>
      </div>

        <?php require_once "includes/footer.php";
        ?>
    </div>
  </div>
</body>
</html>
