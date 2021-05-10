<?php
    $message = null;
    if (isset($_GET['action'])) {

        $action = $_GET['action'];
        if ($action == 'edited') {
            $message = 'Chỉnh sửa thành công';
        }
        if ($action == 'deleted') {
            $message = 'Xoá thành công';
        }
        if ($action == 'added') {
            $message = 'Thêm thành công';
        }
    }
    if (!empty($message)) {
        echo "<div class='alert alert-success'>$message</div>";
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
    <table style='width: 100%'
    	class='table table-striped table-bordered table-hover'>
	<tr>
		<th>Mã giáo viên</th>
		<th>Họ tên</th>
		<th>Đơn vị</th>
		<th>Số điện thoại</th>
		<th>Action</th>

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
<?php  } ?>