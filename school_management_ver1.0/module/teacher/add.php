<?php
    $addStatus = -1;
    if (isset($_POST['fullName'])) {
        $addStatus = addTeacher( $_POST['fullName'], $_POST['unit'], $_POST['contactNumber']);
        if ($_POST['button'] == 'create') {
            header("location: manageTeacher.php?type=view");
        }
    }
?>
<?php 
    if ($addStatus !== -1) {
        if ($addStatus) {
            echo "<div class='alert alert-success'>Added successfully</div>";
        } else {
            echo "<div class='alert alert-warning'>Added unsuccessfully</div> ";
        }
    }
?>
<h3>Thêm giáo viên</h3>
<form class="form-horizontal" action='' method='post'>
  <div class="form-group row">
    <label class="col-sm-2 control-label"><strong>Họ tên</strong></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name='fullName' placeholder="Họ tên">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 control-label"><strong>Đơn vị</strong></label>
    <div class="col-sm-10" >
    	<select name='unit' class="form-control">
    		<option value='UET'>UET</option>
    		<option value='UEB'>UEB</option>
    		<option value='ULIS'>ULIS</option>
    		<option value='IS'>IS</option>
    		<option value='USSH'>USSH</option>
    		
    	</select>
    </div>
  </div>
  
  <div class="form-group row">
    <label class="col-sm-2 control-label"><strong>Số điện thoại</strong></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Số điện thoại" maxlength="11" name='contactNumber'>
    </div>
  </div>
  
  <button class='btn btn-primary' name='button' type='submit' value='create'>Tạo</button>
  <button class='btn btn-info' name='button' type='submit' value='continue'>Tạo và tiếp tục</button>
</form>

