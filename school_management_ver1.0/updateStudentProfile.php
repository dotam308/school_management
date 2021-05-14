<?php
//ob_start();
session_start();
require_once 'function/functions.php';
require_once './connection.php';
if (isset($_POST['upload'])) {
    $uploadStatus = uploadImage();
}
function uploadImage() {
    global $conn;
    // File name
    $filename = $_FILES['imagefiles']['name'];
    // Valid extension
    $valid_ext = array('png','jpeg','jpg');

    // Location
    $location = "images/".$filename;
    $thumbnail_location = "images/thumbnail/".$filename;

    // file extension
    $file_extension = pathinfo($location, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);

    // Check extension
    if(in_array($file_extension,$valid_ext)){

        // Upload file
        if(move_uploaded_file($_FILES['imagefiles']['tmp_name'],$location)){

            // Compress Image
            compressImage($_FILES['imagefiles']['type'],$location,$thumbnail_location,60);

            echo "<script>alert('Successfully Uploaded')</script>";

            $sqlInsertImageToDB = "UPDATE `users` SET `img-personal` = '$location' WHERE `users`.`username` = '$_GET[for]'";

            if($conn->query($sqlInsertImageToDB)) {
            return $location;
            }
        }

    }
}
function compressImage($type,$source, $destination, $quality) {

    $info = getimagesize($source);

    if ($type == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($type == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($type == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

}
if (isset($_POST['update'])) {
    global $conn;
    $sqlUpdate = "UPDATE `students` SET `contactNumber` = '$_POST[contactNumber]', `dob` = '$_POST[dob]' WHERE `students`.`id` = '$_GET[for]'";
    if ($conn->query($sqlUpdate)) {
        echo "<script>alert('Cập nhật thành công')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lí điểm</title>
    <?php
    require_once "includes/headContents.php";
    ?>
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
require_once 'slide_bar.php';


?>
<div class="wrapper ">

    <?php $active_menu = 'score'; ?>
    <?php require_once 'slide_bar.php' ?>

    <div class="main-panel">
        <?php
        require_once "includes/header.php";
        ?>
        <div class="content">
            <div class="container-fluid">

                <p>Thông tin cá nhân</p>
                <div class="row">
                    <div class="col-sm-3">
                        <form method="post" enctype="multipart/form-data">
                            <div>
                                <div class="img-container">
                                    Cập nhật ảnh đại diện<img src="<?= $srcImg?>" id='img-user'>
                                    <input type='file' name='imagefiles' id="inputImg">
                                    <input type='submit' value='Upload' name='upload'>
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
                                ?>

                                <tr><th>Mã sinh viên</th>
                                    <td><input type="text" value="<?=$idStudent?>" class="form-control" disabled></td>
                                </tr>
                                <tr><th>Họ tên</th>
                                    <td><input type="text" value="<?=$fullName?>" class="form-control" name="fullName" disabled></td>
                                </tr>
                                <tr><th>Ngày sinh</th>
                                    <td><input type="text" value="<?=$dob?>" class="form-control" name="dob"></td>
                                </tr>
                                <tr><th>Lớp</th>
                                    <td><?=$selectedClass?></td>
                                </tr>
                                <tr><th>Số điện thoại</th>
                                    <td><input type="text" value="<?=$contactNumber?>" class="form-control" name="contactNumber"></td>
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