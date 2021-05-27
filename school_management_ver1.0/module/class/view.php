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
<form method='post'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>
            <?php
            $linkRef = http_build_query($_GET);
            $rootLink = "manageClass.php?$linkRef&page=1";
            ?>
            <th>Mã ID
                <div>
                    <a href="<?=$rootLink?>&page=1&order=id&direction=ASC"
                       class="<?= (checkStatusOrder('id', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="<?=$rootLink?>&page=1&order=id&direction=DESC"
                       class="<?= (checkStatusOrder('id', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Tên lớp
                <div>
                    <a href="<?=$rootLink?>&page=1&order=className&direction=ASC"
                       class="<?= (checkStatusOrder('className', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="<?=$rootLink?>&page=1&order=className&direction=DESC"
                       class="<?= (checkStatusOrder('className', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>

            <th>Sĩ số tối đa
                <div>
                    <a href="<?=$rootLink?>&page=1&order=maxStudent&direction=ASC"
                       class="<?= (checkStatusOrder('maxStudent', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="<?=$rootLink?>&page=1&order=maxStudent&direction=DESC"
                       class="<?= (checkStatusOrder('maxStudent', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Sĩ số hiện tại
                <div>
                    <a href="<?=$rootLink?>&page=1&order=numOfStudents&direction=ASC"
                       class="<?= (checkStatusOrder('numOfStudents', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="<?=$rootLink?>&page=1&order=numOfStudents&direction=DESC"
                       class="<?= (checkStatusOrder('numOfStudents', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Cố vấn học tập
                <div>
                    <a href="<?=$rootLink?>&page=1&order=teacherName&direction=ASC"
                       class="<?= (checkStatusOrder('teacherName', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="<?=$rootLink?>&page=1&order=teacherName&direction=DESC"
                       class="<?= (checkStatusOrder('teacherName', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </div>
            </th>
            <th>Action</th>
        </tr>
        <tr>
            <th>
                <input type="text" name="id" class="form-control" placeholder="Mã ID"
                       value="<?=$_POST['id'] ?? ($_GET['id'] ?? '')?>"
                />
            </th>
            <th>
                <input type="text" name="className" class="form-control" placeholder="Tên lớp"
                       value="<?=$_POST['className'] ?? ($_GET['className'] ?? '')?>"
                />
            </th>

            <th>
                <input type="text" name="maxStudent" class="form-control" placeholder="Sĩ số tối đa"
                       value="<?=$_POST['maxStudent'] ?? ($_GET['maxStudent'] ?? '')?>"
                />
            </th>
            <th>
                <input type="text" name="numOfStudents" class="form-control" placeholder="Sĩ số hiện tại"
                       value="<?=$_POST['numOfStudents'] ?? ($_GET['numOfStudents'] ?? '')?>"
                />
            </th>
            <th>
                <input type="text" name="teacherName" class="form-control" placeholder="Cố vấn học tập"
                       value="<?=$_POST['teacherName'] ?? ($_GET['teacherName'] ?? '')?>"
                />
            </th>
            <th>
                <input type="submit" class="btn btn-success" value="Lọc" style="padding: 7px 10px; margin: 0px 11px" name="filter">
            </th>
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
            $sqlUpdate = "UPDATE `classes` SET `numOfStudents`='$countStudents' WHERE id='$row[id]'";
            $conn->query($sqlUpdate);
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

require_once "module/page/view.php";
$params = array_merge($_GET, $_POST);
getPagination("manageClass.php", $params, "$totalClasses");

