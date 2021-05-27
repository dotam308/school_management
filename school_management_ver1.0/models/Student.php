<?php
require_once 'BaseModel.php';
//require_once "../function/functions.php";
//require_once 'connection.php';
class Student extends BaseModel
{
    protected $table = 'students';
    protected $fields = ['id', 'fullName', 'classId', 'contactNumber', 'dob'];
    private $id = '';
    public function update($params)
    {
        if ($this->id == '') {
            echo 'error at update student';
            return false;
        }
        $date = strtotime($params['dob']);
        $params['dob'] = date('Y-m-d', $date);
        $updateContent = array();
        foreach ($params as $key=>$value) {
            $updateContent[] = "$key" . "=" . "'$value'";
        }
        $updateContent = implode(", ", $updateContent);
        $sqlUpdate = "UPDATE `$this->table` SET $updateContent WHERE $this->id_name='$this->id'";

        return $this->conn->query($sqlUpdate);
    }
    public function setId($id){
        $this->id = $id;
    }
}