<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'added') {
        echo "<div class='alert alert-success'>Thêm thành công</div>";
    } else if ($action == 'edited') {
        echo "<div class='alert alert-success'>Sửa thành công</div>";
    } else if ($action == 'deleted') {
        echo "<div class='alert alert-success'>Xoá thành công</div>";
    }
}
?>
<?php $sql = "SELECT * from $myTable";
$result = $conn->query($sql);
?>
<div class="row">

    <div class="col-sm-3">
        <h3>Danh sách khoá học</h3>
    </div>
    <div  class="col-sm-9 text-right">
        <a class='nav-link' href='manageCourse.php?type=add'>
            <button class="btn btn-primary">Thêm khoá học</button>
        </a>
    </div>
</div>
<?php
if ($result->num_rows <= 0) {
echo "0 results";
} else {
?>
<form method='get'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>

            <th>Mã ID</th>
            <th>Số tín</th>

            <th>Mã khoá học</th>
            <th>Tên khoá học</th>
            <th>Mã lớp môn học</th>
            <th>Sĩ số tối đa</th>
            <th>Giáo viên</th>
            <th>Thời gian</th>
            <th>Địa điểm</th>
            <th>Action</th>

        </tr>
<?php
        while ($row = $result->fetch_assoc()) {

        $query = getActionForm('manageCourse.php', $row['id']);
        $sqlFindTeacherNameThroughId = "SELECT `fullName` FROM `teachers` WHERE id ='$row[teacherId]'";

        global $teacherName;
        if ($teacherName = $conn->query($sqlFindTeacherNameThroughId)) {

        $nameTeacher = $teacherName->fetch_all()[0][0];
        } else {
        echo $conn->error;
        }
        echo "<tr>";
            echo "<td>$row[id]</td>
            <td>$row[credit]</td>
            <td>$row[courseCode]</td>
            <td>$row[courseName]</td>
            <td>$row[courseClassCode]</td>
            <td>$row[maxStudent]</td>
            <td>$nameTeacher</td>
            <td>$row[startTime] -$row[endTime]  </td>
            <td>$row[place]</td>
            <td>$query</td>
        </tr>";
        }

        echo "
    </table>
</form>";
}