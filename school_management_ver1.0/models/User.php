<?php

require_once "BaseModel.php";
class User extends BaseModel
{
    protected $table = 'users';
    protected $username = '';
    public function __construct($username="", $id="")
    {
        global $conn;
        $this->conn = $conn;
        $this->username = $username;
        $this->id = $id;
    }
    public function get()
    {
        if ($this->username != '' || $this->id != '') {
            $sqlGet = "select * from {$this->table} where username= '{$this->username}' OR id='$this->id'";

//            echo $sqlGet;
            return $this->conn->query($sqlGet)->fetch_assoc();
        } else {
            $sqlGet = "select * from {$this->table}";
        }
        return $this->conn->query($sqlGet);
    }
    public function update($params)
    {
        // TODO: Implement update() method.
//        dd($params[0]);
        if ($params[0]['updatePass'] == true) {
            $title =$params[0]['title'];
            $pass =$params[0]['pass'];
            $representName=$params[0]['representName'];

            $sqlUpdate = "UPDATE `$this->table`
                            SET `title`='$title',`pass`='$pass',
                              `representName`='$representName' WHERE id = '$this->id'";
        } else if ($params[0]['updatePass'] == false) {

            $title =$params[0]['title'];
            $representName=$params[0]['representName'];
            $sqlUpdate = "UPDATE `$this->table`
                            SET `title`='$title',
                              `representName`='$representName' WHERE id = '$this->id'";
        }
        if ($params[1]['updateImg'] == true) {
            $nameInput = $params[1]['nameInput'];
            uploadImage("$this->id", "$nameInput");
        }
        return $this->conn->query($sqlUpdate);
    }
//    public function getIdTeacher(){
//        for ($i = 0; $i < strlen($this->username); $i++) {
//            if ($this->isNumber($this->username[$i])) {
//                return substr($this->username, $i);
//            }
//        }
//        return 'not_teacher';
//    }
//    private function isNumber($str) {
//        if ($str == '0' || $str == '1' ||$str == '2' ||$str == '3' ||$str == '4' ||$str == '5' ||$str == '6'
//                                    ||$str == '7' ||$str == '8' ||$str == '9')
//        {
//            return true;
//        }
//        return false;
//    }
    public function setTable($table) {
        $this->table = $table;
//        echo $table;
    }
}