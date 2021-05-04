<!DOCTYPE html>
<html lang="en">

<head>
<title>Quản lí giáo viên</title>

    <?php require_once "includes/headContents.php"?>
</head>

<body>
	<div class="wrapper ">
	<?php ob_start();?>
    <?php $active_menu = 'teacher'; ?>
    <?php include_once 'slide_bar.php' ?>
    <div class="main-panel">
     	<?php include_once 'includes/header.php';?>
    	<div class="content">
				<div class="container-fluid">
        		<?php
        require_once 'function/functions.php';
        require_once 'function/queryOnTeacher.php';
        $type = "";
        if (isset($_GET["type"])) {
            $type = $_GET["type"];
            queryOnTeacher($type);
        }
        ?>
        	
        		</div>
			</div>
      <?php include_once 'includes/footer.php'; ob_end_flush();?>
    </div>
	</div>
</body>
<script>
	function confirmDelete(url) {
		Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  if (result.isConfirmed) {
				  window.location.href = url;
			  }
			})
	}

</script>

</html>
