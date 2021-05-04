
<?php
$sql = "SELECT * FROM `registers` WHERE studentId = '$id'";

$queryStudent = selectElementFrom('students', '*', "id='$id'");
$getStudent = $queryStudent->fetch_assoc();
if ($result = $conn->query($sql)) {
} else {
    echo "error at View type";
}?>

<div class="row">
    <div class="col-sm-3">
        <h5 style="display: inline-block">Sinh viên: </h5> <?= isset($getStudent['fullName']) ? $getStudent['fullName'] : "" ?>
    </div>
    <div class="col-sm-3">
        <h5 style="display: inline-block">Mã sinh viên: </h5><?= isset($getStudent['id']) ? $getStudent['id'] : ""  ?>
    </div>
    <div  class="col-sm-2">
        <a href="registerCourses.php?type=add&for=<?=$id?>"><i class='material-icons' style="margin-bottom: 3px">add</i>Thêm môn học</a></button>
    </div>
    <div  class="col-sm-2">
        <a href="queryOnStudentGrade.php?for=<?=$id?>"><i class='material-icons' style="margin-bottom: 3px">grade</i>Xem điểm</a></button>
    </div>
</div>
<?php
if ($result->num_rows <= 0) {
    echo "Bạn chưa đăng ký môn học";
} else {
    ?>
    <table class='table table-striped table-bordered table-hover'>
        <tr>
            <th>Mã sinh viên</th>
            <th>Họ tên</th>
            <th>Lớp</th>
            <th>Tên môn học</th>
            <th>Mã lớp môn học</th>
            <th>Số tín chỉ</th>
            <th>Giáo viên</th>
            <th>Thời gian</th>
            <th>Địa điểm</th>
            <th>Action</th>
        </tr>
        <?php
    while ($row = $result->fetch_assoc()) {

        $sqlGetCourse = "SELECT  `credit`, `courseName`,
    `courseClassCode`, startTime, endTime, place, `teacherId`
    FROM `courses` WHERE `id` = '$row[courseId]'";


        $registeredCourses = $conn->query($sqlGetCourse)->fetch_all();

        for ($j = 0; $j < count($registeredCourses); $j++) {


            $courseClassCode = $registeredCourses[$j][2];
            $credit = $registeredCourses[$j][0];
            $courseName = $registeredCourses[$j][1];
            $time = $registeredCourses[$j][3] . "-" . $registeredCourses[$j][4];
            $place = $registeredCourses[$j][5];

            $idTeacher = $registeredCourses[$j][6];
            $sqlSelectTeacher =
                "SELECT fullName
                    FROM teachers
                    WHERE id = '$idTeacher'";
            $teacher = $conn->query($sqlSelectTeacher)->fetch_all()[0][0];


            $queryClass = selectElementFrom('classes', "*", "id='$getStudent[classId]'");
            $getClass = $queryClass->fetch_assoc();

            $courseId = $row['courseId'];
            $queryAction = getActionForm('registerQuery.php', $row['studentId'], false, true, "$courseId", false);
    ?>


    <?php


        echo "<tr>
        <td>$id</td>
        <td>$getStudent[fullName]</td>
        <td>$getClass[className]</td>
        <td>$courseName</td>
        <td>$courseClassCode</td>
        <td>$credit</td>
        <td>$teacher</td>
        <td>$time</td>
        <td>$place</td>
        <td>$queryAction</td>

    </tr>";
        }

    }
} ?>

</table>
