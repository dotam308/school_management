<?php
ob_start();
require_once './connection.php';
require_once 'function/functions.php';
global $conn;

$myTable = "users";
if (isset($_GET["type"])) {
    $type = $_GET["type"];

    if ($type == 'view') {
        $usersAccount = getUsersAccount();
        $view_file_name = "module/user/view.php";
    }
    if ($type == 'add') {
        $addStatus = -1;
        $view_file_name = "module/user/add.php";
        if (isset($_POST['create']) || isset($_POST['continue'])) {
            $encodePass = md5($_POST['pass']);
            $sqlInsert = "INSERT INTO `users`(`id`, `title`, `username`, `pass`, `representName`, `img-personal`) 
            VALUES (NULL,'$_POST[title]','$_POST[username]','$encodePass',NULL,NULL)";
            if ($addStatus = $conn->query($sqlInsert)) {
                if (isset($_POST['create'])) {
                    header("location: queryOnAccount.php?type=view&action=create");
                } else if (isset($_POST['continue'])) {
                    header("location: queryOnAccount.php?type=add&action=create");
                }
            }
        }
        if (isset($_POST['back'])) {
            header("location: queryOnAccount.php?type=view");
        }
    }

    if (isset($_GET['for'])) {
        $t = $_GET['type'];
        if ($t != 'view') {
            $id = $_GET['for'];

            $selectUser = selectElementFrom('users', '*', "id = '$_GET[for]'");
            $oldData = $selectUser->fetch_assoc();
            if ($t == 'edit') {
                if (isset($_GET['check'])) {
                    $view_file_name = "module/user/edit.php";
                } else {
                    $view_file_name = "module/user/preEdit.php";
                }
            } else if ($t == 'delete') {
                $id = $oldData['id'];
                $username = $oldData['username'];
                if (checkListRestrictAccount($username, $_SESSION['username'])) {
                    echo "<script>alert('Không được phép xoá tài khoản này')</script>";

                    $usersAccount = getUsersAccount();
                    $view_file_name = "module/user/view.php";
                } else {
                    $sqlDelete = "DELETE FROM `$myTable` WHERE id=$id";

                    if ($conn->query($sqlDelete)) {
                        header("location: queryOnAccount.php?type=view&action=deleted");
                    } else {
                        header("location: queryOnAccount.php?type=view&action=deletedError");
                    }
                }


            }
        } else {
            echo $conn->error . " error at selectCourse";
        }
    }
}

function getUsersAccount() {
    $selectUserAccount = selectElementFrom("users", "*", "1 ORDER BY id DESC");
    $usersAccount = array();
    while ($user = $selectUserAccount->fetch_assoc()) {

        $img = $user['img-personal'];
        $usersAccount[] = [
            "id" => "$user[id]",
            "title" => "$user[title]",
            "username" => "$user[username]",
            "pass" => "$user[pass]",
            "representName" => "$user[representName]",
            "img-personal" => "$img"
        ];
    }
    return $usersAccount;
}

//list khong cho phep bat cu ai duoc xoa tai khoan
//kiem tra user muon xoa co trong list nay khong
function checkListRestrictAccount($username, $sessionUserName) {
    $restrictList = array("admin", "admin1", "admin2");
    if (in_array($username, $restrictList) || $username == $sessionUserName) {
        return true;
    }
    return false;
}