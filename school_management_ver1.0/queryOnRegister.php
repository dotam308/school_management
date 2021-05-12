<?php
require_once "module/register/registerQuery.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng kí học</title>
    <?php
    require_once "includes/headContents.php" ?>
</head>

<body>
<div class="wrapper ">
    <?php $active_menu = 'register';
    require_once "slide_bar.php";
    ?>

<div class="main-panel">
    <?php require_once "includes/header.php" ?>
    <div class="content">
        <div class="container-fluid">
            <?php

            if (isset($_GET['type'])) {
                if ($_GET['type'] == 'view') {
                    echo "<a class='btn btn-info' style='color: black; padding: 0.25rem 0.5rem;' 
                        href='manageStudent.php?type=view'>Quay về</a>";
                }
            }

            $student = $_GET['for'];
            if (isset($view_file_name)) require_once "$view_file_name";
            ?>
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