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
            return $this->conn->query($sqlGet)->fetch_assoc();
        } else {
            $sqlGet = "select * from {$this->table}";
        }
//        echo $sqlGet;
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
}