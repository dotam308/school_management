<?php
session_start();
require_once "module/user/queryOnUserAccount.php";
require_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm tài khoản</title>
    <!-- Required meta tags -->
    <?php
    require_once "includes/headContents.php"?>
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
<div class="wrapper ">
    <?php $active_menu = 'account'; ?>
    <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
        <?php require_once "includes/header.php"?>
        <div class="content">
            <div class="container-fluid">
                <?php require_once $view_file_name;?>
            </div>
        </div>
        <?php require_once "includes/footer.php"?>
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
