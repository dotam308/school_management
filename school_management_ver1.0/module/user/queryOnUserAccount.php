<?php
ob_start();
require_once './connection.php';
require_once 'function/functions.php';
require_once './models/User.php';
global $conn;
const LIMIT = 10;
$myTable = "users";
$userModel = new User();
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $username = $_SESSION['username'];
    $userC = $userModel->get("$username");

    $users = new User();
    if ($type == 'view') {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }if (isset($_POST['filter'])) {
            $link = http_build_query(array_merge($_GET, $_POST));
            header("location: queryOnAccount.php?$link&page=1");
        }
        if (isset($_GET['filter'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $userModel->filter([
                "limit"=>'-1',
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST));
            $totalAccounts = count($result);
            $result = $userModel->filter([
                'page'=>$page,
                "order"=>"$orderBy",
                "direction"=>"$direction",], array_merge($_GET, $_POST));
        } else if (isset($_GET['order']) && isset($_GET['direction'])) {
            $orderBy = $_GET['order'];
            $direction = $_GET['direction'];
            $result = $userModel->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page",
                "limit"=>'-1']);
            $totalAccounts = count($result);
            $result = $userModel->filter(["order"=>"$orderBy",
                "direction"=>"$direction",
                "page"=>"$page"]);

        }
        $usersAccount = $result;
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
                "title" => "$_POST[title]",
                "username" => "$_POST[username]",
                "pass" => "$encodePass",
                "salt" => "$salt"
            );

            if ($users->insert($insertData)) {
                if (isset($_POST['create'])) {
                    header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc&action=create");
                } else if (isset($_POST['continue'])) {
                    header("location: queryOnAccount.php?type=add&action=create");
                }
            }
        }
        if (isset($_POST['back'])) {
            header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc");
        }
    }

    if (isset($_GET['for'])) {
        $t = $_GET['type'];
        if ($t != 'view') {
            $id = $_GET['for'];

            $oldData = $userModel->get("", "$id");
            $userModel->setUserId($id);
            if ($t == 'edit') {
                    $view_file_name = "module/user/edit.php";
                    $editStatus = 0;
                    $editData = array();
                    if (isset($_POST['edit'])) {
                        if ($_POST['pass'] != '') {
                            $encodePass = md5($_POST['pass'].$oldData['salt']);
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
                        if ($statusUpdate = $userModel->update($editData)) {
                            echo $statusUpdate;
                            switch ($statusUpdate) {
                                case "none":
                                    header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc&action=failUpdated");
                                    break;
                                case "info":
                                    header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc&action=infoUpdated");
                                    break;
                                case "img":
                                    header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc&action=imgUpdated");
                                case "both":
                                    header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc&action=edited");
                                    break;
                                default:
                                    header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc");
                                    break;
                            }
                        }
                    }

//                } else {
//                    $view_file_name = "module/user/preEdit.php";
//                }
            } else if ($t == 'delete') {
                $id = $oldData['id'];
                if (checkListRestrictAccount($oldData['username'], $_SESSION['username'])) {
                    header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc&action=deletedRestrict");
                } else {

                    if ($userModel->delete($userModel->getUserNameThroughId($id))) {
                        header("location: queryOnAccount.php?type=view&page=1order=id&direction=desc&&action=deleted");
                    } else {
                        header("location: queryOnAccount.php?type=view&page=1&order=id&direction=desc&action=deletedError");
                    }
                }
            }
        } else {
            echo $conn->error . " error at selectCourse";
        }
    }
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