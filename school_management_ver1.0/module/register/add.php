<div><h3 class='title'>Đăng ký môn học</h3>
</div>
<?php

if (count($courseList)<= 0) {
    echo "Chưa có môn học đăng ký";
} else {
    ?>
    <form action="#" method='post'>
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
    foreach ($courseList as $row) {

        echo "<tr>
                <td><input type='checkbox' name='$row[courseCode]'/></td>
                <td>$row[courseName]</td>
                <td>$row[courseCode]</td>
                <td>$row[courseClassCode]</td>
                <td>$row[credit]</td>
                <td>$row[teacher]</td>
                <td>$row[time]</td>
                <td>$row[place]</td>

            </tr>";
    }
    global $idStudent;
    echo "
        </table>
        <button type='submit' class='btn btn-primary' name='btnSubmit' value='submit'/>Xác nhận</button>
        <a class='btn btn-dark' href='queryOnRegister.php?type=view&for=$id'>Quay về</a>
    </form>";
}

if (count($_POST) > 0 ) {
    $courseExits = checkExist($_POST);
}
if (isset($courseExits) && count($courseExits) > 0) {
    foreach ($courseExits as $row) {
        echo "Bạn đã đăng ký khoá học $row <br/>";
    }
}
