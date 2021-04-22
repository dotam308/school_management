<?php
    require_once 'connection.php';
    function queryOnCourse($type) {
        global $conn;
        
        $myTable = "courses";
        
        $sqlGetTeachers = 'SELECT * FROM `teachers` WHERE 1';
        $teachersData = $conn->query($sqlGetTeachers);
        $teachers = $teachersData->fetch_all();
        
        if ($type == 'view') {
            $sql = "SELECT * from $myTable";
            $result = $conn->query($sql);
            
            echo "<div class='item'>
                            <a class='nav-link' href='manageCourse.php?type=add'>
                             <i class='material-icons'>add</i>
                            </a>
                        </div>";
            
            if ($result->num_rows <= 0) {
                echo "0 results";
            } else {
                
                
                
                // output data of each row
                echo "
                                    <form method='get'>
                                    <table style='width:100%; text-align: left' class='table'>
                                  <tr>";
                
                echo "<th>Mã ID</th>
                       <th>Số tín</th>
                    
                       <th>Mã khoá học</th>
                       <th>Tên khoá học</th>
                       <th>Mã lớp môn học</th>
                       <th>Sĩ số tối đa</th>
                       <th>Giáo viên</th>
                       <th>Thời gian</th>
                       <th>Địa điểm</th>
                        <th>Action</th>
                    
                       </tr>";
                
                while ($row = $result->fetch_assoc()) {
                    
                    $query = getActionForm('manageCourse.php', $row['id']);
                    $sqlFindTeacherNameThroughId = "SELECT `fullName` FROM `teachers` WHERE id ='$row[teacherId]'";
                    
                    global $teacherName;
                    if ($teacherName = $conn->query($sqlFindTeacherNameThroughId)) {
                        
                        $nameTeacher = $teacherName->fetch_all()[0][0];
                    } else {
                        echo $conn->error;
                    }
                    echo "<tr>";
                    echo "<td>$row[id]</td>
                    <td>$row[credit]</td>
                    <td>$row[courseCode]</td>
                    <td>$row[courseName]</td>
                    <td>$row[courseClassCode]</td>
                    <td>$row[maxStudent]</td>
                    <td>$nameTeacher</td>
                    <td>$row[startTime] -$row[endTime]  </td>
                    <td>$row[place]</td>
                    <td>$query</td>
                    </tr>";
                }
                
                echo "
                            </table>
                            </form>";
            }
        }
        if ($type == 'add') {
            
            $selectTeachers = "
                                <select name='selectTeacher'>
                                    <option value='' selected='selected'>----select----</option>";
            for ($i = 0; $i < count($teachers); $i++) {
                $fullName = $teachers[$i][1];
                $id = $teachers[$i][0];
                $showTeacher = $fullName . "-" . $id;
                $flag = '';
                if (isset($selected) && $selected == $id) {
                    $flag = 'selected';
                }
                $selectTeachers .= "<option selected='$flag' value='$id'>$showTeacher</option>";
            }
            $selectTeachers .= '</select>';
            
            echo " <form method='post' action='#'>
                                <table style='width:100%' class='table'>
                                <tr>";
            
            echo "<th>Mã ID</th>
                       <th>Số tín</th>
                       <th>Mã khoá học</th>
                       <th>Tên khoá học</th>
                       <th>Mã lớp môn học</th>
                       <th>Sĩ số tối đa</th>
                       <th>Giáo viên</th>
                       <th>Bắt đầu</th>
                       <th>Kết thúc</th>
                       <th>Địa điểm</th>
                
                       </tr>";
            
            echo "<td><input type='text' name='id'/></td>
            <td><input type='text' name='credit'/></td>
            <td><input type='text' name='courseCode'/></td>
            <td><input type='text' name='courseName'/></td>
            <td><input type='text' name='courseClassCode'/></td>
            <td><input type='text' name='maxStudent'/></td>
            <td>$selectTeachers</td>
            <td><input type='text' name='startTime'/></td>
            <td><input type='text' name='endTime'/></td>
            <td><input type='text' name='place'/></td>
            
            </tr>";
            
            echo "
                    </table>
                    <button type='submit'>Go</button>
                    </form>";
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                // Thiết lập mảng lưu lỗi => Mặc định rỗng
                $error = array();
                if (empty($_POST['selectTeacher'])) {
                    $error['selectTeacher'] = "Bạn cần chọn giáo viên";
                } else {
                    $selected = $_POST['selectTeacher'];
                }
                // Kiểm tra có lỗi hay không
                if (empty($error)) {
                    //                     echo $selected;
                    // Xử lý dữ liệu khi không gặp lỗi nhập liệu
                }
            }
            
            if (isset($_POST['id'])) {
                
                
                $sqlInsert = "INSERT INTO `courses` (`id`, `credit`, `startTime`, `endTime`, `place`, `courseCode`, `courseName`, `courseClassCode`, `maxStudent`, `teacherId`)
                VALUES ('$_POST[id]', '$_POST[credit]', '$_POST[startTime]', '$_POST[endTime]', '$_POST[place]', '$_POST[courseCode]', '$_POST[courseName]', '$_POST[courseClassCode]', '$_POST[maxStudent]', '$_POST[selectTeacher]')";
                
                if ($result = $conn->query($sqlInsert)) {
                    echo 'Added successfully';
                } else {
                    echo $conn->error . " error at Add";
                }
            }
        }
        
        if (isset($_GET['type']) && isset($_GET['for'])) {
            $t = $_GET['type'];
            if ($t != 'view') {
                $id = $_GET['for'];
                
                $sqlSelectTeacher = "SELECT * FROM `$myTable` WHERE id=$id";
                
                $res = $conn->query($sqlSelectTeacher);
                $oldData = $res->fetch_all()[0];
                
                
                if ($t == 'edit') {
                    $selectTeachers = "
                                <select name='selectTeacher'>
                                    <option value='' selected='selected'>----select----</option>";
                    for ($i = 0; $i < count($teachers); $i++) {
                        $fullName = $teachers[$i][1];
                        $id = $teachers[$i][0];
                        $showTeacher = $fullName . "-" . $id;
                        $flag = '';
                        if ((isset($selected) && $selected == $id) || $oldData[9] == $id) {
                            $flag = 'selected';
                        }
                        
                        $selectTeachers .= "<option selected='$flag' value='$id'>$showTeacher</option>";
                    }
                    $selectTeachers .= '</select>';
                    echo " <form method='post' action='#'>
                                <table style='width:100%' class='table'>
                                <tr>";
                    
                    echo "<th>Mã ID</th>
                               <th>Số tín</th>
                               <th>Mã khoá học</th>
                               <th>Tên khoá học</th>
                               <th>Mã lớp môn học</th>
                               <th>Sĩ số tối đa</th>
                               <th>Giáo viên</th>
                               <th>Bắt đầu</th>
                               <th>Kết thúc</th>
                               <th>Địa điểm</th>
                        
                               </tr>";
                    $sqlFindTeacherNameThroughId = "SELECT `fullName` FROM `teachers` WHERE id ='$oldData[9]'";
                    
                    $teacherName = $conn->query($sqlFindTeacherNameThroughId)->fetch_all()[0][0];
                    
                    
                    echo "<td><input type='text' name='id1' value='$oldData[0]'/></td>
                    <td><input type='text' name='credit' value='$oldData[1]'/></td>
                    <td><input type='text' name='courseCode' value='$oldData[5]'/></td>
                    <td><input type='text' name='courseName' value='$oldData[6]'/></td>
                    <td><input type='text' name='courseClassCode' value='$oldData[7]'/></td>
                    <td><input type='text' name='maxStudent' value='$oldData[8]'/></td>
                    <td>$selectTeachers</td>
                    <td><input type='text' name='startTime' value='$oldData[2]'/></td>
                    <td><input type='text' name='endTime' value='$oldData[3]'/></td>
                    <td><input type='text' name='place' value='$oldData[4]'/></td>
                    
                    </tr>";
                    
                    echo "
                                    </table>
                                    <button type='submit'>Go</button>
                                    </form>";
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        // Thiết lập mảng lưu lỗi => Mặc định rỗng
                        $error = array();
                        if (empty($_POST['selectTeacher'])) {
                            $error['selectTeacher'] = "Bạn cần chọn giáo viên";
                        } else {
                            $selected = $_POST['selectTeacher'];
                        }
                        // Kiểm tra có lỗi hay không
                        if (empty($error)) {
                            //                     echo $selected;
                            // Xử lý dữ liệu khi không gặp lỗi nhập liệu
                        }
                    }
                    if (isset($_POST['id1'])) {
                        
                        
                        $sqlUpdate = "UPDATE `courses` SET `id`='$_POST[id1]',`credit`='$_POST[credit]',`startTime`='$_POST[startTime]',
                        `endTime`='$_POST[endTime]',`place`='$_POST[place]',`courseCode`='$_POST[courseCode]',`courseName`='$_POST[courseName]',
                        `courseClassCode`='$_POST[courseClassCode]',`maxStudent`='$_POST[maxStudent]',`teacherId`='$_POST[selectTeacher]' WHERE id='$oldData[0]'";
                        if ($conn->query($sqlUpdate)) {
                            echo '<p>Updated successfully</p>';
                            echo "<a href='manageCourse.php?type=view' type='button'>Back</a>";
                        } else {
                            echo $conn->error . "error at update Course";
                        }
                    }
                } else if ($t == 'delete') {
                    
                    $sqlDelete = "DELETE FROM `$myTable` WHERE id=$oldData[0]";
                    
                    if ($conn->query($sqlDelete)) {
                        echo '<p>Deleted successfully</p>';
                        echo "<a href='manageCourse.php?type=view' type='button'>Back</a>";
                    } else {
                        echo $conn->error . " error at delete";
                    }
                }
            } else {
                echo $conn->error . " error at selectCourse";
            }
        }
    }