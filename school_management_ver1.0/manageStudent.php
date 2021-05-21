<?php
session_start();
require_once 'module/student/queryOnStudent.php';
require_once "function/functions.php";
require_once "connection.php";
require_once "models/Student.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lí sinh viên</title>
  <?php require_once 'includes/headContents.php';?>
  
</head>

<body>
  <div class="wrapper ">

      <?php $active_menu = 'student'; $sub_active = 'view';?>
      <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
     	<?php require_once 'includes/header.php';?>
      <div class="content">
        <div class="container-fluid">
            <?php require_once $view_file_name;

            ?>
        </div>
      </div>
     	<?php require_once 'includes/footer.php';?>
    </div>
  </div>
</body>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Xác nhận xoá?',
            text: "Bạn không thể quay lại!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận!',
            confirmCancelText: 'Huỷ!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
</html>
