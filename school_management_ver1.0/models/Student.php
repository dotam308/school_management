<?php
require_once 'BaseModel.php';
//require_once "../function/functions.php";
//require_once 'connection.php';
class Student extends BaseModel
{
    protected $table = 'students';
    public function __construct($id = '')
    {
        parent::__construct($id);
    }



    public function update($params)
    {
        global $conn;
        $myTable = 'students';
        $date = strtotime($params[2]);
        $dob = date('Y-m-d', $date);

        $sqlUpdate = "UPDATE `$myTable` SET `fullname`='$params[0]',`classId`='$params[3]',`contactNumber`='$params[1]',
                   `dob`='$dob' WHERE id='$this->id'";

        return $conn->query($sqlUpdate);
    }
}
