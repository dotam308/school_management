<?php


function getActionForm($originLink, $id, $edit = true, $delete = true, $deletedElement = "", $regis = false, $addCourse = false, $studentId = "")
{
    $res = "<ul style='display: flex'>";
    if ($edit) {
        $res .= "
                <li class='item'>
                <a class='nav-link' href='$originLink?type=edit&for=$id'>
                <i class='material-icons'>edit</i>
                </a></li>";
    }
    if ($delete) {
        if ($deletedElement == '') {
            $url = "$originLink?type=delete&for=$id";
        } else {
            $url = "$originLink?type=delete&for=$id&ele=$deletedElement";
        }
        $res .= '<li class="item" onClick="confirmDelete(\'' . $url . '\')">
                <i class="material-icons text-danger" style="cursor: pointer; padding: 0.25rem 0.5rem">delete</i>
                </li>';
    }
    if ($regis) {
        $res .= "
                <li class='item'>
                
                    <a class='btn btn-info' href='registerQuery.php?type=view&for=$studentId' style='color:black; padding: 0.25rem 0.5rem;'>ĐK học</a>
                </li>";
    }
    if ($addCourse) {
        $res .= "
                <li class='item'>
                <a class='nav-link' href='registerQuery.php?type=add&for=$studentId'>
                <i class='material-icons'>add</i>
                </a></li>";
    }
    $res .= "</ul>";
    return $res;
}

//check xem diem da duoc update chua, neu nhap lan dau, diem so tra ve 0
function updateStudentOnGrade()
{
    global $conn;
    $sqlRegister = 'SELECT * FROM `registers` WHERE 1 ORDER BY id ASC';
    $sqlScore = 'SELECT * FROM `scores` ORDER BY id ASC';

    $register = $conn->query($sqlRegister);
    $score = $conn->query($sqlScore);
    $sizeR = $register->num_rows;
    $sizeS = $score->num_rows;
//    echo "score: $sizeS .. regis: $sizeR <br />";
        if ($sizeS == 0) {

            echo "1";


            $register = $conn->query($sqlRegister);
            while ($rowR = $register->fetch_assoc()) {
                $sqlInsert = "INSERT INTO `scores`(`id`, `score`, `courseId`, `studentId`)
                VALUES (NULL,0,$rowR[courseId],$rowR[studentId])";
                if ($conn->query($sqlInsert)) {
                } else {
                    echo $conn->error;
                }
            }

            $register = $conn->query($sqlRegister);
            $score = $conn->query($sqlScore);
            $sizeR = $register->num_rows;
            $sizeS = $score->num_rows;
            echo "score: $sizeS .. regis: $sizeR <br />";
        }
//         while ($sizeS < $sizeR) {
//
//            echo "2";
//
//
//            $register = $conn->query($sqlRegister);
//            $score = $conn->query($sqlScore);
//            $dataRegister = $register->fetch_all();
//            for ($i = count($dataRegister) - 1; $i >= count($dataRegister) - ($sizeR-$sizeS) - 1; $i--) {
//                $ci = $dataRegister[$i][1];
//                $si = $dataRegister[$i][2];
////                echo "active";
////                echo "<pre>";
////                print_r($dataRegister[$i]);
////                echo "</pre>";
//                $sqlInsert = "INSERT INTO `scores`(`id`, `score`, `courseId`, `studentId`)
//                VALUES (NULL,0,'$ci','$si')";
//
//                if ($conn->query($sqlInsert)) {
//                } else {
//                    echo $conn->error;
//                }
//
//                $register = $conn->query($sqlRegister);
//                $score = $conn->query($sqlScore);
//                $sizeR = $register->num_rows;
//                $sizeS = $score->num_rows;
////                echo "score: $sizeS .. regis: $sizeR <br />";
//            }
//        }
//         if ($sizeS > $sizeR) { //xu li duplicate, xoa o regis nhung chua update tai score
//            echo "3";
//
//            //xu li duplicate
//            $queryStadardScore = "SELECT *, CONCAT(courseId, '_', studentId) cs FROM `scores`
//                    GROUP BY cs"; //lay cac phan tu phan biet
//            $data = $conn->query($queryStadardScore)->fetch_all();
//
//            $conn->query("DELETE FROM scores WHERE 1");
//
//            for ($i = 0; $i < count($data); $i++) {
//                $id = $data[$i][0];
//                $score = $data[$i][1];
//                $ci = $data[$i][2];
//                $si = $data[$i][3];
//                $sqlInsert = "INSERT INTO `scores`(`id`, `score`, `courseId`, `studentId`)
//                VALUES ('$id','$score','$ci','$si')";
//
//                if ($conn->query($sqlInsert)) {
//                } else {
//                    echo $conn->error;
//                }
//            }
//
//            //xu li xoa o regis nhung chua update tai score
//            $sqlRegister = 'SELECT * FROM `registers` WHERE 1 ORDER BY studentId ASC';
//            $sqlScore = 'SELECT * FROM `scores` ORDER BY studentId ASC';
//            $register = $conn->query($sqlRegister);
//            $score = $conn->query($sqlScore);
//
//
//
//        }
//
//


}

function selectElementFrom($table, $element = '*', $condition = "1")
{
    global $conn;
    $sqlSelect = "SELECT $element FROM $table WHERE $condition";
    $query = $conn->query($sqlSelect);
    return $query;

}

function createSelectClasses($oldClass = 0)
{
    global $conn;

    $sqlSelectClasses = "SELECT * FROM `classes` WHERE 1";
    $queryClasses = $conn->query($sqlSelectClasses);

    if ($queryClasses) {

        $classData = $queryClasses->fetch_all();

        $classes = array();
        for ($i = 0; $i < count($classData); $i++) {
            $classes[$classData[$i][0]] = $classData[$i][1];
        }
        $selectClass = "<select name='selectedClass' class='form-select form-control'>";
        $selectClass .= "<ul class='dropdown-menu' aria-labelledby='dropdownMenuOffset'>";

        $selectClass .= "<li class='dropdown-item'><option selected>Chọn</option></li>";
        foreach ($classes as $key => $value) {
            if ($key == $oldClass) {

                $selectClass .= "<li class='dropdown-item'><option value='$key' selected='selected'>$value</option></li>";
            } else {

                $selectClass .= "<li class='dropdown-item'><option value='$key'>$value</option></li>";
            }
        }
        $selectClass .= "</ul>";
        $selectClass .= "</select>";

        return $selectClass;
    }
}

function showScores($studentId)
{
    global $conn;
    $sum = 0;
    $toTalCredit = 0;
    $sqlGetStudentThroughId = "SELECT fullName FROM `students` WHERE `id` = '$studentId'";
    $student = $conn->query($sqlGetStudentThroughId)->fetch_all()[0][0];

    echo "<h3 style='text-align: center; color: red'>Kết quả học tập</h3>";
    echo "<div style='display: flex; margin: 0px 300px'>
                            <div style='margin-right: auto;'>Mã sinh viên: $studentId</div>
                            <div> Sinh viên: $student </div>

                        </div>";
    echo "<form  method='post' action='#'>
                                <table class='table' style='width:  100%;'>
                                    <tr>
                                        <th>Mã môn học</th>
                                        <th>Tên môn học</th>
                                        <th>Số tín</th>
                                        <th>Điểm</th>
                                    </tr>";
    $sqlGetData = "SELECT * FROM `registers` WHERE studentId='$studentId'";

    if ($res = $conn->query($sqlGetData)) {
        $data = $res->fetch_all();
        for ($i = 0; $i < count($data); $i++) {
            $courseId = $data[$i][1];

            $sqlSelectCourseThroughId = "SELECT * FROM `courses` WHERE `id`='$courseId'";
            $courseData = $conn->query($sqlSelectCourseThroughId)->fetch_all()[0];


            $sqlSelectScoreThroughId = "SELECT score FROM `scores`
        	            WHERE `courseId`='$courseId' AND `studentId` ='$studentId'";


            $scoreData = $conn->query($sqlSelectScoreThroughId)->fetch_all();

            if (count($scoreData) > 0) {

                $scoreOfThisCourse = $scoreData[0][0];
                $valueT = $scoreOfThisCourse;
                $sum += $valueT * $courseData[1];
            } else {
                $valueT = 0;
            }

            $toTalCredit += $courseData[1];

            echo "
        	            <tr>
        	            <td>$courseData[5]</td>
        	            <td>$courseData[6]</td>
        	            <td>$courseData[1]</td>
        	            <td><input type='text' name='$courseData[0]_$studentId' style='width: 50px;' value='$valueT'></td>
        	            </tr>
        	            ";
        }

        $res = 0;
        if ($toTalCredit != 0) {
            $avg = $sum / $toTalCredit;
            $res = round($avg, 1);
        }
        echo "Điểm trung bình: $res <br />";
        ?>
        </table>

        <button type="submit" name="submit" value="submit" class="btn btn-primary">Ghi nhận</button>
        <a type="submit" class="btn btn-info" href="registerQuery.php?type=view&for=<?= $studentId ?>">Quay lại</a>
        </form>

        <?php
    } else {
        echo "error at GetData";
    }

}

function getDetailData($data)
{

    $info = explode("_", $data);
    $id = $info[sizeof($info) - 1];
    array_pop($info);
    $courseName = implode(" ", $info);


    $res = array();
    $res[] = $courseName;
    $res[] = $id;
    return $res;
}

function filterScores()
{
    global $conn;
    $studentId = isset($_POST['studentId']) ? $_POST['studentId'] : '';
    $studentName = isset($_POST['studentName']) ? $_POST['studentName'] : '';
    $className = isset($_POST['className']) ? $_POST['className'] : '';
    $courseName = isset($_POST['courseName']) ? $_POST['courseName'] : '';
    $courseCode = isset($_POST['courseCode']) ? $_POST['courseCode'] : '';

    $condition = "";
    $statusFilter = array();
    if ($studentId != '') {
        $condition .= "studentId = '$studentId' ";
        $statusFilter['si'] = 'yes';
    } else {

        $statusFilter['si'] = 'no';
    }

    if ($studentName != '') {
        if ($statusFilter['si'] == 'yes') {
            $condition .= " AND fullName = '$studentName'";
        } else {
            $condition .= " fullName = '$studentName'";
        }
        $statusFilter['sn'] = 'yes';
    } else {
        $statusFilter['sn'] = 'no';
    }
    if ($className != '') {
        $sqlSelectClass = "SELECT * FROM classes WHERE className='$className'";

        $selectClass = $conn->query($sqlSelectClass);
        $class = $selectClass->fetch_assoc();
        $classId = $class['id'];

        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes') {
            $condition .= " AND classId = '$classId'";
        } else {
            $condition .= " classId = '$classId'";
        }
        $statusFilter['cl'] = 'yes';
    } else {

        $statusFilter['cl'] = 'no';
    }

    if ($courseName != '') {
        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes' ||
            $statusFilter['cl'] == 'yes') {

            $condition .= " AND courseName = '$courseName'";
        } else {
            $condition .= " courseName = '$courseName'";
        }
        $statusFilter['cn'] = 'yes';
    } else {

        $statusFilter['cn'] = 'no';
    }
    if ($courseCode != '') {
        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes' ||
            $statusFilter['cl'] == 'yes' || $statusFilter['cn'] == 'yes') {

            $condition .= " AND courseCode = '$courseCode'";
        } else {
            $condition .= " courseCode = '$courseCode'";
        }
        $statusFilter['cc'] = 'yes';
    } else {
        $statusFilter['cc'] = 'no';
    }

    $condition = (strlen($condition) > 0) ? $condition : 1;
    $sqlSelectAll = "SELECT scores.id scoreId, scores.score, courseId, courses.courseName, 
                                        courses.courseCode, studentId, students.fullName, students.classId
                                            FROM `scores` LEFT JOIN students
                                                ON scores.studentId = students.id
                                                    LEFT JOIN courses
                                                    ON scores.courseId = courses.id
                                            WHERE $condition";
    $res = $conn->query($sqlSelectAll);
    return $res;


}
function filterRegisterList()
{
    global $conn;
    $studentId = isset($_POST['studentId']) ? $_POST['studentId'] : '';
    $studentName = isset($_POST['studentName']) ? $_POST['studentName'] : '';
    $className = isset($_POST['className']) ? $_POST['className'] : '';
    $courseName = isset($_POST['courseName']) ? $_POST['courseName'] : '';
    $courseCode = isset($_POST['courseCode']) ? $_POST['courseCode'] : '';
    $courseClassCode = isset($_POST['courseClassCode']) ? $_POST['courseClassCode'] : '';
    $credit = isset($_POST['credit']) ? $_POST['credit'] : '';

    $condition = "";
    $statusFilter = array();
    if ($studentId != '') {
        $condition .= "studentId = '$studentId' ";
        $statusFilter['si'] = 'yes';
    } else {

        $statusFilter['si'] = 'no';
    }

    if ($studentName != '') {
        if ($statusFilter['si'] == 'yes') {
            $condition .= " AND fullName = '$studentName'";
        } else {
            $condition .= " fullName = '$studentName'";
        }
        $statusFilter['sn'] = 'yes';
    } else {
        $statusFilter['sn'] = 'no';
    }
    if ($className != '') {
        $sqlSelectClass = "SELECT * FROM classes WHERE className='$className'";

        $selectClass = $conn->query($sqlSelectClass);
        $class = $selectClass->fetch_assoc();
        $classId = $class['id'];

        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes') {
            $condition .= " AND classId = '$classId'";
        } else {
            $condition .= " classId = '$classId'";
        }
        $statusFilter['cl'] = 'yes';
    } else {

        $statusFilter['cl'] = 'no';
    }
    if ($courseCode != '') {
        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes' ||
            $statusFilter['cl'] == 'yes' ) {

            $condition .= " AND courseCode = '$courseCode'";
        } else {
            $condition .= " courseCode = '$courseCode'";
        }
        $statusFilter['cc'] = 'yes';
    } else {
        $statusFilter['cc'] = 'no';
    }
    if ($courseName != '') {
        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes' ||
            $statusFilter['cl'] == 'yes'|| $statusFilter['cc'] == 'yes') {

            $condition .= " AND courseName = '$courseName'";
        } else {
            $condition .= " courseName = '$courseName'";
        }
        $statusFilter['cn'] = 'yes';
    } else {

        $statusFilter['cn'] = 'no';
    }

    if ($courseClassCode != '') {
        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes' ||
            $statusFilter['cl'] == 'yes'|| $statusFilter['cc'] == 'yes' || $statusFilter['cn'] == 'yes' ) {

            $condition .= " AND courseClassCode = '$courseClassCode'";
        } else {
            $condition .= " courseClassCode = '$courseClassCode'";
        }
        $statusFilter['ccl'] = 'yes';
    } else {

        $statusFilter['ccl'] = 'no';
    }
    if ($credit != '') {
        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes' || $statusFilter['cl'] == 'yes'||
            $statusFilter['cc'] == 'yes' || $statusFilter['cn'] == 'yes' || $statusFilter['ccl'] == 'yes') {

            $condition .= " AND credit = '$credit'";
        } else {
            $condition .= " credit = '$credit'";
        }
        $statusFilter['cd'] = 'yes';
    } else {

        $statusFilter['cd'] = 'no';
    }

    $condition = (strlen($condition) > 0) ? $condition : 1;
    $sqlSelectAll = "SELECT courseId, courses.courseName, 
                                        courses.courseCode, studentId, students.fullName, students.classId
                                            FROM `registers` LEFT JOIN students
                                                ON registers.studentId = students.id
                                                    LEFT JOIN courses
                                                    ON registers.courseId = courses.id
                                            WHERE $condition";
    $res = $conn->query($sqlSelectAll);
    return $res;


}

function filterStudents()
{
    global $conn;
    $studentId = isset($_POST['studentId']) ? $_POST['studentId'] : '';
    $studentName = isset($_POST['studentName']) ? $_POST['studentName'] : '';
    $className = isset($_POST['className']) ? $_POST['className'] : '';
    $contactNumber = isset($_POST['contactNumber']) ? $_POST['contactNumber'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';

    $condition = "";
    $statusFilter = array();
    if ($studentId != '') {
        $condition .= " id = '$studentId' ";
        $statusFilter['si'] = 'yes';
    } else {

        $statusFilter['si'] = 'no';
    }

    if ($studentName != '') {
        if ($statusFilter['si'] == 'yes') {
            $condition .= " AND fullName = '$studentName'";
        } else {
            $condition .= " fullName = '$studentName'";
        }
        $statusFilter['sn'] = 'yes';
    } else {
        $statusFilter['sn'] = 'no';
    }
    if ($className != '') {
        $sqlSelectClass = "SELECT * FROM classes WHERE className='$className'";

        $selectClass = $conn->query($sqlSelectClass);
        $class = $selectClass->fetch_assoc();
        $classId = $class['id'];

        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes') {
            $condition .= " AND classId = '$classId'";
        } else {
            $condition .= " classId = '$classId'";
        }
        $statusFilter['cl'] = 'yes';
    } else {

        $statusFilter['cl'] = 'no';
    }

    if ($contactNumber != '') {

        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes' || $statusFilter['cl'] == 'yes') {
            $condition .= " AND contactNumber = '$contactNumber'";
        } else {
            $condition .= " contactNumber = '$contactNumber'";
        }
        $statusFilter['ctn'] = 'yes';
    } else {

        $statusFilter['ctn'] = 'no';
    }
    if ($dob != '') {
        if ($statusFilter['sn'] == 'yes' || $statusFilter['si'] == 'yes' || $statusFilter['cl'] == 'yes' ||
                $statusFilter['ctn'] == 'yes') {
            $condition .= " AND dob='$dob'";
        } else {
            $condition .= " dob='$dob'";
        }
        $statusFilter['dob'] = 'yes';
    } else {

        $statusFilter['dob'] = 'no';
    }

    $condition = (strlen($condition) > 0) ? $condition : 1;
    $sqlSelectAll = "SELECT * FROM students
                            WHERE $condition";
    echo $sqlSelectAll;
    $res = $conn->query($sqlSelectAll);
    return $res;


}

function getHighestScoreStudents(){
    global $conn;
    $sqlSelectTop = "SELECT  total.studentId, total.totalScores/total.totalCredits gpa
            FROM (SELECT scores.id, score, courses.credit ,studentId, SUM(score*credit) totalScores, SUM(credit) totalCredits
            FROM `scores` LEFT JOIN courses
                ON scores.courseId = courses.id
            GROUP BY studentId) total  
            ORDER BY `gpa`  DESC";

    $topStudents = $conn->query($sqlSelectTop);
    $numTop = 4;
    $listTopStudents = array();
    while ($row = $topStudents->fetch_assoc()) {
        $studentId = $row['studentId'];
        $selectStudent = selectElementFrom('students', "*", "id=$studentId");
        $student = $selectStudent->fetch_assoc();

        $classID = $student['classId'];
        $selectClass = selectElementFrom('classes', "*", "id='$classID'");
        $class = $selectClass->fetch_assoc();

        $listTopStudents[] = array("id"=>$studentId, "name"=>$student['fullName'],
            "className"=>$class['className'], "score"=>$row['gpa']);
        $numTop--;
        if ($numTop <= 0) break;
    }
    return $listTopStudents;


}

?>
