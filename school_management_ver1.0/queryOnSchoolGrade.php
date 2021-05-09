<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lí điểm</title>
    <?php
    ob_start();
    require_once "includes/headContents.php";
    ?>
</head>

<body>
<?php

require_once 'function/functions.php';

?>
<div class="wrapper ">
    <?php $active_menu = 'student';
    $sub_active = 'score' ?>
    <?php require_once 'slide_bar.php' ?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <?php

                require_once 'connection.php';
                updateStudentOnGrade();
                global $conn;
                if ($conn->connect_error) {
                    echo $conn->error;
                } ?>

                <?php
                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                    if ($action == 'edited') {
                        echo "<div class='alert alert-success'>Sửa điểm thành công</div>";
                    }
                }
                ?>
                <form method='post' action='#'>
                    <table class='table table-striped table-hover table-bordered' style='width:  100%;'>
                        <tr class="row">
                            <th class="col-sm-2">Mã sinh viên</th>
                            <th class="col-sm-2">Họ tên</th>
                            <th class="col-sm-2">Lớp</th>
                            <th class="col-sm-2">Tên môn học</th>
                            <th class="col-sm-2">Mã môn</th>
                            <th class="col-sm-2">Số điểm</th>
                        </tr>
                        <tr class="row">
                            <th class="col-sm-2"><input type="text" name="studentId" placeholder="Mã sinh viên" class="form-control"
                                                        value="<?= isset($_POST['studentId']) ? $_POST['studentId'] : '' ?>">
                            </th>
                            <th class="col-sm-2"><input type="text" name="studentName" placeholder="Họ tên" class="form-control"
                                                        value="<?= isset($_POST['studentName']) ? $_POST['studentName'] : '' ?>">
                            </th>
                            <th class="col-sm-2"><input type="text" name="className" placeholder="Lớp" class="form-control"
                                                        value="<?= isset($_POST['className']) ? $_POST['className'] : '' ?>">
                            </th>
                            <th class="col-sm-2"><input type="text" name="courseName" placeholder="Tên môn học" class="form-control"
                                                        value="<?= isset($_POST['courseName']) ? $_POST['courseName'] : '' ?>">
                            </th>
                            <th class="col-sm-2"><input type="text" name="courseCode" placeholder="Mã môn" class="form-control"
                                                        value="<?= isset($_POST['courseCode']) ? $_POST['courseCode'] : '' ?>">
                            </th>
                            <th class='col-sm-2'><input type="submit" class="btn btn-success"
                                                        style="padding: 7px 10px; margin: 0px 11px" name="filter"
                                                        value="Lọc"></th>
                        </tr>


                        <?php
                        //check lai table
                        if (isset($_POST['filter'])) {
                            $res = filterScores();

                        } else {
                            $res = selectElementFrom('scores', "*", "1");
                        }

                        if ($res) {
                            while ($data = $res->fetch_assoc()) {
                                $selectStudent = selectElementFrom('students', "*", "id = '$data[studentId]'");
                                $student = $selectStudent->fetch_assoc();
                                $name = $student['fullName'];
                                $classId = $student['classId'];

                                $selectClass = selectElementFrom('classes', "*", "id = '$classId'");
                                $class = $selectClass->fetch_assoc();

                                $class = $class['className'];

                                $selectCourse = selectElementFrom('courses', "*", "id = '$data[courseId]'");
                                $course = $selectCourse->fetch_assoc();
                                $courseName = $course['courseName'];

                                $position = $course['id'] . "_" . "$data[studentId]";
                                echo "
        	            <tr class='row'>
        	            <td class='col-sm-2'>$data[studentId]</td>
        	            <td class='col-sm-2'>$name</td>
        	            <td class='col-sm-2'>$class</td>
        	            <td class='col-sm-2'>$courseName</td>
        	            <td class='col-sm-2'>$course[courseCode]</td>
        	            <td class='col-sm-2'><input type='text' name='$position' style='width: 50px;' value='$data[score]'></td>
        	            </tr>
        	            ";
                            }

                            echo "</table>
                     <button type='submit' class='btn btn-primary' name='submit' value='submit'>Ghi nhận</button>
                     </form>";

                        } else {
                            echo "error at GetData";
                        }

                        if (count($_POST) != "" && isset($_POST['submit'])) {
                            $updateData = $_POST;
                            foreach ($updateData as $key => $value) {
                                $courseID = getDetailData($key);
                                $sqlUpdate = "UPDATE `scores` SET `score`=$value WHERE `courseId`='$courseID[0]' AND `studentId` = '$courseID[1]'";

                                if ($conn->query($sqlUpdate)) {
                                    header("location: queryOnSchoolGrade.php?action=edited");
                                } else {
                                    // echo "erroe at Update";
                                }
                            }

                        }
                        ?>
            </div>
        </div>
    </div>
    <?php
    require_once "includes/footer.php";
    ob_end_flush();
    ?>
</div>
</body>
</html>
