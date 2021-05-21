<?php
ob_start();
require_once './connection.php';
require_once 'function/functions.php';
require_once './models/User.php';
global $conn;
const LIMIT = 10;
$myTable = "users";
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $username = $_SESSION['username'];
    $userModel = new User($username);
    $userC = $userModel->get();

    $users = new User("");
    if ($type == 'view') {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $selectUsers = $users->filter("id", "DESC", "10", "$page");
        $usersAccount = getUsersAccount($selectUsers);
        $view_file_name = "module/user/view.php";
    }
    if ($type == 'add') {
        $addStatus = -1;
        $view_file_name = "module/user/add.php";
        if (isset($_POST['create']) || isset($_POST['continue'])) {
            $salt = generateRandomString();
            $passSalt = $_POST['pass'] . $salt;

            $encodePass = md5($passSalt);
            $insertData = array(
                'id' => "NULL",
                "title" => "$_POST[title]",
                "username" => "$_POST[username]",
                "pass" => "$encodePass",
                "salt" => "$salt",
                "representName" => "NULL",
                "img-personal" => "NULL"
            );

            if ($users->insert($insertData)) {
                if (isset($_POST['create'])) {
                    header("location: queryOnAccount.php?type=view&page=1&action=create");
                } else if (isset($_POST['continue'])) {
                    header("location: queryOnAccount.php?type=add&action=create");
                }
            }
        }
        if (isset($_POST['back'])) {
            header("location: queryOnAccount.php?type=view&page=1");
        }
    }

    if (isset($_GET['for'])) {
        $t = $_GET['type'];
        if ($t != 'view') {
            $id = $_GET['for'];

            $updatedUser = new User("", "$id");
            $oldData = $updatedUser->get();
            if ($t == 'edit') {
                if (isset($_GET['check'])) {
                    $view_file_name = "module/user/edit.php";
                    $editStatus = 0;
                    $editData = array();
                    if (isset($_POST['edit'])) {
                        if ($_POST['pass'] != '') {
                            $encodePass = md5($_POST['pass']);
                            array_push($editData, array(
                                'updatePass'=>'true',
                                'title'=>"$_POST[title]",
                                'pass'=>"$encodePass",
                                'representName'=>"$_POST[representName]"
                            ));

                        } else {
                            array_push($editData, array(
                                'updatePass'=>'true',
                                'title'=>"$_POST[title]",
                                'representName'=>"$_POST[representName]"
                            ));
                        }

                        if (isset($_FILES['imgSrc'])) {
                            array_push($editData, array(
                                'updateImg'=>'true',
                                'nameInput'=>'imgSrc'
                            ));
                        }
                        if ($updatedUser->update($editData)) {
                            header("location: queryOnAccount.php?type=view&page=1&action=edited");
                        }
                    }

                } else {
                    $view_file_name = "module/user/preEdit.php";
                }
            } else if ($t == 'delete') {
                $id = $oldData['id'];
                if (checkListRestrictAccount($oldData['username'], $_SESSION['username'])) {
                    header("location: queryOnAccount.php?type=view&page=1&action=deletedRestrict");
                } else {

                    if ($updatedUser->delete()) {
                        header("location: queryOnAccount.php?type=view&page=1&action=deleted");
                    } else {
                        header("location: queryOnAccount.php?type=view&page=1&action=deletedError");
                    }
                }
            }
        } else {
            echo $conn->error . " error at selectCourse";
        }
    }
}

function getUsersAccount($selectUserAccount)
{
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
function checkListRestrictAccount($username, $sessionUserName)
{
    $restrictList = array("admin", "admin1", "admin2");
    if (in_array($username, $restrictList) || $username == $sessionUserName) {
        return true;
    }
    return false;
}