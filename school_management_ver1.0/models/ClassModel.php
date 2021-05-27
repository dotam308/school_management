<?php
require_once "BaseModel.php";

class ClassModel extends BaseModel
{
    protected $table = "classes";
    protected $fields = ['className', 'id', 'maxStudent', 'numOfStudent', 'teacherId'];
    private $id;
    public function update($params)
    {
        if (empty($this->id)) return false;
        $sqlUpdate = "UPDATE `$this->table`
                            SET `className`='$params[className]',`maxStudent`='$params[maxStudent]',
                            `teacherId`='$params[teacherId]'
                            WHERE id='$this->id'";
        return $this->conn->query($sqlUpdate);
    }
    public function setId($id){
        $this->id=$id;
    }

}