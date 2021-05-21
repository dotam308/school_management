<?php
//ob_start();
session_start();
require_once 'function/functions.php';
require_once './connection.php';
if (isset($_POST['upload'])) {
    $uploadStatus = uploadImage($_GET['for'], 'imagefiles');
}

if (isset($_POST['update'])) {
    global $conn;

    $sqlUpdate = "UPDATE `students` SET `contactNumber` = '$_POST[contactNumber]', `dob` = '$_POST[dob]' WHERE `students`.`id` = '$_GET[for]'";
    $sqlUpdateRepresentName = "UPDATE users SET representName = '$_POST[representName]' WHERE username='$_SESSION[username]'";
    if ($conn->query($sqlUpdate) && $conn->query($sqlUpdateRepresentName)) {
        echo "<script>alert('Cập nhật thành công')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cập nhật hồ sơ</title>
    <?php
    require_once "includes/headContents.php";
    ?>
    <script>
        $(document).ready(function() {
            $("#inputImg").html("Chọn ảnh");
        })
    </script>
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
<?php

require_once 'function/functions.php';
$active_menu = 'profile';
$sub_active = 'viewProfile';
require_once 'slide_bar.php';


?>
<div class="wrapper ">

    <?php require_once 'slide_bar.php' ?>

    <div class="main-panel">
        <?php
        require_once "includes/header.php";
        ?>
        <div class="content">
            <div class="container-fluid">

                <h3>Thông tin cá nhân</h3>
                <div class="row">
                    <div class="col-sm-3">
                        <form method="post" enctype="multipart/form-data">
                            <div>
                                <div class="img-container">
                                    Cập nhật ảnh đại diện<img src="<?= $srcImg?>" id='img-user'>
                                    <input type='file' name='imagefiles' id="inputImg">
                                    <input type='submit' value='Upload' name='upload' class="btn btn-dark">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-9 text-center">
                        <form method="post">
                            <table class="table table-bordered">
                                <?php
                                    $idStudent = $_GET['for'];
                                    $selectStudent = selectElementFrom("students","*", "id = '$idStudent'");
                                    $student = $selectStudent->fetch_assoc();
                                    $fullName = $student['fullName'];

                                    $classId = $student['classId'];
                                    $class = selectElementFrom("classes","*", "id = '$classId'")->fetch_assoc();
                                    $className = $class['className'];
                                    $dob = $student['dob'];
                                    $contactNumber = $student['contactNumber'];

                                    $selectedClass = createSelectClasses($class['id'], true);

                                    $selectUser = selectElementFrom("users", "*", "username='$_SESSION[username]'");
                                    $user = $selectUser->fetch_assoc();
                                    $representName = $user['representName'];
                                ?>

                                <tr><th>Mã sinh viên</th>
                                    <td><input type="text" value="<?=$idStudent?>" class="form-control" disabled></td>
                                </tr>
                                <tr><th>Họ tên</th>
                                    <td><input type="text" value="<?=$fullName?>" class="form-control" name="fullName" disabled></td>
                                </tr>
                                <tr><th>Ngày sinh</th>
                                    <td><input type="date" value="<?=$dob?>" class="form-control" name="dob"></td>
                                </tr>
                                <tr><th>Lớp</th>
                                    <td><?=$selectedClass?></td>
                                </tr>
                                <tr><th>Số điện thoại</th>
                                    <td><input type="text" value="<?=$contactNumber?>" class="form-control" name="contactNumber"></td>
                                </tr>

                                <tr><th>Tên đại diện</th>
                                    <td><input type="text" value="<?=$representName?>" class="form-control" name="representName"></td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary" name="update">Cập nhật</button>
                        </form>
                    </div>
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