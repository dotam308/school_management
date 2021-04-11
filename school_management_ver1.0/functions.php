
<?php
    function doTask($type, $object, $viewByUnit="") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $myTable = "";
        
        $code = "";
        $name = "";
        $info1 = "";
        $info2 = "";
        $info3 = "";
        $info4 = "";
        
        
        if ($object == "student") {
            $myTable = "studentdata";
            $code = "Mã sinh viên";
            $name = "Họ tên";
            $info1 = "Ngày sinh";
            $info2 = "Số điện thoại";
            $info3 = "Lớp";
            $info4 = "Khác";
        } else if ($object == "teacher") {
            $myTable = "teacherdata";
            $code = "Mã giáo viên";
            $name = "Họ tên";
            $info1 = "Ngày sinh";
            $info2 = "Số điện thoại";
            $info3 = "Đơn vị";
            $info4 = "Lớp quản lí";
        } else if ($object == "course") {
            $myTable = "coursedata";
            $code = "Mã môn học";
            $name = "Tên môn học";
            $info1 = "Giáo viên";
            $info2 = "Số tín chỉ";
            $info3 = "Thời gian";
            $info4 = "Địa điểm";
        }

        switch ($type) {
            case "view":
                if ($object == "student" || $object == "teacher") {
                    if ($viewByUnit != "") {
                        $sql = "SELECT * FROM $myTable WHERE belongUnit = '$viewByUnit'";
                    }
                        
                    else {
                        $sql = "SELECT * FROM $myTable";
                    }
                    
                } else  if ($object == "course") $sql = "SELECT * FROM $myTable";
                
                $result = $conn->query($sql);
                
                if ($result->num_rows <= 0) {
                    echo "0 results";
                } else {
                    
                    // output data of each row
                    echo "<table style='width:100%' class='table'>
                          <tr>
                            <th>$code</th>
                            <th>$name</th>
                            <th>$info1</th>
                            <th>$info2</th>
                            <th>$info3</th>
                            <th>$info4</th>
                    
                          </tr>";
                    if ($object == "student") {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>$row[id]</td>
                            <td>$row[fullname]</td>
                            <td>$row[dateOfBirth]</td>
                            <td>$row[contactNumber]</td>
                            <td>$row[belongUnit]</td>
                            <td>$row[other]</td>
                            </tr>";
                        }
                        if ($viewByUnit != "") {
                            $mainTeacher = "Chưa có";
                            $sqlGetMainTeacher = "SELECT * FROM `teacherdata` WHERE 1";
                            if ($res = $conn->query($sqlGetMainTeacher)) {
                                $teacherList = $res->fetch_all();
                                for ($i = 0; $i < count($teacherList); $i++) {
                                    if ($teacherList[$i][5] == $viewByUnit) {
                                        $mainTeacher = $teacherList[$i][1];
                                        break;
                                    }
                                }
                            } else {
                                echo "error: at sqlGetMainTeacher";
                            }
                            
                            echo "<h3>Cố vấn học tập: $mainTeacher</h3>";
                        }
                    } else if ($object == "teacher") {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>$row[id]</td>
                            <td>$row[fullname]</td>
                            <td>$row[dateOfBirth]</td>
                            <td>$row[contactNumber]</td>
                            <td>$row[belongUnit]</td>
                            <td>$row[manageUnit]</td>
                            </tr>";
                        }
                    }else if ($object == "course") {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>$row[courseCode]</td>
                            <td>$row[name]</td>
                            <td>$row[teacher]</td>
                            <td>$row[creditQuatity]</td>
                            <td>$row[period]</td>
                            <td>$row[place]</td>
                            </tr>";
                        }
                    }
                        
                    
                    echo "</table>";
                }
                
                $conn->close();
                break;
            case "add":
                echo "<div class='content'>
                    	<form action='#' method='post'>
                    		<table class='table'>
                    			<tr>
                                    <th>$code</th>
                                    <th>$name</th>
                                    <th>$info1</th>
                                    <th>$info2</th>
                                    <th>$info3</th>
                                    <th>$info4</th>
                    			</tr>
                    			<tr>
                    				<td><input type='text' name='code'/></td>
                    				<td><input type='text' name='name'/></td>
                    				<td><input type='text' name='info1' /></td>
                    				<td><input type='text' name='info2'  /></td>
                    				<td><input type='text' name='info3'  /></td>
                    				<td><input type='text' name='info4'  /></td>
                    			</tr>
                    			
                    
                    		
                    		</table>
                    		<button type='submit'>Hoàn tất</button>
                    	</form>";
                $entity = array();
                if (!empty($_POST)) {
                    $entity = $_POST;
                }
                if (count($entity) != 0) {
                    if ($object == "student" || $object == "teacher") {
                        $sql = "INSERT INTO $myTable (`id`, `fullName`, `dateOfBirth`, `contactNumber`, `belongUnit`,`other`)
                        VALUES ('$entity[code]', '$entity[name]', '$entity[info1]', '$entity[info2]', '$entity[info3]', '$entity[info4]')";
                        
                    } else if ($object == "course") {
                        $sql = "INSERT INTO $myTable (`courseCode`, `name`, `teacher`, `creditQuatity`, `period`,`place`)
                        VALUES ('$entity[code]', '$entity[name]', '$entity[info1]', '$entity[info2]', '$entity[info3]', '$entity[info4]')";
                        
                    }
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    
                }
                
                $conn->close();
                echo '</div>';
                break;
            case "edit":
                echo "<div class='content'>
                        <form action='#' method='post'>
                        <table class='table'>
                            <tr>
                                <th>$code</th>
                                <th>$name</th>
                                <th>$info1</th>
                                <th>$info2</th>
                                <th>$info3</th>
                                <th>$info4</th>
                            </tr>
                			<tr>
                				<td><input type='text' name='code'/></td>
                				<td><input type='text' name='name'/></td>
                				<td><input type='text' name='info1' /></td>
                				<td><input type='text' name='info2'  /></td>
                				<td><input type='text' name='info3'  /></td>
                				<td><input type='text' name='info4'  /></td>
                			</tr>
                        
                        
                        
                        </table>
                        <button type='submit'>Hoàn tất</button>
                        </form>";
                $entity = array();
                if (! empty($_POST)) {
                    $entity = $_POST;
                }
                if (count($entity) != 0) {
                    if ($object == "student" || $object == "teacher") {
                        $sql = "UPDATE $myTable SET fullname='$entity[name]', dateOfBirth='$entity[info1]', contactNumber='$entity[info2]', belongUnit='$entity[info3]', other='$entity[info4]' WHERE id='$entity[code]'";
                        
                    } else if ($object == "course") {
                        $sql = "UPDATE $myTable SET name='$entity[name]', teacher='$entity[info1]', creditQuatity='$entity[info2]', period='$entity[info3]', place='$entity[info4]' WHERE courseCode='$entity[code]'";
                        
                    }
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
                $conn->close();
                echo '</div>';
                break;
            case "delete":
                echo "<div class='content'>
                    <form action='#' method='post'>
                    	
                    	<p>
                    	<span>$code</span>
                    	<input type='text' name='code'/>
                    	</p>
                    	
                    	<button type='submit'>Hoàn tất</button>
                    </form>";
                $code = "";
                if(isset($_POST["code"])) $code = $_POST["code"];
                if ($code != "") {
                    // sql to delete a record
                    if($object == "student" || $object == "teacher") $sql = "DELETE FROM $myTable WHERE id=$code";
                    else if ($object == "course")  $sql = "DELETE FROM $myTable WHERE courseCode=$code";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "Record deleted successfully";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }
                
                
                
                $conn->close();
                echo '</div>';
                break;
                
            case "setMainTeacher":
                $classCurrent = ($_GET["class"]);
                echo "<h3>Chọn cố vấn học tập: </h3>";
                
                
                $sql = "SELECT * FROM teacherdata";
                
                $result = $conn->query($sql)->fetch_all();
                echo "<form action='#' method='post'>";
                for ($i = 0; $i < count($result); $i++) {
                    $idVal = $result[$i][0];
                    $nameVal = $result[$i][1];
                    echo "<input type='radio' name='gv' value='$idVal'>$nameVal<br />";
                }
                echo "<button type='submit'>Xác nhận</button>
                 </form>";
                
                if (isset($_POST['gv'])) {
                    $idTeacher = $_POST['gv'];
                    $sqlUpdateGV = "UPDATE teacherdata SET manageUnit = '$classCurrent' WHERE id = '$idTeacher'";
                    
                    
                    for ($i = 0; $i < count($result); $i++) {
                        if ($result[$i][0] != $idTeacher && $result[$i][5] == $classCurrent) {
                            $id = $result[$i][0];
                            $sqlResetMU = "UPDATE teacherdata SET manageUnit = '' WHERE id = '$id'";
                            if ($conn->query($sqlResetMU)) {
                            } else {
                                echo "updating resetMU main teacher error";
                            }
                        }
                    }
                    
                    if ($conn->query($sqlUpdateGV)) {
                        echo '
                            <script type="text/javascript">
                            	alert("Thay đổi cố vấn học tập thành công");
                            </script>
                            ';
                    } else {
                        echo "updating main teacher error";
                    }
                }
                break;
            case "person":
                echo "<form action='queryOnStudentGrade.php' method='post'>
                            Nhập mã sinh viên<input name='id' type='text'>
                              <button type='submit'>Tra cứu</button>
                    
                         </form>";
                break;
            case 'school':
//                 echo "<h3>Đăng nhập tài khoản admin</h3>";
//                 echo "<form action='queryOnSchoolGrade.php' method='post'>

//                                 <table class='table'>
//                                     <tr>
//                                         <td>Tên đăng nhập</td>

//                                         <td> <input type='text' name='username'/></td>
//                                     </tr>

//                                     <tr>
                                        
//                                         <td>Mật khẩu</td>
//                                         <td><input type='password' name='password'/></td>
//                                     </tr>
//                                 </table>
//                               <button type='submit'>Đăng nhập</button>
                    
//                          </form>";
                echo "<button type='submit'><a href='queryOnSchoolGrade.php'>Truy cập</a></button>";
                break;
                
            default:
                break;
        }
        
    }
    function getDataFrom($field, $table, $condition = "1") {
        
        $output = array();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT DISTINCT $field FROM $table WHERE $condition";
        $result = $conn->query($sql);
        
        
        if ($result->num_rows <= 0) {
            return "0 results";
        } else {
                while($row = $result->fetch_assoc()) {
                    $output[] = $row[$field];
                }
            
        }
        
        $conn->close();
        
        return $output;
        
    }
    
    function queryOnClass($type) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "myDB";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM classdata";
        $sqlCount = "SELECT belongUnit, COUNT(id) amount FROM `studentdata` GROUP BY belongUnit";
        
        $result = $conn->query($sql)->fetch_all();
        $counts = $conn->query($sqlCount)->fetch_all();
        
        
        $current = array();
        for ($i = 0; $i < count($result); $i++) {
            for ($j = 0; $j < count($counts); $j++) {
                if ($result[$i][0] == $counts[$j][0]) {
                    $amount = $counts[$j][1];
                    $className = $result[$i][0];
                    $sqlUpdate = "UPDATE `classdata` SET `currentQuatity`=$amount WHERE name='$className'";
                    if ($conn->query($sqlUpdate) === TRUE) {
//                         echo "Record updated successfully";
                    } else {
                        echo "Error updating max-quantity: " . $conn->error;
                    }
                }
            }
        }
        
            
        
        switch ($type) {
            case "view":
                $sql = "SELECT * FROM classdata";
                $result = $conn->query($sql);
                
                if ($result->num_rows <= 0) {
                    echo "0 results";
                } else {
                    
                    // output data of each row
                    echo "<table style='width:100%' class='table'>
                          <tr>
                            <th>Tên lớp</th>
                            <th>Số sinh viên tối đa</th>
                            <th>Sĩ số hiện tại</th>
                          </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>
                        <a href='manageStudent.php?view=class&class=$row[name]'>$row[name]</a>
                        </td>
                        <td>$row[maxQuatity]</td>
                        <td>$row[currentQuatity]</td>
                        </tr>";
                        
                    }
                    
                    echo "</table>";
                }
                
                $conn->close();
                break;
            case "add":
                echo '<div class="content">
                    	<form action="#" method="post">
                    		<table class="table">
                    			<tr>
                    				<th>Tên lớp</th>
                                    <th>Số sinh viên tối đa</th>
                    			</tr>
                    			<tr>
                    				<td><input type="text" name="name"/></td>
                    				<td><input type="text" name="maxQuatity"/></td>
                    			</tr>
                    
                    
                    
                    		</table>
                    		<button type="submit">Hoàn tất</button>
                    	</form>';
                $class = array();
                if (!empty($_POST)) {
                    $class = $_POST;
                }
                if (count($class) != 0) {
                    
                    $sql = "INSERT INTO `classdata` (`name`, `maxQuatity`)
                    VALUES ('$class[name]', '$class[maxQuatity]')";
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    
                }
                
                $conn->close();
                echo '</div>';
                break;
            case "edit":
                echo '<div class="content">
                    	<form action="#" method="post">
                    		<table class="table">
                    			<tr>
                    				<th>Tên lớp cũ</th>
                    				<th>Tên lớp mới</th>
                    			</tr>
                    			<tr>
                    				<td><input type="text" name="oldName"/></td>
                    				<td><input type="text" name="newName"/></td>
                    			</tr>
                    
                    
                    
                    		</table>
                    		<button type="submit">Hoàn tất</button>
                    	</form>';
                $class = array();
                if (! empty($_POST)) {
                    $class = $_POST;
                }
                if (count($class) != 0) {
                    
                    $sql = "UPDATE `classdata` SET name='$class[newName]' WHERE name='$class[oldName]'";
                    if ($conn->query($sql) === TRUE) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
                $conn->close();
                echo '</div>';
                break;
            case "delete":
                echo '<div class="content">
                    <form action="#" method="post">
                    
                    	<p>
                    	<span>Tên lớp</span>
                    	<input type="text" name="name"/>
                    	</p>
                    
                    	<button type="submit">Hoàn tất</button>
                    </form>';
                $name = "";
                if(isset($_POST["name"])) $name = $_POST["name"];
                if ($name != "") {
                    // sql to delete a record
                    $sql = "DELETE FROM `classdata` WHERE name='$name'";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "Record deleted successfully";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }
                
                
                
                $conn->close();
                echo '</div>';
                break;
            default:
                break;
        }
    }

    function registerQuery($type, $id, $name, $class) {
        $servername = "localhost";
        $username ="root";
        $password = "";
        $db = "mydb";
        
        $conn = new mysqli($servername, $username, $password, $db);
        
        if ($conn->connect_error) {
            die("Connection fails: " . $conn->error);
        }
        
        switch ($type) {
            case "view":
                $sql = "SELECT * FROM `registdata` WHERE id = '$id'";
                if ($result = $conn->query($sql)) {
                    
                } else {
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
                                <th>Mã môn học</th>
                                <th>Tên môn học</th>
                                <th>Số tín chỉ</th>
                            </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>$id</td>
                                <td>$name</td>
                                <td>$class</td>
                                <td>$row[courseCode]</td>
                                <td>$row[courseName]</td>
                                <td>$row[creditQuatity]</td>

                            </tr>";
                    }
                   
                   echo  "</table>";    
                }
                
                break;
            case "add" :
                echo "<div><h3 class='title'>Đăng kí môn học</h3>";
                $sqlSelectCourses = "SELECT * FROM `coursedata` WHERE 1";
                $result = $conn->query($sqlSelectCourses);
                
                if ($result->num_rows <= 0) {
                    echo "Chưa có môn học đăng kí";
                } else {
                    echo "
                            
                            <form action='#' method='post'>
                                <table class='table'>
                                    <tr>
                                        <th>Chọn</th>
                                        <th>Mã môn học</th>
                                        <th>Tên môn học</th>
                                        <th>Giáo viên</th>
                                        <th>Số tín chỉ</th>
                                        <th>Thời gian</th>
                                        <th>Địa điểm</th>
                                    </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><input type='checkbox' name='$row[courseCode]'/></td>
                                <td>$row[courseCode]</td>
                                <td>$row[name]</td>
                                <td>$row[teacher]</td>
                                <td>$row[creditQuatity]</td>
                                <td>$row[period]</td>
                                <td>$row[place]</td>
                        
                            </tr>";
                    }
                    echo "
                        </table>
                        <button type='submit'>Xác nhận</button>
                        </form>";
                    
                    $result = $conn->query($sqlSelectCourses);
                    if (isset($_POST)) {
                        foreach ($_POST as $key=>$value) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row['courseCode'] == $key) {
                                    //check xem da dang ki mon hoc do chua
                                    $registeredCourses = array();
                                    $registeredCourses = getDataFrom('courseCode', 'registdata', "id = $id");
                                    $exist = false;
                                    
                                    if (gettype($registeredCourses) == "array") {
                                        for ($index = 0; $index < count($registeredCourses); $index++) {
                                            if ($key == $registeredCourses[$index]) {
                                                echo "Bạn đã đăng ký môn học $key <br/>";
                                                $exist = true;
                                            }
                                        }
                                    }
                                        
                                    
                                    
                                    if (!$exist) {
                                        $sqlUpdateRegisCourse = "INSERT INTO `registdata`(`id`, `fullName`, `belongUnit`, `courseCode`, `courseName`, `creditQuatity`) VALUES ($id,'$name','$class','$key','$row[name]','$row[creditQuatity]')";
                                        
                                        if ($conn->query($sqlUpdateRegisCourse)) {
                                            
                                        } else {
                                            echo 'error AT UpdateRegisCourse'. $conn->error;
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
                echo "<h3>Xoá môn học</h3>";
                $sqlSelectRegisteredCourses = "SELECT * FROM `registdata` WHERE id='$id'";
                $result = $conn->query($sqlSelectRegisteredCourses);
                
                echo "<form action='#' method='post'>
                        <table class='table'>
                        <tr>
                            <th>Chọn</th>
                            <th>Mã sinh viên</th>
                            <th>Sinh viên</th>
                            <th>Lớp</th>
                            <th>Mã môn học</th>
                            <th>Tên môn học</th>
                            <th>Số tín chỉ</th>
                        </tr>";
                if ($result->num_rows <= 0) {
                    
                } else {
                    
                }
                while($row=$result->fetch_assoc()) {
                        echo "<tr>
                                <td><input type='checkbox' name='$row[courseCode]'/></td>
                                <td>$row[id]</td>
                                <td>$row[fullName]</td>
                                <td>$row[belongUnit]</td>
                                <td>$row[courseCode]</td>
                                <td>$row[courseName]</td>
                                <td>$row[creditQuatity]</td>
                                
                                </tr>";
                    
                    
                    
                }
                
                echo "
                    </table>
                        <button type='submit'>Xác nhận</button>
                    </form>";
                if (isset($_POST)) {
                    $success = false;
                    foreach ($_POST as $key=>$value) {
                        
                        $sqlDeleteRegisteredCourses = "DELETE FROM `registdata` WHERE `courseCode` = '$key'";
                        if ($conn->query($sqlDeleteRegisteredCourses)) {
                            $success = true;
                            
                            echo "Xoá thành công môn $key <br />";
                        } else {
                            echo "error at DeleteRegisteredCourses:" . $conn->error;
                        }
                    }
                    
                }
                break;
            default:
                break;
        }
        
        
    }
    
   
?>