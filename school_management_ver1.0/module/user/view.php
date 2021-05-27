<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'create':
            echo "<div class='alert alert-success'>Thêm thành công</div>";
            break;
        case 'edited':
            echo "<div class='alert alert-success'>Cập nhật thành công</div>";
            break;
        case 'deletedRestrict':
            echo "<script>alert('Không được phép xoá tài khoản này')</script>";
            break;
        case 'deleted':
            echo "<div class='alert alert-success'>Xoá thành công</div>";
            break;
        case "failUpdated":
            echo "<div class='alert alert-danger'>Dữ liệu không tồn tại</div>";
            break;
        case "infoUpdated":
            echo "<div class='alert alert-success'>Cập nhật thông tin thành công</div>";
//            echo "<div class='alert alert-danger'>Cập nhật ảnh thất bại</div>";
            break;
        case "imgUpdated":
            echo "<div class='alert alert-success'>Cập nhật ảnh thành công</div>";
//            echo "<div class='alert alert-danger'>Cập nhật thông tin thất bại</div>";
            break;
    }
}
?>
    <div class="row">
        <div class="col-sm-3">
            <h3>Danh sách tài khoản</h3>
        </div>
        <div class='col-sm-9 text-right'>
            <a class='nav-link' href='queryOnAccount.php?type=add'>
                <button class="btn btn-primary">Thêm tài khoản</button>
            </a>
        </div>
    </div>

<?php
if (count($usersAccount) <= 0) {
    echo "0 results";
} else {
?>
<form method='post'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>
            <?php
            $linkRef = http_build_query($_GET);
            $rootLink = "queryOnAccount.php?$linkRef&page=1";
            ?>
            <th>Mã ID
                <a href="<?=$rootLink?>&order=id&direction=ASC"
                   class="<?= (checkStatusOrder('id', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=id&direction=DESC"
                   class="<?= (checkStatusOrder('id', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th>Ảnh đại diện
<!--                <a href="--><?//=$rootLink?><!--&order=id&direction=ASC"-->
<!--                   class="--><?//= (checkStatusOrder('id', 'ASC')) ? 'activeDir' : '' ?><!--">-->
<!--                    <i class="material-icons">arrow_upward</i>-->
<!--                </a>-->
<!--                <a href="--><?//=$rootLink?><!--&order=id&direction=DESC"-->
<!--                   class="--><?//= (checkStatusOrder('id', 'DESC')) ? 'activeDir' : '' ?><!--">-->
<!--                    <i class="material-icons">arrow_downward</i>-->
<!--                </a>-->
            </th>
            <th>Chức vụ
                <a href="<?=$rootLink?>&order=title&direction=ASC"
                   class="<?= (checkStatusOrder('title', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=title&direction=DESC"
                   class="<?= (checkStatusOrder('title', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>

            <th>Tên đăng nhập
                <a href="<?=$rootLink?>&order=username&direction=ASC"
                   class="<?= (checkStatusOrder('username', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=username&direction=DESC"
                   class="<?= (checkStatusOrder('username', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th>Tên đại diện
                <a href="<?=$rootLink?>&order=representName&direction=ASC"
                   class="<?= (checkStatusOrder('representName', 'ASC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_upward</i>
                </a>
                <a href="<?=$rootLink?>&order=representName&direction=DESC"
                   class="<?= (checkStatusOrder('representName', 'DESC')) ? 'activeDir' : '' ?>">
                    <i class="material-icons">arrow_downward</i>
                </a>
            </th>
            <th>Action</th>
        </tr>

        <tr>
            <th>
                <input type="text" name="id" class="form-control" placeholder="Mã ID"
                       value="<?=$_POST['id'] ?? ($_GET['id']?? '')?>"/>
            </th>
            <th>
                <input type="text" name="img-personal" class="form-control" placeholder="Ảnh đại diện" disabled />
            </th>
            <th>
                <input type="text" name="title" class="form-control" placeholder="Chức vụ"
                       value="<?=$_POST['title'] ?? ($_GET['title']?? '')?>" />
            </th>

            <th>
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập"
                       value="<?=$_POST['username'] ?? ($_GET['username']?? '')?>" />
            </th>
            <th>
                <input type="text" name="representName" class="form-control" placeholder="Tên đại diên"
                       value="<?=$_POST['representName'] ?? ($_GET['representName']?? '')?>"/>
            </th>
            <th>
                <input type="submit" class="btn btn-success" value="Lọc" style="padding: 7px 10px; margin: 0px 11px" name="filter">
            </th>
        </tr>
<?php
    foreach ($usersAccount as $row) {

        $query = getActionForm('queryOnAccount.php', $row['id']);
        $imgSRC = $row['img-personal'];
        $img = "<img src='$imgSRC' alt='imageUser' id='imgUser'/>"
        ?>
        <tr>
            <td><?=$row['id']?></td>

            <td class="imgDiv"><?=$img?></td>
            <td><?=$row['title']?></td>
            <td><?=$row['username']?></td>
            <td><?= ($row['representName'] == "NULL") ? "" : $row['representName'] ?></td>
            <td><?=$query?></td>
        </tr>
    <?php } ?>

    </table>
</form>
<?php } ?>
<?php

require_once "module/page/view.php";
$params = array_merge($_GET, $_POST);
getPagination("queryOnAccount.php", $params, "$totalAccounts");
