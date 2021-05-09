<div><h3 class='title'>Đăng ký môn học</h3>
</div>
<?php
$sqlSelectCourses = "SELECT * FROM `courses` WHERE 1";
$result = $conn->query($sqlSelectCourses);

if ($result->num_rows <= 0) {
    echo "Chưa có môn học đăng ký";
} else {
    ?>
    <form action='#' method='post'>
        <table class='table table-bordered table-hover table-striped'>
            <tr>
                <th>Chọn</th>
                <th>Tên môn học</th>
                <th>Mã môn học</th>
                <th>Mã lớp môn học</th>
                <th>Số tín chỉ</th>
                <th>Giáo viên</th>
                <th>Thời gian</th>
                <th>Địa điểm</th>
            </tr>
    <?php
    while ($row = $result->fetch_assoc()) {

        $idTeacher = $row['teacherId'];
        $sqlSelectTeacher =
            "SELECT fullName
            FROM teachers
            WHERE id = '$idTeacher'";;
        $teacher = $conn->query($sqlSelectTeacher)->fetch_all()[0][0];
        echo "<tr>
                <td><input type='checkbox' name='$row[courseCode]'/></td>
                <td>$row[courseName]</td>
                <td>$row[courseCode]</td>
                <td>$row[courseClassCode]</td>
                <td>$row[credit]</td>
                <td>$teacher</td>
                <td>$row[startTime]-$row[endTime]</td>
                <td>$row[place]</td>

            </tr>";
    }
    echo "
        </table>
        <button type='submit' class='btn btn-primary'>Xác nhận</button>
        <a class='btn btn-dark' href='registerQuery.php?type=view&for=$id'>Quay về</a>
    </form>";

    $result = $conn->query($sqlSelectCourses);
    if (isset($_POST)) {
        foreach ($_POST as $key => $value) {

            while ($row = $result->fetch_assoc()) {

                if ($row['courseCode'] == $key) {
                    // check xem da dang ki mon hoc do chua
                    $registeredCourses = array();

                    $sqlGetRC = "SELECT `courseId` FROM `registers` WHERE `studentId` = '$id'";
                    $resFromGetRC = $conn->query($sqlGetRC)->fetch_all();

                    $registeredCourses = array();
                    for ($index = 0; $index < count($resFromGetRC); $index++) {
                        $registeredCourses[] = $resFromGetRC[$index][0];
                    }

                    global $exist;
                    $exist = false;

                    if (gettype($registeredCourses) == "array") {
                        for ($index = 0; $index < count($registeredCourses); $index++) {

                            $courseId = $registeredCourses[$index];

                            $sqlFindCourseNameThroughId = "SELECT`courseCode` FROM `courses` WHERE `id` = '$courseId'";
                            $courseN = $conn->query($sqlFindCourseNameThroughId)->fetch_all()[0][0];


                            if ($key == $courseN) {
                                echo "Bạn đã đăng ký môn học $key <br/>";
                                $exist = true;
                            }
                        }
                    }

                    if (!$exist) {
                        $sqlUpdateRegisCourse = "INSERT INTO `registers` (`id`, `courseId`, `studentId`)
    VALUES (NULL, '$row[id]', '$id');";

                        $sqlUpdateScore = "INSERT INTO `scores` (`id`, `score`, `courseId`, `studentId`)
    VALUES (NULL,0, '$row[id]', '$id');";
                        if ($conn->query($sqlUpdateRegisCourse) && $conn->query($sqlUpdateScore)) {
                            header("location: registerQuery.php?type=view&for=$id");
                        } else {
                            echo 'error AT UpdateRegisCourse' . $conn->error;
                        }
                    }
                }
            }

            $result = $conn->query($sqlSelectCourses);
        }
    }
}