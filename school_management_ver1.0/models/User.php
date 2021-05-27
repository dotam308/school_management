<?php

require_once "BaseModel.php";
class User extends BaseModel
{
    protected $table = 'users';
    protected $id_name = 'username';
    private $userId;
    public function get($username="", $id = "")
    {
        if ($username != '' || $id != '') {
            $sqlGet = "select * from {$this->table} where username= '$username' OR id='$id'";
            return $this->conn->query($sqlGet)->fetch_assoc();
        } else {
            $sqlGet = "select * from {$this->table}";
            echo $sqlGet;
            return $this->conn->query($sqlGet)->fetch_all(MYSQLI_ASSOC);
        }
    }
    public function update($params)
    {
        // TODO: Implement update() method.
//        dd($params[0]);
        $status = "none";
        //none, cap nhat thong tin, va anh deu bi loi
        //both, cap nhat thong tin , anh thanh cong
        //img cap nhat anh thanh cong
        //info cap nhat anh thanh cong
        if (empty($this->userId)) return false;
        if ($params[0]['updatePass'] == true) {
            $title =$params[0]['title'];
            $pass =$params[0]['pass'];
            $representName=$params[0]['representName'];

            $sqlUpdate = "UPDATE `$this->table`
                            SET `title`='$title',`pass`='$pass',
                              `representName`='$representName' WHERE id = '$this->userId'";
        } else if ($params[0]['updatePass'] == false) {

            $title =$params[0]['title'];
            $representName=$params[0]['representName'];
            $sqlUpdate = "UPDATE `$this->table`
                            SET `title`='$title',
                              `representName`='$representName' WHERE id = '$this->userId'";
        }
        if ($this->conn->query($sqlUpdate)) {
            $status = "info";
        }
        $updateImg = false;
        if ($params[1]['updateImg'] == true) {
            $updateImg = true;
            $nameInput = $params[1]['nameInput'];
            if (uploadImage("$this->userId", "$nameInput")) {
                if ($status == "info") {
                    $status = "both";
                } else {
                    $status = "img";
                }
            } else {
                echo "<script>alert('Cập nhật ảnh lỗi')</script>";
            }
        }
        if ($updateImg == false) return "both";
        return $status;
    }
    public function setTable($table) {
        $this->table = $table;
//        echo $table;
    }
    public function setUserId($id) {
        $this->userId = $id;
    }
    public function getUserNameThroughId($id) {
        $username = $this->get("", "$id")['username'];
        return $username;
    }
}