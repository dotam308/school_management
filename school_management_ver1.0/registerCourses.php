<?php
ob_start();
session_start();
if (isset($_POST['logout'])) {
    $_SESSION['permission'] = false;
    header("location: process.php");
}
require_once "module/register/registerQuery.php";

$active_menu = 'register';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng ký học</title>
    <?php
    require_once "includes/headContents.php" ?>
</head>

<style>
    #img-user, #inputImg {
        max-width: 100%;
        max-height: 100%;
    }
    #div-img{
        max-width: 100%;
        max-height: 100%;
    }
</style>
<body>
<div class="wrapper ">
    <?php require_once 'slide_bar.php' ?>
    <div>abc</div>
    <div class="main-panel">
        <?php require_once "includes/header.php" ?>
        <div class="content">
            <div class="container-fluid">
                <?php
                    global $title;
                    require_once "$view_file_name";
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
