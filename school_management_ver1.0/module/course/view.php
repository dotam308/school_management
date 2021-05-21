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
if (count($courseList) <= 0) {
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
        foreach ($courseList as $row) {

        $query = getActionForm('manageCourse.php', $row['id']);
        $selectTeacher = selectElementFrom("teachers", "*", "id ='$row[teacherId]'");
        $teacherName = $selectTeacher->fetch_assoc()['fullName'];
        echo "<tr>";
            echo "<td>$row[id]</td>
            <td>$row[credit]</td>
            <td>$row[courseCode]</td>
            <td>$row[courseName]</td>
            <td>$row[courseClassCode]</td>
            <td>$row[maxStudent]</td>
            <td>$teacherName</td>
            <td>$row[startTime] -$row[endTime]  </td>
            <td>$row[place]</td>
            <td>$query</td>
        </tr>";
        }

        echo "
    </table>
</form>";
}


$total_pages = ceil($selectedCourses->get()->num_rows / LIMIT);

//$selectObjectFilter = selectElementFrom("temp_teacher", "*", "1");
$pagLink = "<ul class='pagination'>";
$page = isset($_GET['page']) ? $_GET['page'] : 0;
if ($page > 1) {
    $pagLink .= "<li class='page-item'>
        <a class='page-link'
           href='manageCourse.php?type=view&page=" . ($page - 1) . "'>" . 'prev' . "
        </a>
    </li>";
}
for ($i = 1; $i <= $total_pages; $i++) {
    $pagLink .= "<li class='page-item'>";

    $toLink = "manageCourse.php?type=view";

    if (isset($_GET['page']) && $_GET['page'] == $i) {
        $toLink .= "&page=$i";
        $pagLink .= "<a class='page-link active' href='$toLink'>" . $i . "</a>";

    } else {
        $toLink .= "&page=$i";
        $pagLink .= "<a class='page-link' href='$toLink'>" . $i . "</a>";
    }
    $pagLink .= "</li>";
}
if ($page < $total_pages) {

    $pagLink .= "<li class='page-item'>
        <a class='page-link'
           href='manageCourse.php?type=view&page=" . ($page + 1) . "'>" . 'next' . "
        </a>
    </li>";
}
echo $pagLink . "</ul>";
