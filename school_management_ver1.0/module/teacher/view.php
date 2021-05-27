<?php
//dd($teachers);
    $message = null;
    if (isset($_GET['action'])) {

        $action = $_GET['action'];
        if ($action == 'edited') {
            $message = 'Chỉnh sửa thành công';
        }
        if ($action == 'deleted') {
            $message = 'Xoá thành công';
        }
        if ($action == 'created') {
            $message = 'Thêm thành công';
        }

        if (!empty($message)) {
            echo "<div class='alert alert-success'>$message</div>";
        } else {
            echo "<div class='alert alert-danger'>Thao tác thất bại</div>";
        }
    }
    ?>
<div class='row'>
    	<div class='col-md-6'>
    		<h3>Danh sách giáo viên</h3>
    	</div>
    	<div class='col-md-6 text-right'>
    		<a href='manageTeacher.php?type=add'>
    			<button class='btn btn-primary' type='button'>Thêm mới giáo viên</button>
    		</a>
    	</div>
    </div>
<?php
    if (count($teachers) <= 0) {
        echo "0 results";
    } else {
  ?>
            <form method="post">
    <table style='width: 100%'
    	class='table table-striped table-bordered table-hover'>
	<tr>

        <?php
        $linkRef = http_build_query($_GET);
        $rootLink = "manageTeacher.php?$linkRef&page=1";
        ?>
		<th>Mã giáo viên
            <a href="<?=$rootLink?>&order=id&direction=ASC"
               class="<?= (checkStatusOrder('id', 'ASC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_upward</i>
            </a>
            <a href="<?=$rootLink?>&order=id&direction=DESC"
               class="<?= (checkStatusOrder('id', 'DESC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_downward</i>
            </a>
        </th>
		<th>Họ tên
            <a href="<?=$rootLink?>&order=fullName&direction=ASC"
               class="<?= (checkStatusOrder('fullName', 'ASC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_upward</i>
            </a>
            <a href="<?=$rootLink?>&order=fullName&direction=DESC"
               class="<?= (checkStatusOrder('fullName', 'DESC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_downward</i>
            </a>
        </th>
		<th>Đơn vị
            <a href="<?=$rootLink?>&order=unit&direction=ASC"
               class="<?= (checkStatusOrder('unit', 'ASC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_upward</i>
            </a>
            <a href="<?=$rootLink?>&order=unit&direction=DESC"
               class="<?= (checkStatusOrder('unit', 'DESC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_downward</i>
            </a>
        </th>
		<th>Số điện thoại
            <a href="<?=$rootLink?>&order=contactNumber&direction=ASC"
               class="<?= (checkStatusOrder('contactNumber', 'ASC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_upward</i>
            </a>
            <a href="<?=$rootLink?>&order=contactNumber&direction=DESC"
               class="<?= (checkStatusOrder('contactNumber', 'DESC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_downward</i>
            </a>
        </th>
		<th>Action</th>

	</tr>

        <tr>
            <th>
                <input type="text" name="id" placeholder="Mã giáo viên" class="form-control"
                                        value="<?= $_POST['id'] ?? ($_GET['id'] ?? '') ?>">
            </th>
            <th>
                <input type="text" name="fullName" placeholder="Họ tên"class="form-control"
                                        value="<?= $_POST['fullName'] ?? ($_GET['fullName'] ?? '') ?>">
            </th>
            <th>
                <input type="text" name="unit" placeholder="Đơn vị"  class="form-control"
                                        value="<?= $_POST['unit'] ?? ($_GET['unit'] ?? '') ?>">
            </th>
            <th>
                <input type="text" name="contactNumber" placeholder="Số điện thoại" class="form-control"
                                        value="<?= $_POST['contactNumber'] ?? ($_GET['contactNumber'] ?? '') ?>">
            </th>
            <th><input type="submit" class="btn btn-success"
                                        style="padding: 7px 10px; margin: 0px 11px" name="filter"
                                        value="Lọc"></th>
            </form>
        </tr>
    <?php
        foreach ($teachers as $row) {

            $query = getActionForm('manageTeacher.php', $row['id']);

            echo "<tr>
                        <td>$row[id]</td>
                        <td>$row[fullName]</td>
                        <td>$row[unit]</td>
                        <td>$row[contactNumber]</td>
                        <td>$query</td>
                </tr>";
        }
        ?>
    </table>
<?php  }
require_once "module/page/view.php";
$params = array_merge($_GET, $_POST);
getPagination("manageTeacher.php", $params, "$totalSelectedTeacher");

