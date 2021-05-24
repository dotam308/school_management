<?php
//ob_start();
session_start();
require_once 'function/functions.php';
require_once './connection.php';
require_once "models/User.php";
require_once "models/Teacher.php";


$username = $_GET['for'];
$userMod = new User($username);
$combineUserAndTeacher = "(SELECT users.*, teachers.fullName, teachers.unit, teachers.contactNumber FROM `users` 
                                                LEFT JOIN teachers
                                                ON users.userId = teachers.id) users
                                              ";
$userMod->setTable($combineUserAndTeacher);
$account = $userMod->get();
$userId = $account['userId'];

if (isset($_POST['upload'])) {
    $uploadStatus = uploadImage($_GET['for'], 'imagefiles');
}

if (isset($_POST['update'])) {
    global $conn;
    $insertedData = [
      "fullName"=> "$_POST[fullName]",
        "unit"=>"$_POST[unit]",
        "contactNumber"=>"$_POST[contactNumber]",
        "representName"=>"$_POST[representName]"
    ];
    $teacherMod = new Teacher("$userId");

//    $sqlUpdate = "UPDATE `students` SET `contactNumber` = '$_POST[contactNumber]', `dob` = '$_POST[dob]' WHERE `students`.`id` = '$_GET[for]'";
    $sqlUpdateRepresentName = "UPDATE users SET representName = '$_POST[representName]' WHERE username='$_SESSION[username]'";
    if ($teacherMod->update($insertedData) && $conn->query($sqlUpdateRepresentName)) {
        header("location: updateAdminProfile.php?for=$username&action=updated");
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
        $(document).ready(function () {
            $('#inputImg').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    $('#thumb-output').html(''); //clear html of output element
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').addClass('imgUser').attr('src', e.target.result); //create image element
                                    $('#thumb-output').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        })
    </script>
</head>
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
                <?php
                    if (isset($_GET['action'])) {
                        $type = $_GET['action'];
                        if ($type == 'updated') {
                            echo "<div class='alert alert-success'>Cập nhật thành công</div>";
                        }
                    }

                ?>
                <h3>Thông tin cá nhân</h3>
                <div class="row">
                    <div class="col-sm-3">
                        <form method="post" enctype="multipart/form-data">
                            <div>
                                <div class="img-container">
                                    Cập nhật ảnh đại diện
                                    <div class="container-sm">
                                        <img src="<?= $srcImg ?>" id='img-user'>
                                    </div>

                                        <div id="thumb-output" class="container-sm"></div>
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
                                if ($userId != 0) {
                                    $fullName = $account['fullName'];
                                    $unit = $account['unit'];
                                    $contactNumber = $account['contactNumber'];
                                } else {
                                    $fullName = $account['representName'];
                                }
                                //                                $fullName = $account['fullName'];


                                //                                $selectedClass = createSelectClasses($class['id'], true);

                                $representName = $account['representName'];
                                ?>
                                <?php if ($userId != 0) { ?>
                                    <tr>
                                        <th>Mã tài khoản</th>
                                        <td>
                                            <input type="text" value="<?= ($userId) ?>" class="form-control" disabled>
<!--                                            <input type="text" value="--><?//= ($userId) ?><!--" class="form-control" style="display: none">-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Họ tên</th>
                                        <td><input type="text" value="<?= $fullName ?>" class="form-control" name="fullName" ></td>
                                    </tr>
                                    <tr>
                                        <th>Đơn vị</th>
                                        <td>
                                            <input type="text" value="<?= $unit ?>" class="form-control" name="unit" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td><input type="text" value="<?= $contactNumber ?>" class="form-control"
                                                   name="contactNumber"></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th>Tên đại diện</th>
                                    <td><input type="text" value="<?= $representName ?>" class="form-control"
                                               name="representName"></td>
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