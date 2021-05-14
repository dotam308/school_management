<?php
session_start();
require_once "module/teacher/queryOnTeacher.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Quản lí giáo viên</title>
    <?php require_once "includes/headContents.php"?>
</head>
<body>
	<div class="wrapper ">
    <?php $active_menu = 'teacher'; ?>
    <?php include_once 'slide_bar.php' ?>
    <div class="main-panel">
     	<?php include_once 'includes/header.php'; ?>
    	<div class="content">
				<div class="container-fluid">
        	        <?php
                        if (isset($view_file_name)) require_once "$view_file_name";
                        ?>
        		</div>
			</div>
      <?php include_once 'includes/footer.php'; ?>
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
