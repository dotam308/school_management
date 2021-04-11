<!DOCTYPE html>
<html lang="en">

<head>
  <title>Đăng ký học</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/material-dashboard.css" rel="stylesheet" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
         Đăng ký học
        </a>
      </div>
      <div class="sidebar-wrapper">
      	<form class="main-form" method="get">
      		<ul class="nav">
              <li class="nav-item active  ">
                <a class="nav-link" href="index.php">
                  <i class="material-icons">dashboard</i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item active  ">
                <a class="nav-link" href="registerQuery.php?type=view">
                  <i class="material-icons">search</i>
                  <p>Xem danh sách</p>
                </a>
              </li>
              <li class="nav-item active  ">
                <a class="nav-link" href="registerQuery.php?type=add">
                  <i class="material-icons">add</i>
                  <p>Thêm môn học</p>
                </a>
              </li>
              <li class="nav-item active  ">
                <a class="nav-link" href="registerQuery.php?type=delete">
                  <i class="material-icons">delete</i>
                  <p>Xoá môn học</p>
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
        	   $type = "";
        	   if (isset($_GET["type"])) {
        	       $type = $_GET["type"];
        	   }
        	   require_once 'functions.php';
        	   
        	   $sqlGetStudents = "SELECT * FROM `studentdata` WHERE 1";
        	   $res = $conn->query($sqlGetStudents)->fetch_all();
        	   
        	   
        	   
        	   $id = 0;
        	   $name = "";
        	   $class = "";
        	   if (isset($_POST['id'])) {
        	       $id = $_POST['id'];
        	       $name = $_POST['name'];
        	       $class = $_POST['class'];
        	       $success = false;
        	       for ($i = 0; $i < count($res); $i++) {
        	           if ($res[$i][0] == $id && $res[$i][1] == $name && $res[$i][4] == $class) {
        	               $success = true;
        	               break;
        	           }
        	       }
        	       
        	       if(!$success) {
        	           echo "<script>alert('Đăng nhập thất bại')</script>";
        	           echo '<button><a href="registerCourses.php">Đăng nhập lại</a></button>';
        	       }
        	       else {
        	           echo "<script>alert('Đăng nhập thành công')</script>";
        	          
        	           
        	       }
        	   }
        	   
        	   $sqlCreateTempTable = "CREATE TABLE IF NOT EXISTS `mydb`.`temp_table` ( `id` INT NOT NULL , `name` VARCHAR(30) NOT NULL , `class` VARCHAR(15) NOT NULL ) ENGINE = InnoDB;";
        	   if($conn->query($sqlCreateTempTable)){
        	       
        	   } else {
        	       echo $conn->error;
        	   }
        	   if ($type == '') {
        	       
        	       $sqlDeleteAll = "DELETE FROM `temp_table` WHERE 1";
        	       $conn->query($sqlDeleteAll);
        	       $sqlInsertData = "INSERT INTO `temp_table`(`id`, `name`, `class`) VALUES ('$_POST[id]','$_POST[name]','$_POST[class]')";
        	       if ($conn->query($sqlInsertData)) {
        	           
        	       } else {
        	           echo "error At insertdata" . $conn->error;
        	       }
        	   }
        	   
        	   $sqlGetData = "SELECT `id`, `name`, `class` FROM `temp_table` WHERE 1";
        	   if ($res = $conn->query($sqlGetData)) {
        	       $data =$res->fetch_all();
        	       $info = $data[0];
        	       
        	       registerQuery($type, $info[0], $info[1], $info[2]);
        	   } else {
        	       echo "error At getdata" . $conn->error;
        	   }
        	  
        	?>
        	
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
</body>

</html>