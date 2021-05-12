<?php $active_menu = isset($active_menu) ? $active_menu : 'index'; ?>
<?php $sub_active = isset($sub_active) ? $sub_active : null; ?>
<div class="sidebar" data-color="purple" data-background-color="white">
    <div class="logo">
        <a href="process.php" class="simple-text logo-normal">
            Quản lí nhà trường
        </a>
    </div>
    <div class="sidebar-wrapper">
        <form class="main-form" method="get">
            <ul class="nav">
                <li class="nav-item <?= $active_menu == 'index' ? 'active' : '' ?>">
                    <a class="nav-link" href="process.php">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
              
                <li class="nav-item <?= $active_menu == 'student' ? 'active' : '' ?>">
            		<a class="nav-link" href="manageStudent.php?type=view&page=1">
                        <i class="material-icons">person</i>
                        <p>Quản lí sinh viên</p>
                    </a>
                    <ul class="subs-menu">
                      <li class="sub-item <?= ($active_menu == 'student' && $sub_active == 'view') ? 'active' : '' ?>">
                      	<a href="manageStudent.php?type=view">Danh sách sinh viên</a>
                      </li>
                      <li class="sub-item <?= ($active_menu == 'student' && $sub_active == 'register') ? 'active' : '' ?>">
                      	<a href="manageRegister.php?type=view">Danh sách đăng ký</a>
                      </li>
                        <li class="sub-item <?= ($active_menu == 'student' && $sub_active == 'score') ? 'active' : '' ?>">
                            <a href="queryOnSchoolGrade.php">Danh sách điểm</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?= $active_menu == 'teacher' ? 'active' : '' ?>">
                    <a class="nav-link" href="manageTeacher.php?type=view">
                        <i class="material-icons fas fa-chalkboard-teacher"></i>
                        <p>Quản lí giáo viên</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu == 'course' ? 'active' : '' ?>">
                    <a class="nav-link" href="manageCourse.php?type=view">
                        <i class="material-icons">book</i>
                        <p>Quản lí khoá học</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu == 'class' ? 'active' : '' ?>">
                    <a class="nav-link" href="manageClass.php?type=view">
                        <i class="material-icons fas fa-chalkboard"></i>
                        <p>Quản lí lớp học</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu == 'register' ? 'active' : '' ?>">
                    <a class="nav-link" href="registerCourses.php?type=login">
                        <i class="material-icons">note</i>
                        <p>Đăng kí học</p>
                    </a>
                </li>
            </ul>
        </form>
    </div>
</div>
