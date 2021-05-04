
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

	</table>
	<button type='submit' class="btn btn-primary" name="create" value="create">Tạo</button>
    <button type='submit' class="btn btn-info" name="create" value="continue">Tạo và tiếp tục</button>
</form>
<?php
if (isset($_POST['fullName'])) {
    $sqlInsert = "INSERT INTO `$myTable` (`id`, `fullname`, `classId`, `contactNumber`, `dob`)
    VALUES (NULL, '$_POST[fullName]', '$_POST[selectedClass]', '$_POST[contactNumber]', '$_POST[dob]')";
    $result = $conn->query($sqlInsert);

    $methodCreate = $_POST['create'];
    if ($methodCreate == 'create') {
        header("location: manageStudent.php?type=view&action=added");
    } else if ($methodCreate == 'continue') {
        header("location: manageStudent.php?type=add&action=added");
    }
}

?> 
<a href='manageStudent.php?type=view' class="btn btn-dark">Back</a>

