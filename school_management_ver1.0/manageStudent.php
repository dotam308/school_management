<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản lí sinh viên</title>
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
	   
	   $classes = getDataFrom("belongUnit", "studentdata");
	?>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
         Quản lí sinh viên
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
                  <a class="nav-link" href="manageStudent.php?view=class">
                  <i class="material-icons">class</i>
                  Xem theo lớp
                  </a>
                </li>
             <li class="nav-item active  ">
                  <a class="nav-link" href="manageStudent.php?view=all">
                  <i class="material-icons">circle</i>
                  Xem tất cả
                  </a>
             </li>
             <?php 
                if (isset($_GET["view"])) {
                    if ($_GET["view"] == "class") {
                        for ($i = 0; $i < count($classes); $i++) {
                            echo "<li class='nav-item active'>
                                    <a class='nav-link' href='manageStudent.php?view=class&class=$classes[$i]' >
                                      <i class='material-icons'>search</i>
                                      <p>$classes[$i]</p>
                                    </a>
                                  </li>";
                        }
                            
                    } 
                }
             
             ?>
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
        	if (isset($_GET["view"])) {
        	    
        	    if ($_GET["view"] == "all") {
        	        
        	        
        	        createQueryForm("all");
        	        $type = "";
        	        if (isset($_GET["type"])) {
        	            $type = $_GET["type"];
        	        }
        	        if ($type == 'delete') {
        	            doTask($type, 'student', "", true);
        	        } else {
        	            
        	            doTask('view', "student", "");
        	            if ($type != 'view') doTask($type, "student", "");
        	        }
        	        
        	        
        	        
        	    } else if ($_GET["view"] == "class"){
        	        
        	        
        	        $class = "";
        	        if (isset($_GET["class"])) {
        	            
        	            $class = $_GET["class"];
        	            createQueryForm("class", $class);
        	            
        	            $type2 = "";
        	            if (isset($_GET["type"])) {
        	                
        	                $type2 = $_GET["type"];
        	            }
        	            
        	            if ($type2 == 'delete') {
        	                
        	                doTask('delete', "student", $class, true);
        	            } else  {
        	                
        	                doTask('view', "student", $class, true);
        	                if ($type2 != 'view' ) doTask($type2, "student", $class, true);
        	            }
        	            
        	            
        	        }
        	        
        	    }
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
  
  <?php 
    function createQueryForm($view, $class="") {
        if ($class!= "") {
            echo "
            <form class='query-form' method='get'>
                <ul >
                    <li class='item'>
                        <a class='nav-link' href='manageStudent.php?view=$view&class=$class&type=view'>
                            <i class='material-icons'>search</i>
                        Xem danh sách
                        </a>
                    </li>
                    <li class='item'>
                        <a class='nav-link' href='manageStudent.php?view=$view&class=$class&type=add'>
                        <i class='material-icons'>add</i>Thêm sinh viên
                        </a>
                    </li>
                    <li class='item'>
                    <a class='nav-link' href='manageStudent.php?view=$view&class=$class&type=edit'>
                        <i class='material-icons'>edit</i>Sửa sinh viên
                        </a>
                    </li>
                    <li class='item'>
                    <a class='nav-link' href='manageStudent.php?view=$view&class=$class&type=delete'>
                        <i class='material-icons'>delete</i>Xoá sinh viên
                        </a>
                    </li>
                    <li class='item'>
                        <a class='nav-link' href='manageStudent.php?view=$view&class=$class&type=setMainTeacher'>
                            <i class='material-icons'>settings</i>Cố vấn học tập
                        </a>
                    </li>

                </ul>
            </form>";
        } else {
            echo "
            <form class='query-form' method='get'>
                <ul >
                    <li class='item'>
                        <a class='nav-link' href='manageStudent.php?view=$view&type=view'>
                        <i class='material-icons'>search</i>Xem danh sách
                        </a>
                    </li>
                    <li class='item'>
                        <a class='nav-link' href='manageStudent.php?view=$view&type=add'>
                        <i class='material-icons'>add</i>Thêm sinh viên
                        </a>
                    </li>
                    <li class='item'>
                        <a class='nav-link' href='manageStudent.php?view=$view&type=edit'>
                        <i class='material-icons'>edit</i>Sửa sinh viên
                        </a>
                    </li>
                    <li class='item'>
                        <a class='nav-link' href='manageStudent.php?view=$view&type=delete'>
                        <i class='material-icons'>delete</i>Xoá sinh viên
                        </a>
                    </li>
                </ul>
            </form>";
        }
           
    }
  
  ?>
</body>
</html>