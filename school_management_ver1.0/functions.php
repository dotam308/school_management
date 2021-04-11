
<?php
    require_once 'configs.php';
    function doTask($type, $object, $viewByUnit="") {
        
        // Create connection
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE);
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
            $code = "MÃ£ sinh viÃªn";
            $name = "Há»� tÃªn";
            $info1 = "NgÃ y sinh";
            $info2 = "Sá»‘ Ä‘iá»‡n thoáº¡i";
            $info3 = "Lá»›p";
            $info4 = "KhÃ¡c";
        } else if ($object == "teacher") {
            $myTable = "teacherdata";
            $code = "MÃ£ giÃ¡o viÃªn";
            $name = "Há»� tÃªn";
            $info1 = "NgÃ y sinh";
            $info2 = "Sá»‘ Ä‘iá»‡n thoáº¡i";
            $info3 = "Ä�Æ¡n vá»‹";
            $info4 = "Lá»›p quáº£n lÃ­";
        } else if ($object == "course") {
            $myTable = "coursedata";
            $code = "MÃ£ mÃ´n há»�c";
            $name = "TÃªn mÃ´n há»�c";
            $info1 = "GiÃ¡o viÃªn";
            $info2 = "Sá»‘ tÃ­n chá»‰";
            $info3 = "Thá»�i gian";
            $info4 = "Ä�á»‹a Ä‘iá»ƒm";
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
                            $mainTeacher = "ChÆ°a cÃ³";
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
                            
                            echo "<h3>Cá»‘ váº¥n há»�c táº­p: $mainTeacher</h3>";
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
                    		<button type='submit'>HoÃ n táº¥t</button>
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
                        <button type='submit'>HoÃ n táº¥t</button>
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
                    	
                    	<button type='submit'>HoÃ n táº¥t</button>
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
                echo "<h3>Chá»�n cá»‘ váº¥n há»�c táº­p: </h3>";
                
                
                $sql = "SELECT * FROM teacherdata";
                
                $result = $conn->query($sql)->fetch_all();
                echo "<form action='#' method='post'>";
                for ($i = 0; $i < count($result); $i++) {
                    $idVal = $result[$i][0];
                    $nameVal = $result[$i][1];
                    echo "<input type='radio' name='gv' value='$idVal'>$nameVal<br />";
                }
                echo "<button type='submit'>XÃ¡c nháº­n</button>
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
                            	alert("Thay Ä‘á»•i cá»‘ váº¥n há»�c táº­p thÃ nh cÃ´ng");
                            </script>
                            ';
                    } else {
                        echo "updating main teacher error";
                    }
                }
                break;
            case "person":
                echo "<form action='queryOnStudentGrade.php' method='post'>
                            Nháº­p mÃ£ sinh viÃªn<input name='id' type='text'>
                              <button type='submit'>Tra cá»©u</button>
                    
                         </form>";
                break;
            case 'school':
//                 echo "<h3>Ä�Äƒng nháº­p tÃ i khoáº£n admin</h3>";
//                 echo "<form action='queryOnSchoolGrade.php' method='post'>

//                                 <table class='table'>
//                                     <tr>
//                                         <td>TÃªn Ä‘Äƒng nháº­p</td>

//                                         <td> <input type='text' name='username'/></td>
//                                     </tr>

//                                     <tr>
                                        
//                                         <td>Máº­t kháº©u</td>
//                                         <td><input type='password' name='password'/></td>
//                                     </tr>
//                                 </table>
//                               <button type='submit'>Ä�Äƒng nháº­p</button>
                    
//                          </form>";
                echo "<button type='submit'><a href='queryOnSchoolGrade.php'>Truy cáº­p</a></button>";
                break;
                
            default:
                break;
        }
        
    }
    function getDataFrom($field, $table, $condition = "1") {
        
        $output = array();
        
        // Create connection
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE);
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
        // Create connection
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE);
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
                            <th>TÃªn lá»›p</th>
                            <th>Sá»‘ sinh viÃªn tá»‘i Ä‘a</th>
                            <th>SÄ© sá»‘ hiá»‡n táº¡i</th>
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
                    				<th>TÃªn lá»›p</th>
                                    <th>Sá»‘ sinh viÃªn tá»‘i Ä‘a</th>
                    			</tr>
                    			<tr>
                    				<td><input type="text" name="name"/></td>
                    				<td><input type="text" name="maxQuatity"/></td>
                    			</tr>
                    
                    
                    
                    		</table>
                    		<button type="submit">HoÃ n táº¥t</button>
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
                    				<th>TÃªn lá»›p cÅ©</th>
                    				<th>TÃªn lá»›p má»›i</th>
                    			</tr>
                    			<tr>
                    				<td><input type="text" name="oldName"/></td>
                    				<td><input type="text" name="newName"/></td>
                    			</tr>
                    
                    
                    
                    		</table>
                    		<button type="submit">HoÃ n táº¥t</button>
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
                    	<span>TÃªn lá»›p</span>
                    	<input type="text" name="name"/>
                    	</p>
                    
                    	<button type="submit">HoÃ n táº¥t</button>
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
        
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE);
        
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
                    echo "Báº¡n chÆ°a Ä‘Äƒng kÃ½ mÃ´n há»�c";
                } else {
                    echo "<table class='table'>
                            <tr>
                                <th>MÃ£ sinh viÃªn</th>
                                <th>Há»� tÃªn</th>
                                <th>Lá»›p</th>
                                <th>MÃ£ mÃ´n há»�c</th>
                                <th>TÃªn mÃ´n há»�c</th>
                                <th>Sá»‘ tÃ­n chá»‰</th>
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
                echo "<div><h3 class='title'>Ä�Äƒng kÃ­ mÃ´n há»�c</h3>";
                $sqlSelectCourses = "SELECT * FROM `coursedata` WHERE 1";
                $result = $conn->query($sqlSelectCourses);
                
                if ($result->num_rows <= 0) {
                    echo "ChÆ°a cÃ³ mÃ´n há»�c Ä‘Äƒng kÃ­";
                } else {
                    echo "
                            
                            <form action='#' method='post'>
                                <table class='table'>
                                    <tr>
                                        <th>Chá»�n</th>
                                        <th>MÃ£ mÃ´n há»�c</th>
                                        <th>TÃªn mÃ´n há»�c</th>
                                        <th>GiÃ¡o viÃªn</th>
                                        <th>Sá»‘ tÃ­n chá»‰</th>
                                        <th>Thá»�i gian</th>
                                        <th>Ä�á»‹a Ä‘iá»ƒm</th>
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
                        <button type='submit'>XÃ¡c nháº­n</button>
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
                                                echo "Báº¡n Ä‘Ã£ Ä‘Äƒng kÃ½ mÃ´n há»�c $key <br/>";
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
                echo "<h3>XoÃ¡ mÃ´n há»�c</h3>";
                $sqlSelectRegisteredCourses = "SELECT * FROM `registdata` WHERE id='$id'";
                $result = $conn->query($sqlSelectRegisteredCourses);
                
                echo "<form action='#' method='post'>
                        <table class='table'>
                        <tr>
                            <th>Chá»�n</th>
                            <th>MÃ£ sinh viÃªn</th>
                            <th>Sinh viÃªn</th>
                            <th>Lá»›p</th>
                            <th>MÃ£ mÃ´n há»�c</th>
                            <th>TÃªn mÃ´n há»�c</th>
                            <th>Sá»‘ tÃ­n chá»‰</th>
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
                        <button type='submit'>XÃ¡c nháº­n</button>
                    </form>";
                if (isset($_POST)) {
                    $success = false;
                    foreach ($_POST as $key=>$value) {
                        
                        $sqlDeleteRegisteredCourses = "DELETE FROM `registdata` WHERE `courseCode` = '$key'";
                        if ($conn->query($sqlDeleteRegisteredCourses)) {
                            $success = true;
                            
                            echo "XoÃ¡ thÃ nh cÃ´ng mÃ´n $key <br />";
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

    
    function updateStudentOnGrade() {
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE);
        if ($conn->connect_error) {
            die ("$conn->error");
        }
        $sql = 'SELECT * FROM `registdata` WHERE 1';
        $sqlGrade = 'SELECT * FROM `gradedata` WHERE 1';
        $data = $conn->query($sqlGrade)->fetch_all();
        
        if ($res = $conn->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                $id = $row['id'];
                $fullName = $row['fullName'];
                $class = $row['belongUnit'];
                $courseName = $row['courseName'];
                
                
                $exist = false;
                for ($i = 0; $i < count($data); $i++) {
                    if ($id == $data[$i][0] && $courseName == $data[$i][3]) {
                        $exist = true;
                        break;
                    }
                }
                
                if (!$exist) {
                    $sqlUpdate = "INSERT INTO `gradedata`(`id`, `fullName`, `belongUnit`, `courseName`, `grade`) VALUES ($id,'$fullName', '$class','$courseName','0')";
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