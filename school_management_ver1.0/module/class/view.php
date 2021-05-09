<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'added') {
        echo "<div class='alert alert-success'>Thêm thành công</div>";
    } else if ($action == 'deleted') {
        echo "<div class='alert alert-success'>Xoá thành công</div>";
    }
}
?>
<?php
$sql = "SELECT * from $myTable ORDER BY id DESC";
$result = $conn->query($sql);
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'create') {
        echo "<div class='alert alert-success'>Thêm thành công</div>";
    } else if ($action == 'edited') {

        echo "<div class='alert alert-success'>Sửa thành công</div>";
    }
}
?>
<div class="row">
    <div class="col-sm-3">
        <h3>Danh sách lớp học </h3>
    </div>
    <div class='col-sm-9 text-right'>
        <a class='nav-link' href='manageClass.php?type=add'>
            <button class="btn btn-primary">Thêm lớp học</button>
        </a>
    </div>
</div>

<?php
if ($result->num_rows <= 0) {
echo "0 results";
} else {



// output data of each row
echo "
<form method='get'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>";

            echo "<th>Mã ID</th>
            <th>Tên lớp</th>

            <th>Sĩ số tối đa</th>
            <th>Sĩ số hiện tại</th>
            <th>Cố vấn học tập</th>
            <th>Action</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {

        $query = getActionForm('manageClass.php', $row['id']);
        $sqlFindTeacherNameThroughId = "SELECT `fullName` FROM `teachers` WHERE id ='$row[teacherId]'";

        global $teacherName;
        if ($teacherName = $conn->query($sqlFindTeacherNameThroughId)) {

        $nameTeacher = $teacherName->fetch_all()[0][0];
        } else {
        echo $conn->error;
        }

        $selectStudentOfClass = "SELECT *
        FROM `students` s
        WHERE `classId` IN
        (SELECT c.id FROM classes c
        WHERE c.className = '$row[className]')";

        $students = $conn->query($selectStudentOfClass);
        $countStudents = count($students->fetch_all());

        echo "<tr>";
            echo "<td>$row[id]</td>
            <td>$row[className]</td>
            <td>$row[maxStudent]</td>
            <td>$countStudents</td>
            <td>$nameTeacher</td>
            <td>$query</td>
        </tr>";
        }

        echo "
    </table>
</form>";
}