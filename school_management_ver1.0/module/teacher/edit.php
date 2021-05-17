<h3>Sửa giáo viên</h3>
<form class="form-horizontal" action='' method='post'>
  <div class="form-group row">
    <label class="col-sm-2 control-label"><strong>Họ tên</strong></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name='fullName' placeholder="Họ tên" value='<?= $teacher["fullName"]?>'>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 control-label"><strong>Đơn vị</strong></label>
    <div class="col-sm-10" >
    	<select name='unit' class="form-control">
    		<option value='UET' <?= ($teacher['unit'] == 'UET') ? 'selected' : '' ?>>UET</option>
    		<option value='UEB' <?= ($teacher['unit'] == 'UEB') ? 'selected' : '' ?>>UEB</option>
    		<option value='ULIS' <?= ($teacher['unit'] == 'ULIS') ? 'selected' : '' ?>>ULIS</option>
    		<option value='IS' <?= ($teacher['unit'] == 'IS') ? 'selected' : '' ?>>IS</option>
    		<option value='USSH' <?= ($teacher['unit'] == 'USSH') ? 'selected' : '' ?>>USSH</option>
    		
    	</select>
    </div>
  </div>
  
  <div class="form-group row">
    <label class="col-sm-2 control-label"><strong>Số điện thoại</strong></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Số điện thoại" maxlength="11" name='contactNumber' value='<?= $teacher["contactNumber"]?>'>
    </div>
  </div>
  
  <button class='btn btn-primary' name='button' type='submit'>Cập nhật</button>
</form>