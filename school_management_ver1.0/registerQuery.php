<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng kí học</title>
    <!-- Required meta tags -->
    <?php
    ob_start();
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
            require_once 'connection.php';
            require_once 'function/registerQuery.php';
            if (isset($_GET['for'])) {
                $id = $_GET['for'];
                $type = $_GET['type'];
                registerQuery($type, $id);
            }
            ?>

        </div>
    </div>
    <?php require_once "includes/footer.php";
        ob_end_flush();
    ?>
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