<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lí lớp học</title>
  <!-- Required meta tags -->
    <?php
    ob_start();
        require_once "includes/headContents.php"?>
</head>

<body>
  <div class="wrapper ">
      <?php $active_menu = 'class'; ?>
      <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
      <?php require_once "includes/header.php"?>
      <div class="content">
        <div class="container-fluid">
        	<?php 
        	
            	require_once 'function/functions.php';
            	require_once 'function/queryOnClass.php';
        	   $type = "";
        	   if (isset($_GET["type"])) {
        	       $type = $_GET["type"];
        	       queryOnClass($type);
        	   }
                ob_end_flush();
        	?>
        	
        </div>
      </div>
    <?php require_once "includes/footer.php"?>
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
