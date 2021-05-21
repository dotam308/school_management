<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'edited') {
        echo "<div class='alert alert-success'>Sửa điểm thành công</div>";
    }
}
?>
<form method='post' action='#'>
    <table class='table table-striped table-hover table-bordered' style='width:  100%;'>
        <tr class="row">

            <th class="col-sm-2">Mã sinh viên
                <a href="queryOnSchoolGrade.php?type=view&order=studentId&direction=ASC&page=1"
                   class="<?= (checkStatusOrder('studentId', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="queryOnSchoolGrade.php?type=view&order=studentId&direction=DESC&page=1"
                   class="<?= (checkStatusOrder('studentId', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Họ tên
                <a href="queryOnSchoolGrade.php?type=view&order=fullName&direction=ASC&page=1"
                   class="<?= (checkStatusOrder('fullName', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="queryOnSchoolGrade.php?type=view&order=fullName&direction=DESC&page=1"
                   class="<?= (checkStatusOrder('fullName', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Lớp
                <a href="queryOnSchoolGrade.php?type=view&order=className&direction=ASC&page=1"
                   class="<?= (checkStatusOrder('className', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="queryOnSchoolGrade.php?type=view&order=className&direction=DESC&page=1"
                   class="<?= (checkStatusOrder('className', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Tên môn học
                <a href="queryOnSchoolGrade.php?type=view&order=courseName&direction=ASC&page=1"
                   class="<?= (checkStatusOrder('courseName', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="queryOnSchoolGrade.php?type=view&order=courseName&direction=DESC&page=1"
                   class="<?= (checkStatusOrder('courseName', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Mã môn học
                <a href="queryOnSchoolGrade.php?type=view&order=courseCode&direction=ASC&page=1"
                   class="<?= (checkStatusOrder('courseCode', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="queryOnSchoolGrade.php?type=view&order=courseCode&direction=DESC&page=1"
                   class="<?= (checkStatusOrder('courseCode', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Số điểm

                <a href="queryOnSchoolGrade.php?type=view&order=score&direction=ASC&page=1"
                   class="<?= (checkStatusOrder('score', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="queryOnSchoolGrade.php?type=view&order=score&direction=DESC&page=1"
                   class="<?= (checkStatusOrder('score', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>

        </tr>
        <tr class="row">
            <th class="col-sm-2"><input type="text" name="studentId" placeholder="Mã sinh viên"
                                        class="form-control"
                                        value="<?= isset($_POST['studentId']) ? $_POST['studentId'] : '' ?>">
            </th>
            <th class="col-sm-2"><input type="text" name="studentName" placeholder="Họ tên"
                                        class="form-control"
                                        value="<?= isset($_POST['studentName']) ? $_POST['studentName'] : '' ?>">
            </th>
            <th class="col-sm-2"><input type="text" name="className" placeholder="Lớp"
                                        class="form-control"
                                        value="<?= isset($_POST['className']) ? $_POST['className'] : '' ?>">
            </th>
            <th class="col-sm-2"><input type="text" name="courseName" placeholder="Tên môn học"
                                        class="form-control"
                                        value="<?= isset($_POST['courseName']) ? $_POST['courseName'] : '' ?>">
            </th>
            <th class="col-sm-2"><input type="text" name="courseCode" placeholder="Mã môn"
                                        class="form-control"
                                        value="<?= isset($_POST['courseCode']) ? $_POST['courseCode'] : '' ?>">
            </th>
            <th class='col-sm-2'><input type="submit" class="btn btn-success"
                                        style="padding: 7px 10px; margin: 0px 11px" name="filter"
                                        value="Lọc"></th>
        </tr>

        <?php
            if (count($scoreList) > 0 ) {
                foreach ($scoreList as $row) { ?>

                    <tr class='row'>
                        <td class='col-sm-2'><?=$row['studentId']?></td>
                        <td class='col-sm-2'><?=$row['studentName']?></td>
                        <td class='col-sm-2'><?=$row['class']?></td>
                        <td class='col-sm-2'><?=$row['courseName']?></td>
                        <td class='col-sm-2'><?=$row['courseCode']?></td>
                        <td class='col-sm-2'>
                            <input type='text' name='<?=$row['position']?>' style='width: 50px;' value='<?=$row['score']?>'>
                        </td>
                    </tr>
                <?php }
            }
        ?>
    </table>
    <button type='submit' class='btn btn-primary' name='submit' value='submit'>Ghi nhận</button>
</form>
<?php
$total_pages = ceil($totalRes / LIMIT);
$pagLink = "<ul class='pagination'>";
$page = isset($_GET['page']) ? $_GET['page'] : 0;
if ($page > 1) {
    $pagLink .= "<li class='page-item'>
        <a class='page-link'
                href='queryOnSchoolGrade.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=" . ($page - 1) . "'>" . 'prev' . "
        </a>
    </li>";
}
for ($i = 1; $i <= $total_pages; $i++) {
    $pagLink .= "<li class='page-item'>";
    if (isset($_GET['page']) && $_GET['page'] == $i) {
        if (isset($_GET['order'])) {
            $pagLink .= "<a class='page-link active' href='queryOnSchoolGrade.php?type=view&order=$_GET[order]&direction=$_GET[direction]&page=" . $i . "'>" . $i . "</a>";
        } else {
            $pagLink .= "<a class='page-link active' href='queryOnSchoolGrade.php?type=view&direction=$_GET[direction]&page=" . $i . "'>" . $i . "</a>";
        }
    } else {
        if (isset($_GET['order'])) {
            $pagLink .= "<a class='page-link' href='queryOnSchoolGrade.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=" . $i . "'>" . $i . "</a>";
        } else {
            $pagLink .= "<a class='page-link' href='queryOnSchoolGrade.php?type=view&direction=$_GET[direction]&page=" . $i . "'>" . $i . "</a>";
        }
    }
    $pagLink .= "</li>";
}
if ($page < $total_pages) {

    $pagLink .= "<li class='page-item'>
        <a class='page-link'
                href='queryOnSchoolGrade.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=".($page + 1)."'>".'next'."
        </a>
    </li>";
}
echo $pagLink . "</ul>";
