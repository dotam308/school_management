<?php
//ob_start();
session_start();
require_once 'function/functions.php';
require_once './connection.php';

$username = $_SESSION['username'];
$selectUser = selectElementFrom("users", "*", "username='$username'");
$user = $selectUser->fetch_assoc();

if (isset($_POST['update'])) {
    global $conn;
    if (md5($_POST['oldPass'].$user['salt']) == $user['pass']) {
        $encodePass = md5($_POST['newPass'].$user['salt']);
        if ($_POST['newPass'] == $_POST['newPass2']) {

            $sqlUpdatePass = "UPDATE users SET pass = '$encodePass' WHERE username='$username'";
            if ($conn->query($sqlUpdatePass)) {
                echo "<script>alert('Thay đổi mật khẩu thành công!')</script>";
            }
        } else {
            echo "<script>alert('Không khớp!')</script>";
        }

    } else {
        echo "<script>alert('Sai mật khẩu!')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thay đổi mật khẩu</title>
    <?php
    require_once "includes/headContents.php";
    ?>
</head>
<body>
<?php

require_once 'function/functions.php';
$active_menu = 'profile';
$sub_active = 'updatePassword';
?>
<div class="wrapper ">

    <?php require_once 'slide_bar.php' ?>

<div class="main-panel">
    <?php
    require_once "includes/header.php";
    ?>
    <div class="content">
        <div class="container-fluid">

            <h3>Thay đổi mật khẩu</h3>
            <div class="row">
                <form method="post">
                    <table class="table table-bordered">

                        <tr>
                            <th>Tên đăng nhập</th>
                            <td><input type="text" value="<?= $username ?>" class="form-control" disabled ></td>
                        </tr>
                        <tr>
                            <th>Mật khẩu cũ</th>
                            <td><input type="password" class="form-control" name="oldPass" ></td>
                        </tr>
                        <tr>
                            <th>Mật khẩu mới</th>
                            <td><input type="password"class="form-control" name="newPass" ></td>
                        </tr>
                        <tr>
                            <th>Nhập lại mật khẩu mới</th>
                            <td><input type="password"class="form-control" name="newPass2" ></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary" name="update">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once "includes/footer.php";
    ?>
</div>
</div>
</body>
</html>