<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
    <title>Quản lí nhà trường</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/material-dashboard.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>

  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
         Quản lí nhà trường
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
              	<li class="nav-item active">
               		 <a class="nav-link " href="manageStudent.php">
                	  <i class="material-icons">person</i>
                  	<p>Quản lí sinh viên</p>
                </a>
       		 </li>
           		 <li class="nav-item active">
                <a class="nav-link" href="manageTeacher.php">
                  <i class="material-icons fas fa-chalkboard-teacher"></i>
                    <p>Quản lí giáo viên</p>
                </a>
           		 </li>
           		 <li class="nav-item active  ">
                    <a class="nav-link" href="manageCourse.php">
                      <i class="material-icons">book</i>
                      <p>Quản lí khoá học</p>
                    </a>
           		 </li>
           		 <li class="nav-item active  ">
                    <a class="nav-link" href="manageClass.php">
                      <i class="material-icons fas fa-chalkboard"></i>
                      <p>Quản lí lớp học</p>
                    </a>
           		 </li>
           		 
           		 <li class="nav-item active  ">
                    <a class="nav-link" href="registerCourses.php?type=login">
                      <i class="material-icons">note</i>
                      <p>Đăng kí học</p>
                    </a>
           		 </li>
           		 <li class="nav-item active  ">
                    <a class="nav-link" href="manageGrades.php">
                      <i class="material-icons">grade</i>
                      <p>Quản lí điểm</p>
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
