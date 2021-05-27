<div><h3 class='title font-weight-bold'>Đăng ký môn học</h3>
</div>
<div class="row">
    <div class="col-sm-3">
        <h5 style="display: inline-block">Sinh
            viên: </h5> <?= isset($getStudent['fullName']) ? $getStudent['fullName'] : "" ?>
    </div>
    <div class="col-sm-3">
        <h5 style="display: inline-block">Mã sinh viên: </h5><?= isset($getStudent['id']) ? $getStudent['id'] : "" ?>
    </div>
</div>
<?php
if (count($courseList) <= 0) {
    echo "Không có môn học khả dụng";
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
                <td><input type='checkbox' name='$row[courseCode]' id='new_$row[courseClassCode]' value='$row[id]'/></td>
                <td>$row[courseName]</td>
                <td>$row[courseCode]</td>
                <td>$row[courseClassCode]</td>
                <td>$row[credit]</td>
                <td>$row[fullName]</td>
                <td>$row[startTime]-$row[endTime]</td>
                <td>$row[place]</td>

            </tr>";
        }
        global $idStudent;
        }
        ?>

        <?php
        if (count($dataRegis) <= 0) {
            ?>
            <div style="font-weight: bold"><h3>Danh sách đăng ký</h3></div>
            <p>Bạn chưa đăng ký môn học</p>
            <?php
        } else {
        ?>
        <table class='table table-striped table-bordered table-hover'>

            <div><h3>Danh sách đăng ký</h3></div>
            <tr>
                <th>Tên môn học</th>
                <th>Mã lớp môn học</th>
                <th>Số tín chỉ</th>
                <th>Giáo viên</th>
                <th>Thời gian</th>
                <th>Địa điểm</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($dataRegis as $row) {
                echo "<tr>
        <td>$row[courseName]</td>
        <td>$row[courseClassCode]</td>
        <td>$row[credit]</td>
        <td>$row[fullName]</td>
        <td>$row[time]</td>
        <td>$row[place]</td>
        <td>$row[queryAction]</td>

    </tr>
                 ";

            }

            }

            ?>
        </table>
<?php
echo "
        </table>
        <button type='submit' class='btn btn-primary' name='btnSubmit'/>Xác nhận</button>
        <a class='btn btn-dark' href='queryOnRegister.php?type=view&for=$id'>Quay về</a>
    </form>";

if (isset($_GET['actionNow'])) {
    $numOfRegis = count($dataRegis);
    echo "<div class='alert alert-success'>Ghi nhận đăng ký $numOfRegis môn học</div>";
}

