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
<form method='post'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>

            <th>Mã ID
                <div>
                <a href="manageCourse.php?type=view&page=1&order=id&direction=ASC"
                   class="<?= (checkStatusOrder('id', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="manageCourse.php?type=view&page=1&order=id&direction=DESC"
                   class="<?= (checkStatusOrder('id', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
                </div>
            </th>
            <th>Số tín
                <div><a href="manageCourse.php?type=view&page=1&order=credit&direction=ASC"
                        class="<?= (checkStatusOrder('credit', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageCourse.php?type=view&page=1&order=credit&direction=DESC"
                       class="<?= (checkStatusOrder('credit', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>

            <th>Mã khoá học
                <div>

                    <a href="manageCourse.php?type=view&page=1&order=courseCode&direction=ASC"
                       class="<?= (checkStatusOrder('courseCode', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageCourse.php?type=view&page=1&order=courseCode&direction=DESC"
                       class="<?= (checkStatusOrder('courseCode', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Tên khoá học
                <div>
                    <a href="manageCourse.php?type=view&page=1&order=courseName&direction=ASC"
                       class="<?= (checkStatusOrder('courseName', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageCourse.php?type=view&page=1&order=courseName&direction=DESC"
                       class="<?= (checkStatusOrder('courseName', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Mã lớp môn học
                <div>
                    <a href="manageCourse.php?type=view&page=1&order=courseClassCode&direction=ASC"
                       class="<?= (checkStatusOrder('courseClassCode', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageCourse.php?type=view&page=1&order=courseClassCode&direction=DESC"
                       class="<?= (checkStatusOrder('courseClassCode', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Sĩ số tối đa
                <div>
                    <a href="manageCourse.php?type=view&page=1&order=maxStudent&direction=ASC"
                       class="<?= (checkStatusOrder('maxStudent', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageCourse.php?type=view&page=1&order=maxStudent&direction=DESC"
                       class="<?= (checkStatusOrder('maxStudent', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Giáo viên
                <div>
                    <a href="manageCourse.php?type=view&page=1&order=teacherId&direction=ASC"
                       class="<?= (checkStatusOrder('teacherId', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageCourse.php?type=view&page=1&order=teacherId&direction=DESC"
                       class="<?= (checkStatusOrder('teacherId', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Thời gian
                <div>
                    <a href="manageCourse.php?type=view&page=1&order=start&direction=ASC"
                       class="<?= (checkStatusOrder('start', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageCourse.php?type=view&page=1&order=start&direction=DESC"
                       class="<?= (checkStatusOrder('start', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Địa điểm
                <div>
                    <a href="manageCourse.php?type=view&page=1&order=place&direction=ASC"
                       class="<?= (checkStatusOrder('place', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageCourse.php?type=view&page=1&order=place&direction=DESC"
                       class="<?= (checkStatusOrder('place', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Action</th>

        </tr>
    <tr>
        <th>
            <input name="id" type="text" placeholder="Mã id" class="form-control"/>
        </th>
        <th>
            <input name="credit" type="text"  placeholder="Số tín" class="form-control"/>
        </th>

        <th>
            <input name="courseCode" type="text"  placeholder="Mã khoá học" class="form-control"/>
        </th>
        <th>
            <input name="courseName" type="text"  placeholder="Tên khoá học" class="form-control"/>
        </th>
        <th>
            <input name="courseClassCode" type="text"  placeholder="Mã lớp môn học" class="form-control"/>
        </th>
        <th>
            <input name="maxStudent" type="text"  placeholder="Sĩ số tối đa" class="form-control"/>
        </th>
        <th>
            <input name="teacherName" type="text"  placeholder="Giáo viên" class="form-control"/>
        </th>
        <th>
            <input name="time" type="text" placeholder="Thời gian" class="form-control"/>
        </th>
        <th>
            <input name="place" type="text"  placeholder="Địa điểm" class="form-control"/>
        </th>
        <th>
            <input type="submit" class="btn btn-success" value="Lọc" style="padding: 7px 10px; margin: 0px 11px" name="filter">
        </th>

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
