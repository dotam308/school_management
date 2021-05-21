<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'create') {
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
        <h3>Danh sách lớp học </h3>
    </div>
    <div class='col-sm-9 text-right'>
        <a class='nav-link' href='manageClass.php?type=add'>
            <button class="btn btn-primary">Thêm lớp học</button>
        </a>
    </div>
</div>

<?php
if (count($classList) <= 0) {
echo "0 results";
} else {

?>
<form method='get'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>
            <th>Mã ID</th>
            <th>Tên lớp</th>

            <th>Sĩ số tối đa</th>
            <th>Sĩ số hiện tại</th>
            <th>Cố vấn học tập</th>
            <th>Action</th>
        </tr>
        <?php

        foreach ($classList as $row) {

            $query = getActionForm('manageClass.php', $row['id']);
            $selectTeacher = selectElementFrom("teachers", "*", "id = $row[teacherId]");
            $nameTeacher = $selectTeacher->fetch_assoc()['fullName'];
            $selectStudentOfClass = selectElementFrom("students", "*", "`classId` IN
            (SELECT c.id FROM classes c
            WHERE c.className = '$row[className]')");
            $countStudents = $selectStudentOfClass->num_rows;

            echo "<tr>";
                echo "<td>$row[id]</td>
                <td>$row[className]</td>
                <td>$row[maxStudent]</td>
                <td>$countStudents</td>
                <td>$nameTeacher</td>
                <td>$query</td>
            </tr>";
        }
?>
    </table>
</form>

<?php } ?>
<?php
$total_pages = ceil($selectClass->get()->num_rows/ LIMIT);

//$selectObjectFilter = selectElementFrom("temp_teacher", "*", "1");
$pagLink = "<ul class='pagination'>";
$page = isset($_GET['page']) ? $_GET['page'] : 0;
if ($page > 1) {
    $pagLink .= "<li class='page-item'>
        <a class='page-link'
           href='manageClass.php?type=view&page=" . ($page - 1) . "'>" . 'prev' . "
        </a>
    </li>";
}
for ($i=1; $i<=$total_pages; $i++) {
    $pagLink .= "<li class='page-item'>";

    $toLink = "manageClass.php?type=view";

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
           href='manageClass.php?type=view&page=" . ($page + 1) . "'>" . 'next' . "
        </a>
    </li>";
}
echo $pagLink . "</ul>";

