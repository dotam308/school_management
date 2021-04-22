<?php
    require_once './connection.php';
    require_once 'functions.php';
    
    
    function queryOnStudent($type)
    {
        global $conn;
        
        $myTable = "students";
        if ($type == 'view') {
            $sql = "SELECT * from $myTable";
            $result = $conn->query($sql);
            
            echo "<div class='item'>
                        <a class='nav-link' href='manageStudent.php?type=add'>
                         <i class='material-icons'>add</i>
                        </a>
                    </div>";
            
            if ($result->num_rows <= 0) {
                echo "0 results";
            } else {
                
                // output data of each row
                echo "
                                <form method='get'>
                                <table style='width:100%' class='table'>
                              <tr>";
                
                echo "<th>Mã sinh viên</th>
                   <th>Họ tên</th>
                   <th>Lớp</th>
                   <th>Số điện thoại</th>
                   <th>Ngày sinh</th>
                   <th>Action</th>
                   
                   </tr>";
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    $query = getActionForm('manageStudent.php', $row['id']);
                    $sqlFindClassNameThroughId = "SELECT `className` FROM `classes` WHERE `id` = '$row[classId]'";
                    global $nameClass;
                    if ($className = $conn->query($sqlFindClassNameThroughId)) {
                        
                        $nameClass = $className->fetch_all()[0][0];
                    } else {
                        echo $conn->error;
                    }
                    echo "<td>$row[id]</td>
                               <td>$row[fullName]</td>
                               <td>$nameClass</td>
                               <td>$row[contactNumber]</td>
                               <td>$row[dob]</td>
                               <td>$query</td>
                           
                           </tr>";
                }
                
                echo "
                        </table>
                        </form>";
            }
        }
        if ($type == 'add') {
            
            echo " <form method='post' action='#'>
                            <table style='width:100%' class='table'>
                            <tr>";
            
            echo "<th>Mã sinh viên</th>
                               <th>Họ tên</th>
                               <th>Lớp</th>
                               <th>Số điện thoại</th>
                               <th>Ngày sinh</th>
                            
                           </tr>";
            
            echo "<td><input type='text' name='id'/></td>
                               <td><input type='text' name='fullName'/></td>
                               <td><input type='text' name='class'/></td>
                               <td><input type='text' name='contactNumber'/></td>
                               <td><input type='text' name='dob'/></td>
                            
                               </tr>";
            
            echo "
                                </table>
                                <button type='submit'>Go</button>
                                </form>";
            
            if (isset($_POST['id'])) {
                
                $sqlFindClassThroughName = "SELECT `id` FROM `classes` WHERE `className` = '$_POST[class]'";
                global $idClass;
                if ($classId = $conn->query($sqlFindClassThroughName)) {
                    
                    $idClass = $classId->fetch_all()[0][0];
                } else {
                    echo $conn->error;
                }
                
                $sqlInsert = "INSERT INTO `$myTable` (`id`, `fullname`, `classId`, `contactNumber`, `dob`) 
                            VALUES ($_POST[id], '$_POST[fullName]', '$idClass - $_POST[class]', '$_POST[contactNumber]', '$_POST[dob]')";
                
                if ($result = $conn->query($sqlInsert)) {
                    echo 'Added successfully';
                } else {
//                     echo $conn->error . " error at Add";
                    echo 'Lớp học không tồn tại hoặc Chưa nhập MSV/MSV không tồn tại';
                }
            }
        }
        
        if (isset($_GET['type']) && isset($_GET['for'])) {
            $t = $_GET['type'];
            if ($t != 'view') {
                $id = $_GET['for'];
                
                $sqlSelectStudent = "SELECT * FROM `$myTable` WHERE id=$id";
                
                $res = $conn->query($sqlSelectStudent);
                $oldData = $res->fetch_all()[0];
                
                if ($t == 'edit') {
                    echo " <form method='post' action='#'>
                            <table style='width:100%' class='table'>
                            <tr>";
                    
                    echo "<th>Mã sinh viên</th>
                               <th>Họ tên</th>
                               <th>Lớp</th>
                               <th>Số điện thoại</th>
                               <th>Ngày sinh</th>
                                
                           </tr>";
                    $sqlFindClassNameThroughId = "SELECT `className` FROM `classes` WHERE `id` = '$oldData[2]'";
                    global $nameClass;
                    if ($className = $conn->query($sqlFindClassNameThroughId)) {
                        
                        $nameClass = $className->fetch_all()[0][0];
                    } else {
                        echo $conn->error;
                    }
                    
                    echo "<td><input type='text' name='id1' value='$oldData[0]'/></td>
                               <td><input type='text' name='fullName' value='$oldData[1]'/></td>
                               <td><input type='text' name='class' value='$nameClass'/></td>
                               <td><input type='text' name='contactNumber' value='$oldData[3]'/></td>
                               <td><input type='text' name='dob' value='$oldData[4]'/></td>
                                
                               </tr>";
                    
                    echo "
                                </table>
                                <button type='submit'>Go</button>
                                </form>";
                    if (isset($_POST['id1'])) {
                        
                        $sqlFindClassThroughName = "SELECT `id` FROM `classes` WHERE `className` = '$_POST[class]'";
                        global $idClass;
                        if ($classId = $conn->query($sqlFindClassThroughName)) {
                            
                            echo "<pre>";
                            print_r($classId->fetch_all());
                            echo "</pre>";
//                             $idClass = $classId->fetch_all()[0][0];
                        } else {
                            echo $conn->error;
                        }
                        
                        $sqlUpdate = "UPDATE `$myTable` SET `id`='$_POST[id1]',`fullname`='$_POST[fullName]',`classId`='$idClass',`contactNumber`='$_POST[contactNumber]',`dob`='$_POST[dob]' 
                                                WHERE id='$oldData[0]'";
                        if ($conn->query($sqlUpdate)) {
                            echo '<p>Updated successfully</p>';
                            echo "<a href='manageStudent.php?type=view' type='button'>Back</a>";
                        } else {
                            echo $conn->error . "error at update Student";
                        }
                    }
                } else if ($t == 'delete') {
                    
                    $sqlDelete = "DELETE FROM `$myTable` WHERE id=$oldData[0]";
                    
                    if ($conn->query($sqlDelete)) {
                        echo '<p>Deleted successfully</p>';
                        echo "<a href='manageStudent.php?type=view' type='button'>Back</a>";
                    } else {
                        echo $conn->error . " error at delete";
                    }
                }
            } else {
                echo $conn->error . " error at selectStudents";
            }
        }
    }