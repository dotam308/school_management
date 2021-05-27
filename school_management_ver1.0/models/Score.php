<?php

require_once "BaseModel.php";
class Score extends BaseModel
{
    protected $table = 'scores';
    protected $fields = ['id', 'score', 'courseId', 'studentId'];
    protected $scoreId;

    public function update($score)
    {
        $sqlUpdate = "UPDATE `scores` SET `score`='$score' 
            WHERE $this->id_name = $this->scoreId";
        return $this->conn->query($sqlUpdate);
    }

    public function get($scoreId='')
    {
        if ($scoreId == '') {
            $sqlGet = "select * from {$this->table}";
//            echo $sqlGet;
            $queryClass = $this->conn->query($sqlGet);
            return $queryClass ? $queryClass->fetch_all(MYSQLI_ASSOC) : null;
        } else {
            $sqlGet = "select * from {$this->table} WHERE id='$scoreId'";
            $queryClass = $this->conn->query($sqlGet);
            return $queryClass ? $queryClass->fetch_array(MYSQLI_ASSOC) : null;
        }
    }

    public function delete($scoreId)
    {
        return $this->conn->query("DELETE from {$this->table} 
            WHERE id='$scoreId'");
    }
    public function getScoreId($courseId, $studentId) {
        $sqlSelect ="SELECT * FROM $this->table 
                        WHERE studentId='$studentId' AND courseId='$courseId'";
        $queryScore = $this->conn->query($sqlSelect);
        echo $sqlSelect;
        $scoreId = $queryScore?$queryScore->fetch_assoc()['id'] : 'nExisted';
        return $scoreId;
    }
    public function setScoreId($scoreId="", $courseId="", $studentId=""){
        $this->scoreId = $scoreId;
        if ($courseId != '' && $studentId != '') {
            $this->scoreId = $this->getScoreId($courseId, $studentId);
        }
    }
}