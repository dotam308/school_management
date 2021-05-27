<?php
//dd($_POST);
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

            <?php
            $linkRef = http_build_query($_GET);
            $rootLink = "queryOnSchoolGrade.php?$linkRef&page=1";
            ?>
            <th class="col-sm-2">Mã sinh viên
                <a href="<?=$rootLink?>&order=studentId&direction=ASC"
                   class="<?= (checkStatusOrder('studentId', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=studentId&direction=DESC"
                   class="<?= (checkStatusOrder('studentId', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Họ tên
                <a href="<?=$rootLink?>&order=fullName&direction=ASC"
                   class="<?= (checkStatusOrder('fullName', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=fullName&direction=DESC"
                   class="<?= (checkStatusOrder('fullName', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Lớp
                <a href="<?=$rootLink?>&order=className&direction=ASC"
                   class="<?= (checkStatusOrder('className', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=className&direction=DESC"
                   class="<?= (checkStatusOrder('className', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Tên môn học
                <a href="<?=$rootLink?>&order=courseName&direction=ASC"
                   class="<?= (checkStatusOrder('courseName', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=courseName&direction=DESC"
                   class="<?= (checkStatusOrder('courseName', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Mã môn học
                <a href="<?=$rootLink?>&order=courseCode&direction=ASC"
                   class="<?= (checkStatusOrder('courseCode', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=courseCode&direction=DESC"
                   class="<?= (checkStatusOrder('courseCode', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th class="col-sm-2">Số điểm

                <a href="<?=$rootLink?>&order=score&direction=ASC"
                   class="<?= (checkStatusOrder('score', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=score&direction=DESC"
                   class="<?= (checkStatusOrder('score', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>

        </tr>
        <tr class="row">
            <th class="col-sm-2"><input type="text" name="studentId" placeholder="Mã sinh viên"
                                        class="form-control"
                                        value="<?= $_POST['studentId']?? ($_GET['studentId'] ?? '') ?>">
            </th>
            <th class="col-sm-2"><input type="text" name="fullName" placeholder="Họ tên"
                                        class="form-control"
                                        value="<?= $_POST['fullName']?? ($_GET['fullName'] ?? '')  ?>">
            </th>
            <th class="col-sm-2"><input type="text" name="className" placeholder="Lớp"
                                        class="form-control"
                                        value="<?= $_POST['className']?? ($_GET['className'] ?? '')  ?>">
            </th>
            <th class="col-sm-2"><input type="text" name="courseName" placeholder="Tên môn học"
                                        class="form-control"
                                        value="<?= $_POST['courseName']?? ($_GET['courseName'] ?? '')  ?>">
            </th>
            <th class="col-sm-2"><input type="text" name="courseCode" placeholder="Mã môn"
                                        class="form-control"
                                        value="<?= $_POST['courseCode']?? ($_GET['courseCode'] ?? '')  ?>">
            </th>
            <th class='col-sm-2'><input type="submit" class="btn btn-success"
                                        style="padding: 7px 10px; margin: 0px 11px" name="filter"
                                        value="Lọc"></th>

        </tr>
</form>
<form method="post">
        <?php
            if (count($scoreList) > 0 ) {
                foreach ($scoreList as $row) {
                    $position=$row['courseId']."_".$row['studentId'];
                    ?>

                    <tr class='row'>
                        <td class='col-sm-2'><?=$row['studentId']?></td>
                        <td class='col-sm-2'><?=$row['fullName']?></td>
                        <td class='col-sm-2'><?=$row['className']?></td>
                        <td class='col-sm-2'><?=$row['courseName']?></td>
                        <td class='col-sm-2'><?=$row['courseCode']?></td>
                        <td class='col-sm-2'>
                            <input type='text' name='<?=$position?>' style='width: 50px;' value='<?=$row['score']?>'>
                        </td>
                    </tr>
                <?php }
            }
        ?>
    </table>
    <button type='submit' class='btn btn-primary' name='submit' value='submit'>Ghi nhận</button>
</form>
<?php

require_once "module/page/view.php";
$params = array_merge($_GET, $_POST);
getPagination("queryOnSchoolGrade.php", $params, "$totalRes");
