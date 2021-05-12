<?php
ob_start();
require_once "module/register/registerQuery.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng ký học</title>
    <?php
    require_once "includes/headContents.php" ?>
<!--    <script>-->
<!--        $(document).ready(function () {-->
<!--            $("input[type='checkbox']").change(function() {-->
<!--                $("#addNewCourses").html($(this).val());-->
<!--            })-->
<!--        })-->
<!--    </script>-->
</head>

<body>
<div class="wrapper ">
    <?php $active_menu = 'register'; ?>
    <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
        <?php require_once "includes/header.php" ?>
        <div class="content">
            <div class="container-fluid">
                <?php
                if (isset($_GET['type']) && $_GET['type'] == 'login') {
                    echo "<div class='alert alert-warning'>Chức năng này dành cho sinh viên</div>";
                } else
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
