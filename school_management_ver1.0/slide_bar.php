<?php

if (isset($_POST['logout'])) {
    $_SESSION['permission'] = false;
    header("location: login/index.php");
}
?>
<?php $active_menu = isset($active_menu) ? $active_menu : 'index'; ?>
<?php $sub_active = isset($sub_active) ? $sub_active : null; ?>
<?php
    require_once "connection.php";
    $username = $_SESSION['username'];
    $selectUser = selectElementFrom("users", "*", "username='$username'");
    $user = $selectUser->fetch_assoc();

    $title = $user['title'];


?>

<style>
    #img-user, #inputImg {
        max-width: 100%;
        max-height: 100%;
    }
    #div-img{
        max-width: 100%;
        max-height: 100%;
    }
</style>
<div class="sidebar" data-color="purple" data-background-color="white">
    <div class="logo">
        <?php
            if ($title == 'admin') {
        ?>
        <a href="process.php" class="simple-text logo-normal">
            Quản lí nhà trường
        </a>
        <?php } ?>


        <?php
        if ($title == 'student') {
            ?>
            <a href="process.php" class="simple-text logo-normal">
                Cổng thông tin đào tạo
            </a>
        <?php } ?>
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
                <?php
                     global $title;
                    if ($title == 'admin') { ?>
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
                <?php }
                    if ($title == 'student') {

                        $active = ($active_menu == 'profile') ? 'active' : "";
                        echo "<li class='nav-item $active'>
                            <a class='nav-link' href='updateStudentProfile.php?for=$username' >
                                <i class='material-icons'>person</i>
                                <p>Cập nhật hồ sơ cá nhân</p>
                            </a>
                        </li>";
                        $active = ($active_menu == 'register') ? 'active' : "";
                        echo "<li class='nav-item $active'>
                            <a class='nav-link' href='registerCourses.php?type=view&for=$username' >
                                <i class='material-icons'>note</i>
                                <p>Đăng kí học</p>
                            </a>
                        </li>";

                        $active = ($active_menu == 'score') ? 'active' : "";
                        echo "<li class='nav-item $active'>
                            <a class='nav-link' href='queryOnStudentGrade.php?for=$username' >
                                <i class='material-icons'>grade</i>
                                <p>Kết quả học tập</p>
                            </a>
                        </li>";
                    }    ?>

            </ul>
        </form>
    </div>
</div>
