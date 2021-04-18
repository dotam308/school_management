<?php $active_menu = isset($active_menu) ? $active_menu : 'index'; ?>
<div class="sidebar" data-color="purple" data-background-color="white">
    <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
            Quản lí nhà trường
        </a>
    </div>
    <div class="sidebar-wrapper">
        <form class="main-form" method="get">
            <ul class="nav">
                <li class="nav-item <?= $active_menu == 'index' ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu == 'student' ? 'active' : '' ?>">
                    <a class="nav-link " href="manageStudent.php?view=all">
                        <i class="material-icons">person</i>
                        <p>Quản lí sinh viên</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu == 'teacher' ? 'active' : '' ?>">
                    <a class="nav-link" href="manageTeacher.php">
                        <i class="material-icons fas fa-chalkboard-teacher"></i>
                        <p>Quản lí giáo viên</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu == 'course' ? 'active' : '' ?>">
                    <a class="nav-link" href="manageCourse.php">
                        <i class="material-icons">book</i>
                        <p>Quản lí khoá học</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu == 'class' ? 'active' : '' ?>">
                    <a class="nav-link" href="manageClass.php">
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
                <li class="nav-item <?= $active_menu == 'score' ? 'active' : '' ?>">
                    <a class="nav-link" href="queryOnSchoolGrade.php">
                        <i class="material-icons">grade</i>
                        <p>Quản lí điểm</p>
                    </a>
                </li>
            </ul>
        </form>
    </div>
</div>
