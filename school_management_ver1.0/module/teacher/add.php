<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'created') {
        echo "<div class='alert alert-success'>Thêm thành công</div>";
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
  
  <button class='btn btn-primary' name='create' type='submit' value='create'>Tạo</button>
  <button class='btn btn-info' name='create' type='submit' value='continue'>Tạo và tiếp tục</button>
</form>
    <a class="btn btn-dark" href="manageTeacher.php?type=view&page=1&order=id&direction=DESC">Back</a>

