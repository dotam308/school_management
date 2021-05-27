<?php
//dd($_POST);
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case "added":
            echo "<div class='alert alert-success'>Thêm sinh viên thành công</div>";
            break;
        case "deleted":
            echo "<div class='alert alert-success'>Xoá sinh viên thành công</div>";
            break;
        case "edited":
            echo "<div class='alert alert-success'>Cập nhật sinh viên thành công</div>";
            break;
        case "filterFailed":
            echo "<div class='alert alert-danger'>Dữ liệu không tồn tại</div>";
            break;
    }
}
?>
<div class="row">

    <div class="col-sm-6">
        <h3>Danh sách sinh viên</h3>
    </div>
    <div class='col-sm-6 text-right'>
        <div class="btn btn-sm btn-primary">
            <a class='nav-link' href='manageStudent.php?type=add' style="color: white">
                Thêm sinh viên
            </a>
        </div>
    </div>
</div>
<?php

if (count($students) <= 0) {
    echo "0 results";
} else { ?>
    <form method='post' action="#">
        <table style='width: 100%' class='table table-striped table-bordered table-hover'>
            <tr class="row">
                <?php
                    $linkRef = http_build_query($_GET);
                    $rootLink = "manageStudent.php?$linkRef&page=1";
                ?>
                <th class="col-sm-2">Mã sinh viên
                    <a href="<?=$rootLink?>&order=id&direction=ASC"
                       class="<?= (checkStatusOrder('id', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="<?=$rootLink?>&order=id&direction=DESC"
                       class="<?= (checkStatusOrder('id', 'DESC')) ? 'activeDir' : '' ?>">
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
                    <a href=<?=$rootLink?>&order=className&direction=DESC"
                       class="<?= (checkStatusOrder('className', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </th>
                <th class="col-sm-2">Số điện thoại

                    <a href="<?=$rootLink?>&order=contactNumber&direction=ASC"
                       class="<?= (checkStatusOrder('contactNumber', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="<?=$rootLink?>1&order=contactNumber&direction=DESC"
                       class="<?= (checkStatusOrder('contactNumber', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </th>
                <th class="col-sm-2">Ngày sinh

                    <a href="<?=$rootLink?>&order=dob&direction=ASC"
                       class="<?= (checkStatusOrder('dob', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="<?=$rootLink?>&order=dob&direction=DESC"
                       class="<?= (checkStatusOrder('dob', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </th>
                <th class="col-sm-2">Action</th>
            </tr>
            <tr class="row">
                <th class="col-sm-2">
                    <input name="id" class="form-control" type="text" placeholder="Mã sinh viên"
                        value="<?=$_POST['id'] ?? ($_GET['id']?? '')?>"
                        >
                </th>
                <th class="col-sm-2">
                    <input name="fullName" class="form-control" type="text" placeholder="Họ tên"
                           value="<?=$_POST['fullName'] ?? ($_GET['fullName']?? '')?>">
                </th>
                <th class="col-sm-2">
                    <input name="className" class="form-control" type="text" placeholder="Lớp"
                           value="<?=$_POST['className'] ?? ($_GET['className']?? '')?>">
                </th>
                <th class="col-sm-2">
                    <input name="contactNumber" class="form-control" type="text" placeholder="Số điện thoại"
                           value="<?=$_POST['contactNumber'] ?? ($_GET['contactNumber']?? '')?>">
                </th>
                <th class="col-sm-2">
                    <input name="dob" class="form-control" type="text" placeholder="Ngày sinh"
                           value="<?=$_POST['dob'] ?? ($_GET['dob']?? '')?>">
                </th>
                <th class="col-sm-2">
                    <input type="submit" class="btn btn-success" value="Lọc" style="padding: 7px 10px; margin: 0px 11px" name="filter">
                </th>
            </tr>
            <?php
             foreach ($students as $row) {
                 echo "<tr class='row'>";
                 $query = getActionForm('manageStudent.php', $row['id'], true, true, "", true, false, $row['id']);
                 echo "<td class='col-sm-2'>$row[id]</td>
                        <td class='col-sm-2'>$row[fullName]</td>
                        <td class='col-sm-2'>$row[className]</td>
                        <td class='col-sm-2'>$row[contactNumber]</td>
                        <td class='col-sm-2'>$row[dob]</td>
                        <td class='col-sm-2'>$query</td>
                        </tr>";
             }

            ?>
        </table>
    </form>
<?php
    require_once "module/page/view.php";
    $params = array_merge($_GET, $_POST);
    getPagination("manageStudent.php", $params, "$totalStudents");
}?>

