<?php
require_once "module/course/queryOnCourse.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lí lớp học</title>
    <?php require_once "includes/headContents.php"?>
</head>
<body>
  <div class="wrapper ">
      <?php ob_start();?>
      <?php $active_menu = 'course'; ?>
      <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
      <?php require_once "includes/header.php"?>
      <div class="content">
        <div class="container-fluid">
        	<?php require_once "$view_file_name"?>
        </div>
      </div>
      <?php require_once "includes/footer.php";
      ?>
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
            confirmCancelText: 'Thoát!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
</html>
