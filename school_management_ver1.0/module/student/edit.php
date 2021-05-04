<?php
$sqlSelectStudent = "SELECT * FROM `$myTable` WHERE id=$id";
$res = $conn->query($sqlSelectStudent);
$oldData = $res->fetch_all()[0];

if (isset($_POST['id1'])) {
    $updateStatus = updateStudent($id, $_POST['fullName'], $_POST['contactNumber'], $_POST['dob'], $_POST['selectedClass']);
    header("location: manageStudent.php?type=edit&for=$id");
}
if ($updateStatus == true) {
    echo '<div class="alert alert-success">Updated successfully.</div>';
} else if ($updateStatus != - 1) {
    echo '<div class="alert alert-danger">Updated failed.</div>';
}
$selectClass = createSelectClasses($oldData[2]);
?>
<form method='post' action='#'>
	<table style='width: 100%' class='table'>
		<tr class="row">
			<th class="col-sm-3">Mã sinh viên</th>

            <?php echo "    
                    <td><input type='text' name='id1' value='$oldData[0]' class='col-sm-9 form-control' disabled/>
                        <input type='hidden' name='id1' value='$oldData[0]'/></td>"; ?>
		</tr>
        <tr class="row">
            <th class="col-sm-3">Họ tên</th>
            <?php echo "<td class='col-sm-9'><input type='text' name='fullName' value='$oldData[1]' class='form-control'/></td>"; ?>
        </tr>
        <tr class="row">
            <th class="col-sm-3">Lớp</th>
             <?php echo "<td class='col-sm-9 form-control'/>$selectClass</td>"; ?>
        </tr>
        <tr class="row">
            <th class="col-sm-3">Số điện thoại</th>
            <?php echo "<td class='col-sm-9 form-control'><input type='text' class='form-control' name='contactNumber' value='$oldData[3]'/></td>"; ?>
        </tr>
        <tr class="row">
            <th class="col-sm-3">Ngày sinh</th>
            <?php echo "<td class='col-sm-9 form-control'><input type='date' class='form-control' name='dob' value='$oldData[4]'/></td>"; ?>
        </tr>

        </table>
	<button type='submit' class="btn btn-primary">Hoàn tất</button>
	</form>

	<a href='manageStudent.php?type=view' class="btn btn-dark">Back</a>

<?php
function updateStudent($id, $fullName, $phone, $dob, $classId)
{
    global $conn;
    $myTable = STUDENT_TABLE;
    $date = strtotime($dob);
    $dob = date('Y-m-d', $date);

    $sqlUpdate = "UPDATE `$myTable` SET `fullname`='$fullName',`classId`='$classId',`contactNumber`='$phone',`dob`='$dob' WHERE id='$id'";

    return $conn->query($sqlUpdate);
}


