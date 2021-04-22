<?php
require_once './connection.php';
require_once 'functions.php';
    function registerQuery($type, $id, $name, $class)
    {
        global $conn;
        switch ($type) {
            case "view":
                $sql = "SELECT * FROM `registers` WHERE studentId = '$id'";
                if ($result = $conn->query($sql)) {} else {
                    echo "error at View type";
                }
                
                if ($result->num_rows <= 0) {
                    echo "Bạn chưa đăng ký môn học";
                } else {
                    echo "<table class='table'>
                                    <tr>
                                        <th>Mã sinh viên</th>
                                        <th>Họ tên</th>
                                        <th>Lớp</th>
                                        <th>Tên môn học</th>
                                        <th>Mã lớp môn học</th>
                                        <th>Số tín chỉ</th>
                                        <th>Giáo viên</th>
                                        <th>Thời gian</th>
                                        <th>Địa điểm</th>
                                        <th>Action</th>
                                    </tr>";
                    while ($row = $result->fetch_assoc()) {
                        
                        $sqlGetCourse = "SELECT  `credit`, `courseName`,
                        `courseClassCode`, startTime, endTime, place, `teacherId`
                        FROM `courses` WHERE `id` = '$row[courseId]'";
                        
                        
                        $registeredCourses = $conn->query($sqlGetCourse)->fetch_all();
                        
                        for ($j = 0; $j < count($registeredCourses); $j++) {
                            
                            
                            $query = getActionForm('registerQuery.php', $row['id'], false, true);
                            $courseClassCode = $registeredCourses[$j][2];
                            $credit = $registeredCourses[$j][0];
                            $courseName = $registeredCourses[$j][1];
                            $time = $registeredCourses[$j][3] ."-". $registeredCourses[$j][4];
                            $place = $registeredCourses[$j][5];
                            
                            $idTeacher =$registeredCourses[$j][6];
                            $sqlSelectTeacher =
                            "SELECT fullName
                            FROM teachers
                            WHERE id = '$idTeacher'";                                    ;
                            $teacher = $conn->query($sqlSelectTeacher)->fetch_all()[0][0];
                            
                            echo "<tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$class</td>
                            <td>$courseName</td>
                            <td>$courseClassCode</td>
                            <td>$credit</td>
                            <td>$teacher</td>
                            <td>$time</td>
                            <td>$place</td>
                            <td>$query</td>
                            
                            </tr>";
                        }
                        
                    }
                    
                    echo "</table>";
                }
                
                break;
            case "add":
                echo "<div><h3 class='title'>Đăng ký môn học</h3>";
                $sqlSelectCourses = "SELECT * FROM `courses` WHERE 1";
                $result = $conn->query($sqlSelectCourses);
                
                if ($result->num_rows <= 0) {
                    echo "Chưa có môn học đăng ký";
                } else {
                    echo "
                        
                                    <form action='#' method='post'>
                                        <table class='table'>
                                            <tr>
                                                <th>Chọn</th>
                                                <th>Tên môn học</th>
                                                <th>Mã môn học</th>
                                                <th>Mã lớp môn học</th>
                                                <th>Số tín chỉ</th>
                                                <th>Giáo viên</th>
                                                <th>Thời gian</th>
                                                <th>Địa điểm</th>
                                            </tr>";
                    
                    while ($row = $result->fetch_assoc()) {
                        
                        $idTeacher =$row['teacherId'];
                        $sqlSelectTeacher =
                        "SELECT fullName
                        FROM teachers
                        WHERE id = '$idTeacher'";                                    ;
                        $teacher = $conn->query($sqlSelectTeacher)->fetch_all()[0][0];
                        echo "<tr>
                        <td><input type='checkbox' name='$row[courseCode]'/></td>
                        <td>$row[courseName]</td>
                        <td>$row[courseCode]</td>
                        <td>$row[courseClassCode]</td>
                        <td>$row[credit]</td>
                        <td>$teacher</td>
                        <td>$row[startTime]-$row[endTime]</td>
                        <td>$row[place]</td>
                        
                        </tr>";
                    }
                    echo "
                                </table>
                                <button type='submit'>Xác nhận</button>
                                </form>";
                    
                    $result = $conn->query($sqlSelectCourses);
                    if (isset($_POST)) {
                        foreach ($_POST as $key => $value) {
                            
                            while ($row = $result->fetch_assoc()) {
                                
                                if ($row['courseCode'] == $key) {
                                    // check xem da dang ki mon hoc do chua
                                    $registeredCourses = array();
                                    
                                    $sqlGetRC = "SELECT `courseId` FROM `registers` WHERE `studentId` = '$id'";
                                    $resFromGetRC = $conn->query($sqlGetRC)->fetch_all();
                                    
                                    $registeredCourses = array();
                                    for ($index= 0; $index < count($resFromGetRC); $index++) {
                                        $registeredCourses[] = $resFromGetRC[$index][0];
                                    }
                                    
                                    global $exist;
                                    $exist = false;
                                    
                                    if (gettype($registeredCourses) == "array") {
                                        for ($index = 0; $index < count($registeredCourses); $index ++) {
                                            
                                            $courseId = $registeredCourses[$index];
                                            
                                            $sqlFindCourseNameThroughId = "SELECT`courseCode` FROM `courses` WHERE `id` = '$courseId'";
                                            $courseN = $conn->query($sqlFindCourseNameThroughId)->fetch_all()[0][0];
                                            
                                            
                                            if ($key == $courseN) {
                                                echo "Bạn đã đăng ký môn học $key <br/>";
                                                $exist = true;
                                            }
                                        }
                                    }
                                    
                                    if (!$exist) {
                                        $sqlUpdateRegisCourse = "INSERT INTO `registers` (`id`, `courseId`, `studentId`)
                                        VALUES (NULL, '$row[id]', '$id');";
                                        if ($conn->query($sqlUpdateRegisCourse)) {
                                            echo "Thêm khoá học $row[courseName] thành công <br/>";
                                        } else {
                                            echo 'error AT UpdateRegisCourse' . $conn->error;
                                        }
                                    }
                                }
                            }
                            
                            $result = $conn->query($sqlSelectCourses);
                        }
                    }
                }
                
                break;
            case "delete":
                if (isset($_GET['for'])) {
                    
                    $sqlDeleteSelected = "DELETE FROM `registers` WHERE `id` = '$_GET[for]'";
                    if ($result = $conn->query($sqlDeleteSelected)) {
                        echo '<p>Deleted successfully</p>';
                        echo "<a href='registerQuery.php?type=view'>Back</a>";
                        
                    } else {
                        echo $conn->error;
                    }
                }
                
                
                break;
            default:
                break;
        }
    }