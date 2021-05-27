<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
    <title>Quản lí nhà trường</title>
    <?php
    require_once "includes/headContents.php";
    ?>
</head>

<body>

<div class="wrapper ">

    <?php $active_menu = 'index'; $sub_active = 'action';
    require_once "function/functions.php";
    require_once "connection.php";
    updateStudentOnGrade();
    ?>

    <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
        <?php
        require_once "includes/header.php";
        ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">person</i>
                                </div>
                                <p class="card-category">Số lượng sinh viên</p>
                                <h3 class="card-title">
                                    <?php

                                    $selectStudents = selectElementFrom('students', "*", "1");

                                    echo $selectStudents->num_rows;
                                    ?>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons text-danger">add</i>
                                    <a href="manageStudent.php?type=add">Thêm sinh viên</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons fas fa-chalkboard-teacher"></i>
                                </div>
                                <p class="card-category">Số lượng giáo viên giảng dạy</p>
                                <h3 class="card-title">
                                    <?php
                                    $selectTeachers = selectElementFrom('teachers', "*", "1");

                                    echo $selectTeachers->num_rows;
                                    ?>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons text-danger">add</i>
                                    <a href="manageTeacher.php?type=add">Thêm giáo viên</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons fas fa-chalkboard"></i>
                                </div>
                                <p class="card-category">Số lượng lớp học chính khoá</p>
                                <h3 class="card-title">
                                    <?php
                                    $selectClasses = selectElementFrom('classes', "*", "1");

                                    echo $selectClasses->num_rows;
                                    ?>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons text-danger">add</i>
                                    <a href="manageClass.php?type=add">Thêm lớp học</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">note</i>
                                </div>
                                <p class="card-category">Số lượng khoá học</p>
                                <h3 class="card-title">
                                    <?php
                                    $selectCourses = selectElementFrom('courses', "*", "1");

                                    echo $selectCourses->num_rows;
                                    ?>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons text-danger">add</i>
                                    <a href="manageCourse.php?type=add">Thêm khoá học</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h4 class="card-title">Top sinh viên có GPA cao nhất</h4>
                                <p class="card-category">Cập nhật mới nhất vào <?php echo date("d - m - Y"); ?></p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-warning">
                                    <th>Mã sinh viên</th>
                                    <th>Họ tên</th>
                                    <th>Lớp</th>
                                    <th>Điểm GPA</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $dataTopStudent = getHighestScoreStudents();
                                    if ($dataTopStudent && $dataTopStudent[0]['score'] >= 8) {

                                        for ($i = 0; $i < count($dataTopStudent); $i++) {
                                            $id = $dataTopStudent[$i]["id"];
                                            $score = $dataTopStudent[$i]["score"];
                                            if ($score > 8) {
                                                echo "<tr>
                                                <td><a href='queryOnStudentGrade.php?for=$id'>$id</a></td>
                                                <td>".$dataTopStudent[$i]["name"]."</td>
                                                <td>".$dataTopStudent[$i]["className"]."</td>
                                                <td>".round($dataTopStudent[$i]["score"], 1)."</td>
                                                </tr>";
                                            }
                                        }
                                    } else { ?>
                                        <div>Chưa có kết quả</div>
                                        <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
require_once "includes/footer.php";
?>
</div>
</div>
</body>

</html>
