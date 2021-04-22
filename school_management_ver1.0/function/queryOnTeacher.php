<?php
    require_once 'connection.php';
    
    function queryOnTeacher($type)
    {
        global $conn;
        
        $myTable = "teachers";
        
        if ($type == 'view') {
            $sql = "SELECT * from $myTable";
            $result = $conn->query($sql);
            
            echo "<div class='item'>
                            <a class='nav-link' href='manageTeacher.php?type=add'>
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
                
                echo "<th>Mã giáo viên</th>
                       <th>Họ tên</th>
                       <th>Đơn vị</th>
                       <th>Số điện thoại</th>
                       <th>Action</th>
                    
                       </tr>";
                
                while ($row = $result->fetch_assoc()) {
                    
                    $query = getActionForm('manageTeacher.php', $row['id']);
                    
                    echo "<tr>";
                    echo "<td>$row[id]</td>
                    <td>$row[fullName]</td>
                    <td>$row[unit]</td>
                    <td>$row[contactNumber]</td>
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
            
            echo "<th>Mã giáo viên</th>
                       <th>Họ tên</th>
                       <th>Đơn vị</th>
                       <th>Số điện thoại</th>
                
                   </tr>";
            
            echo "<td><input type='text' name='id'/></td>
                                   <td><input type='text' name='fullName'/></td>
                                   <td><input type='text' name='unit'/></td>
                                   <td><input type='text' name='contactNumber'/></td>
                
                                   </tr>";
            
            echo "
                                    </table>
                                    <button type='submit'>Go</button>
                                    </form>";
            
            if (isset($_POST['id'])) {
                
                $sqlInsert = "INSERT INTO `$myTable` (`id`, `fullname`, `unit`, `contactNumber`)
                VALUES ($_POST[id], '$_POST[fullName]', '$_POST[unit]', '$_POST[contactNumber]')";
                
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
                    echo " <form method='post' action='#'>
                                <table style='width:100%' class='table'>
                                <tr>";
                    
                    echo "<th>Mã giáo viên</th>
                                   <th>Họ tên</th>
                                   <th>Đơn vị</th>
                                   <th>Số điện thoại</th>
                        
                               </tr>";
                    
                    echo "<td><input type='text' name='id1' value='$oldData[0]'/></td>
                    <td><input type='text' name='fullName' value='$oldData[1]'/></td>
                    <td><input type='text' name='unit' value='$oldData[2]'/></td>
                    <td><input type='text' name='contactNumber' value='$oldData[3]'/></td>
                    
                    </tr>";
                    
                    echo "
                                    </table>
                                    <button type='submit'>Go</button>
                                    </form>";
                    if (isset($_POST['id1'])) {
                        
                        $sqlUpdate = "UPDATE `$myTable` SET `id`='$_POST[id1]',`fullName`='$_POST[fullName]',`unit`='$_POST[unit]',`contactNumber`='$_POST[contactNumber]'
                        WHERE id='$oldData[0]'";
                        if ($conn->query($sqlUpdate)) {
                            echo '<p>Updated successfully</p>';
                            echo "<a href='manageTeacher.php?type=view' type='button'>Back</a>";
                        } else {
                            echo $conn->error . "error at update Teacher";
                        }
                    }
                } else if ($t == 'delete') {
                    
                    $sqlDelete = "DELETE FROM `$myTable` WHERE id=$oldData[0]";
                    
                    if ($conn->query($sqlDelete)) {
                        echo '<p>Deleted successfully</p>';
                        echo "<a href='manageTeacher.php?type=view' type='button'>Back</a>";
                    } else {
                        echo $conn->error . " error at delete";
                    }
                }
            } else {
                echo $conn->error . " error at selectTeachers";
            }
        }
    }