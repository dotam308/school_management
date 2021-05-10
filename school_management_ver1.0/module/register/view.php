<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'deleted') {
        echo "<div class='alert alert-success'>Xoá thành công</div>";
    }
}
?>

<a class='btn btn-info' style="color: black; padding: 0.25rem 0.5rem;" href='manageStudent.php?type=view'>Quay về</a>
<div style="text-align: center; color: red; font-weight: 800">
    <h3>Danh sách đăng kí</h3>
</div>
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
if (count($dataRegis) <= 0) {
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
    foreach ($dataRegis as $row) {
        echo "<tr>
        <td>$row[studentId]</td>
        <td>$row[fullName]</td>
        <td>$row[className]</td>
        <td>$row[courseName]</td>
        <td>$row[courseClassCode]</td>
        <td>$row[credit]</td>
        <td>$row[teacher]</td>
        <td>$row[time]</td>
        <td>$row[place]</td>
        <td>$row[queryAction]</td>

    </tr>";
        }

    }
?>
</table>
