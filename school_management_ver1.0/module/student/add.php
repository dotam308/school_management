<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'added') {
        echo "<div class='alert alert-success'>Thêm sinh viên thành công</div>";
    }
}
?>
<form method='post' action='#'>
	<table style='width: 100%' class='table'>
		<tr class="row">
			<th class="col-sm-3">Họ tên</th>
            <td class="col-sm-9"><input type='text' name='fullName' class="form-control" placeholder="Họ tên" autocomplete="off"/></td>

		</tr>
		<tr class="row">
            <th class="col-sm-3">Lớp</th>
            <?php echo "<td class='col-sm-9'>$selectClass</td>" ?>
        </tr>
        <tr class="row">
            <th class="col-sm-3">Số điện thoại</th>
            <td class="col-sm-9"><input type='text' name='contactNumber' class="form-control" placeholder="Số điện thoại"  autocomplete="off"/></td>
        </tr>
        <tr class="row">
            <th class="col-sm-3">Ngày sinh</th>
			<td class="col-sm-9"><input type='date' name='dob' class="form-control" autocomplete="off"/></td>

		</tr>
<!--        <tr class="row">-->
<!--            <th class="col-sm-3">Tạo mật khẩu</th>-->
<!--            <td class="col-sm-9"><input type='password' name='pass' class="form-control" autocomplete="off"/></td>-->
<!---->
<!--        </tr>-->
<!--        <tr class="row">-->
<!--            <th class="col-sm-3">Tên đăng nhập</th>-->
<!--            <td class="col-sm-9"><input type='text' name='username' class="form-control" autocomplete="off"/></td>-->
<!---->
<!--        </tr>-->
<!--        <tr class="row">-->
<!--            <th class="col-sm-3">Mật khẩu</th>-->
<!--            <td class="col-sm-9"><input type='password' name='pass' class="form-control" autocomplete="off"/></td>-->
<!---->
<!--        </tr>-->
	</table>
	<button type='submit' class="btn btn-primary" name="create" value="create">Tạo</button>
    <button type='submit' class="btn btn-info" name="create" value="continue">Tạo và tiếp tục</button>
</form>
<a href='manageStudent.php?type=view&page=1&order=id&direction=DESC' class="btn btn-dark">Back</a>

