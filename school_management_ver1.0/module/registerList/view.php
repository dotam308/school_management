<?php
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

                <th class="col-sm-1">Mã sinh viên
                    <div>
                        <a href="manageRegister.php?type=view&order=studentId&direction=ASC&page=1"
                           class="<?= (checkStatusOrder('studentId', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="manageRegister.php?type=view&order=studentId&direction=DESC&page=1"
                           class="<?= (checkStatusOrder('studentId', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-2">Họ tên
                    <div>
                        <a href="manageRegister.php?type=view&order=fullName&direction=ASC&page=1"
                           class="<?= (checkStatusOrder('fullName', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="manageRegister.php?type=view&order=fullName&direction=DESC&page=1"
                           class="<?= (checkStatusOrder('fullName', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-1">Lớp
                    <div>
                        <a href="manageRegister.php?type=view&order=className&direction=ASC&page=1"
                           class="<?= (checkStatusOrder('className', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="manageRegister.php?type=view&order=className&direction=DESC&page=1"
                           class="<?= (checkStatusOrder('className', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-1">Mã môn học
                    <div>
                        <a href="manageRegister.php?type=view&order=courseCode&direction=ASC&page=1"
                           class="<?= (checkStatusOrder('courseCode', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="manageRegister.php?type=view&order=courseCode&direction=DESC&page=1"
                           class="<?= (checkStatusOrder('courseCode', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-2">Môn học
                    <div>
                        <a href="manageRegister.php?type=view&order=courseName&direction=ASC&page=1"
                           class="<?= (checkStatusOrder('courseName', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="manageRegister.php?type=view&order=courseName&direction=DESC&page=1"
                           class="<?= (checkStatusOrder('courseName', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-2">Mã lớp môn học
                    <div>
                        <a href="manageRegister.php?type=view&order=courseClassCode&direction=ASC&page=1"
                           class="<?= (checkStatusOrder('courseClassCode', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="manageRegister.php?type=view&order=courseClassCode&direction=DESC&page=1"
                           class="<?= (checkStatusOrder('courseClassCode', 'DESC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_downward</i>
                        </a>
                    </div>
                </th>
                <th class="col-sm-1">Số tín
                    <div>
                        <a href="manageRegister.php?type=view&order=credit&direction=ASC&page=1"
                           class="<?= (checkStatusOrder('credit', 'ASC')) ? 'activeDir' : '' ?>">
                            <i class="material-icons">arrow_upward</i>
                        </a>
                        <a href="manageRegister.php?type=view&order=credit&direction=DESC&page=1"
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
                                            value="<?= isset($_POST['studentId']) ? $_POST['studentId'] : '' ?>"/></td>
                <td class="col-sm-2"><input class="form-control" type="text" name="studentName" placeholder="Họ tên"
                                            value="<?= isset($_POST['studentName']) ? $_POST['studentName'] : '' ?>"/>
                </td>
                <td class="col-sm-1"><input class="form-control" type="text" name="className" placeholder="Lớp"
                                            value="<?= isset($_POST['className']) ? $_POST['className'] : '' ?>"/></td>

                <td class="col-sm-1"><input class="form-control" type="text" name="courseCode" placeholder="Mã MH"
                                            value="<?= isset($_POST['courseCode']) ? $_POST['courseCode'] : '' ?>"/>
                </td>
                <td class="col-sm-2"><input class="form-control" type="text" name="courseName" placeholder="Môn học"
                                            value="<?= isset($_POST['courseName']) ? $_POST['courseName'] : '' ?>"/>
                </td>
                <td class="col-sm-2"><input class="form-control" type="text" name="courseClassCode"
                                            placeholder="Mã lớp môn học"
                                            value="<?= isset($_POST['courseClassCode']) ? $_POST['courseClassCode'] : '' ?>"/>
                </td>
                <td class="col-sm-1"><input class="form-control" type="text" name="credit" placeholder="Số tín"
                                            value="<?= isset($_POST['credit']) ? $_POST['credit'] : '' ?>"/></td>
                <td class="col-sm-2"><input type="submit" class="btn btn-success"
                                            style="padding: 7px 10px; margin: 0px 11px" name="filter"
                                            value="Lọc"></td>

            </tr>
            <?php
            foreach ($dataRegis as $row) { ?>
                <tr class='row'>
                    <td class='col-sm-1'><?= $row['studentId'] ?></td>
                    <td class='col-sm-2'><?= $row['fullName'] ?></td>
                    <td class='col-sm-1'><?= $row['className'] ?></td>
                    <td class='col-sm-1'><?= $row['courseCode'] ?></td>
                    <td class='col-sm-2'><?= $row['courseName'] ?></td>
                    <td class='col-sm-2'><?= $row['courseClassCode'] ?></td>
                    <td class='col-sm-1'><?= $row['credit'] ?></td>
                    <td class='col-sm-2'><?= $row['query'] ?></td>

                </tr>
            <?php } ?>
        </table>
    </form>
    <?php
//
//    echo "<script>alert('$totalRes')</script>";
    $total_pages = ceil($totalRes / LIMIT);
    $pagLink = "<ul class='pagination'>";

    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    if ($page > 1) {
        $pagLink .= "<li class='page-item'>
        <a class='page-link'
                href='manageRegister.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=" . ($page - 1) . "'>" . 'prev' . "
        </a>
    </li>";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagLink .= "<li class='page-item'>";
        if (isset($_GET['page']) && $_GET['page'] == $i) {
            if (isset($_GET['order'])) {
                $pagLink .= "<a class='page-link active' href='manageRegister.php?type=view&order=$_GET[order]&direction=$_GET[direction]&page=" . $i . "'>" . $i . "</a>";
            } else {
                $pagLink .= "<a class='page-link active' href='manageRegister.php?type=view&direction=$_GET[direction]&page=" . $i . "'>" . $i . "</a>";
            }
        } else {
            if (isset($_GET['order'])) {
                $pagLink .= "<a class='page-link' href='manageRegister.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=" . $i . "'>" . $i . "</a>";
            } else {
                $pagLink .= "<a class='page-link' href='manageRegister.php?type=view&direction=$_GET[direction]&page=" . $i . "'>" . $i . "</a>";
            }
        }
        $pagLink .= "</li>";
    }
}
    if ($page < $total_pages) {

        $pagLink .= "<li class='page-item'>
        <a class='page-link'
                href='manageRegister.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=".($page + 1)."'>".'next'."
        </a>
    </li>";
    }
echo $pagLink . "</ul>";

