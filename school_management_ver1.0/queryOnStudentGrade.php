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
               	 <a class="nav-link" href="manageGrades.php?type=login">
              		<i class="material-icons">logout</i>
              		Đăng xuất
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
        	require_once 'function/functions.php';
        	require_once 'connection.php';
//         	doTask('person', '');
        	
        	updateStudentOnGrade();
        	
        	global $conn;
            
        	if ($conn->connect_error) {
        	    echo $conn->error;
        	}
        	
        	$show = false;
        	
        	if (isset($_POST['id'])) {
        	    $show = true;
        	    if ($show) {
        	        showScores($_POST['id']);
        	        $show = false;
        	    }
        	    
        	} else {
        	    
        	    if (count($_POST) != 0) {
        	        $updateData = $_POST;
        	        
        	        $success = false;
        	        foreach($updateData as $key=>$value) {
        	            
        	            $info = getDetailData($key);
        	            
        	            $courseIdPart = $info[0];
        	            $studentId = $info[1];
        	            $sqlUpdate = "UPDATE `scores` SET `score`= $value WHERE `courseId`='$courseIdPart' AND `studentId` = '$studentId'";
        	            
        	            if ($conn->query($sqlUpdate)) {
        	                $success = true;
        	            } else {
//         	                echo "error at Update";
        	            }
        	        }
        	        
        	        if ($success) {
        	            showScores($studentId);
        	            echo 'Updated successfully';
        	            
        	        }
        	        
        	    }
        	    
        	    
        	    
        	    
        	}
        	
        	function showScores($studentId) {
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
        	            
        	            
        	            $scoreData =  $conn->query($sqlSelectScoreThroughId)->fetch_all();
        	            
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
        	        
        	        
        	        $avg = $sum / $toTalCredit;
        	        $res = round($avg, 1);
        	        echo "Điểm trung bình: $res <br />";
        	        echo "</table>

                     <button type='submit'>Ghi nhận</button>
                     </form>";
        	        
        	    } else {
        	        echo "error at GetData";
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