<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lí điểm</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/material-dashboard.css" />
  <link href="assets/css/styleQueryForm.css" rel="stylesheet" type="text/css"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<?php 
	
	   require_once 'functions.php';
	   
	?>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
         Quản lí điểm
        </a>
      </div>
      <div class="sidebar-wrapper">
      	<form class="main-form" method="get">
      		<ul class="nav">
              	<li class="nav-item active  ">
                <a class="nav-link" href="index.php">
              	<i class="material-icons">dashboard</i>
              	Dashboard
                </a>
              </li>
              <li class="nav-item active  ">
                  <a class="nav-link" href="manageGrades.php?view=person">
                  <i class="material-icons">person</i>
                  Xem điểm cá nhân
                  </a>
                </li>
             <li class="nav-item active  ">
                  <a class="nav-link" href="manageGrades.php?view=all">
                  <i class="material-icons">circle</i>
                  Xem điểm toàn trường
                  </a>
             </li>
          	</ul>
      	
      	</form>
            
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:;">
                  <i class="material-icons">notifications</i> Notifications
                </a>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
        	<?php 
        	
        	require_once 'configs.php';
        	
        	updateStudentOnGrade();
        	$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE);
            mysqli_set_charset($conn,'utf8');
            mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8mb4_unicode_ci';");
        	if ($conn->connect_error) {
        	    echo $conn->error;
        	}
        	echo "<form  method='post' action='#'>
                                <table class='table' style='width:  100%;'>
                                    <tr>
                                        <th>Mã sinh viên</th>
                                        <th>Họ tên</th>
                                        <th>Lớp</th>
                                        <th>Tên môn học</th>
                                        <th>Mã môn</th>
                                        <th>Số điểm</th>
                                    </tr>";
        	
        	
        	    $sqlGetData = "SELECT * FROM `gradedata` WHERE 1";
        	    
        	    if ($res = $conn->query($sqlGetData)) {
        	        $data = $res->fetch_all();
        	        
        	        for ($i = 0; $i < count($data); $i++) {
        	            $id = $data[$i][0];
        	            $name = $data[$i][1];
        	            $class = $data[$i][2];
        	            $courseName = $data[$i][3];
        	            $grade = $data[$i][4];
        	            if (!checkCourseInRegis($courseName, $id)) {
        	                continue;
        	            }
        	            
        	            $position = $courseName."_".$id;
        	            echo "
        	            <tr>
        	            <td>$id</td>
        	            <td>$name</td>
        	            <td>$class</td>
        	            <td>$courseName</td>
        	            <td>$grade</td>
        	            <td><input type='text' name='$position' style='width: 50px;'></td>
        	            </tr>
        	            ";
        	        }
        	        
        	        echo "</table>
                     <button type='submit'>Ghi nhận</button>
                     </form>";
        	        
        	    } else {
        	        echo "error at GetData";
        	    }
        	    
        	    if (count($_POST) != "") {
        	        $updateData = $_POST;
        	        foreach($updateData as $key=>$value) {
        	            $courseID = getDetailData($key);
        	            $sqlUpdate = "UPDATE `gradedata` SET `grade`=$value WHERE `courseName`='$courseID[0]' AND `id` = '$courseID[1]'";
        	            if ($conn->query($sqlUpdate)) {
        	                echo "<p>Update thÃ nh cÃ´ng, vui lÃ²ng táº£i láº¡i trang</p>";
        	                echo "<button onClick='window.location.reload();'>Refresh Page</button>"; 
        	            } else {
        	               // echo "erroe at Update";
        	            }
        	        }
        	        
        	    }
        	    
        	
        	function getDetailData($data) {
        	    
        	    $info = explode("_", $data);
        	    $id = $info[sizeof($info) - 1];
        	    array_pop($info);
        	    $courseName = implode(" ", $info);
        	    
        	    
        	    $res = array();
        	    $res[] = $courseName;
        	    $res[] = $id;
        	    return $res;
        	}
        	
        	?>
        	
        </div>
      </div>
    </div>
  </div>
</body>
</html>
