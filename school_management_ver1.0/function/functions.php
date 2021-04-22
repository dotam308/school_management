    
<?php
    function getActionForm($originLink, $id, $edit = true, $delete=true)
    {
        $res = "<form class='query-form' method='get'>
    
                <ul style='display: flex'>";
            if ($edit) {
                $res .= "
                <li class='item'>
                <a class='nav-link' href='$originLink?type=edit&for=$id'>
                <i class='material-icons'>edit</i>
                </a>";
            }
            if ($delete) {
                $res .="</li>;
                <li class='item'>
                <a class='nav-link' href='$originLink?type=delete&for=$id'>
                <i class='material-icons'>delete</i>
                </a>
                </li>";
            }
                
               $res .= " </ul>
            </form>";
        return $res;
    }
    function updateStudentOnGrade() {
        global $conn;
        $sql = 'SELECT * FROM `registers` WHERE 1';
        $sqlGrade = 'SELECT * FROM `scores` WHERE 1';
        $data = $conn->query($sqlGrade)->fetch_all();
        
        if ($res = $conn->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                $courseId = $row['courseId'];
                $studentId = $row['studentId'];
                
                $exist = false;
                for ($i = 0; $i < count($data); $i++) {
                    if ($courseId == $data[$i][2] && $studentId == $data[$i][3]) {
                        $exist = true;
                        break;
                    }
                }
                
                if (!$exist) {
                    $sqlUpdate = "INSERT INTO `scores` (`id`, `score`, `courseId`, `studentId`)
                    VALUES (NULL, '0', '$courseId', '$studentId');";
                    if ($conn->query($sqlUpdate)) {
                        
                    } else {
                        echo $conn->error;
                    }
                }
            }
        } else {
            echo $conn->error;
        }
    }
?>
