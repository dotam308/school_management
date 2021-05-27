<?php

//dd($result);
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'deleted')
        echo '<div class="alert alert-success">Xoá thành công.</div>';
    else
        echo '<div class="alert alert-danger">Xoá thất bại.</div>';
}
if (count($dataRegis) <= 0) {
    echo "0 results";
} else {
    ?>
    <h3>Danh sách đăng kí</h3>
    <form method='post' action="#">
        <table style='width:100%' class='table table-striped table-bordered table-hover'>
            <tr class="row">

                <?php
                $linkRef = http_build_query($_GET);
                $rootLink = "manageRegister.php?$linkRef&page=1";
                ?>
                <th class="col-sm-1">Mã sinh viên
                    <div>
                        <a href="<?=$rootLink?>&order=studentId&direction=ASC"
                           class="<?= (checkStatusOrder('studentId', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="<?=$rootLink?>&order=studentId&direction=DESC"
                           class="<?= (checkStatusOrder('studentId', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-2">Họ tên
                    <div>
                        <a href="<?=$rootLink?>&order=fullName&direction=ASC"
                           class="<?= (checkStatusOrder('fullName', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="<?=$rootLink?>&order=fullName&direction=DESC"
                           class="<?= (checkStatusOrder('fullName', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-1">Lớp
                    <div>
                        <a href="<?=$rootLink?>&order=className&direction=ASC"
                           class="<?= (checkStatusOrder('className', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="<?=$rootLink?>&order=className&direction=DESC"
                           class="<?= (checkStatusOrder('className', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-1">Mã môn học
                    <div>
                        <a href="<?=$rootLink?>&order=courseCode&direction=ASC"
                           class="<?= (checkStatusOrder('courseCode', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="<?=$rootLink?>&order=courseCode&direction=DESC"
                           class="<?= (checkStatusOrder('courseCode', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-2">Môn học
                    <div>
                        <a href="<?=$rootLink?>&order=courseName&direction=ASC"
                           class="<?= (checkStatusOrder('courseName', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="<?=$rootLink?>&order=courseName&direction=DESC"
                           class="<?= (checkStatusOrder('courseName', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-2">Mã lớp môn học
                    <div>
                        <a href="<?=$rootLink?>&order=courseClassCode&direction=ASC"
                           class="<?= (checkStatusOrder('courseClassCode', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="<?=$rootLink?>&order=courseClassCode&direction=DESC"
                           class="<?= (checkStatusOrder('courseClassCode', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-1">Số tín
                    <div>
                        <a href="<?=$rootLink?>&order=credit&direction=ASC"
                           class="<?= (checkStatusOrder('credit', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="<?=$rootLink?>&order=credit&direction=DESC"
                           class="<?= (checkStatusOrder('credit', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-2">Action
                </th>

            </tr>
            <tr class="row">

                <td class="col-sm-1"><input class="form-control" type="text" name="studentId" placeholder="Mã SV"
                                            value="<?= $_POST['studentId'] ?? ($_GET['studentId'] ?? '') ?>"/></td>
                <td class="col-sm-2"><input class="form-control" type="text" name="fullName" placeholder="Họ tên"
                                            value="<?= $_POST['fullName'] ?? ($_GET['fullName'] ?? '')  ?>"/>
                </td>
                <td class="col-sm-1"><input class="form-control" type="text" name="className" placeholder="Lớp"
                                            value="<?= $_POST['className'] ?? ($_GET['className'] ?? '')  ?>"/></td>

                <td class="col-sm-1"><input class="form-control" type="text" name="courseCode" placeholder="Mã MH"
                                            value="<?= $_POST['courseCode'] ?? ($_GET['courseCode'] ?? '')  ?>"/>
                </td>
                <td class="col-sm-2"><input class="form-control" type="text" name="courseName" placeholder="Môn học"
                                            value="<?= $_POST['courseName'] ?? ($_GET['courseName'] ?? '')  ?>"/>
                </td>
                <td class="col-sm-2"><input class="form-control" type="text" name="courseClassCode"
                                            placeholder="Mã lớp môn học"
                                            value="<?=$_POST['courseClassCode'] ?? ($_GET['courseClassCode'] ?? '')  ?>"/>
                </td>
                <td class="col-sm-1"><input class="form-control" type="text" name="credit" placeholder="Số tín"
                                            value="<?= $_POST['credit'] ?? ($_GET['credit'] ?? '')  ?>"/></td>
                <td class="col-sm-2"><input type="submit" class="btn btn-success"
                                            style="padding: 7px 10px; margin: 0px 11px" name="filter"
                                            value="Lọc"></td>

            </tr>
            <?php
            foreach ($dataRegis as $row) {
                $query = getActionForm('manageRegister.php', $row['studentId'], false, true,
                    "$row[courseId]", true, false, $row['studentId']);
                ?>
                <tr class='row'>
                    <td class='col-sm-1'><?= $row['studentId'] ?></td>
                    <td class='col-sm-2'><?= $row['fullName'] ?></td>
                    <td class='col-sm-1'><?= $row['className'] ?></td>
                    <td class='col-sm-1'><?= $row['courseCode'] ?></td>
                    <td class='col-sm-2'><?= $row['courseName'] ?></td>
                    <td class='col-sm-2'><?= $row['courseClassCode'] ?></td>
                    <td class='col-sm-1'><?= $row['credit'] ?></td>
                    <td class='col-sm-2'><?= $query ?></td>

                </tr>
            <?php } ?>
        </table>
    </form>
    <?php

    require_once "module/page/view.php";
    $params = array_merge($_GET, $_POST);
    getPagination("manageRegister.php", $params, "$totalRegister");
}?>
