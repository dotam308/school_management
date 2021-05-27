<?php
?>
<h3>Chỉnh sửa tài khoản</h3>
<form method='post' enctype="multipart/form-data">
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>
<?php
$imgSRC = $oldData['img-personal'];
?>
  <tr>
            <th>Mã ID</th>
            <td><input type='text' value='<?= $oldData['id'] ?>' class='form-control' disabled></td>
            </tr>
            <tr>
            <th>Chức vụ</th>
                <td>

                <select name="title" class="form-control">

                    <option value="">select</option>
                    <option <?= ($oldData['title'] == 'admin' ? 'selected' : '') ?>>admin</option>
                    <option <?= ($oldData['title'] == 'student' ? 'selected' : '') ?>>student</option>
                </select>
              </td>
            </tr>
            <tr>
            
            <th>Tên đăng nhập</th>
                <td><input type='text' value='<?=$oldData['username'] ?>' class='form-control'
                        <?= ($oldData['title'] == 'admin') ? '' : 'disabled'?>></td>
            </tr>
            <tr>
            <th>Mật khẩu mới</th>
                <td><input type='password' class='form-control' name="pass"></td>
            </tr>
            <tr>
            
            <th>Tên đại diện</th>
                <td><input type='text' value='<?=$oldData['representName'] ?>' class='form-control' name="representName"></td>
            </tr>
            <tr>
                <th>Ảnh đại diện(source)</th>
                <td>
                    <input type='file' class='form-control' name="imgSrc" id="inputImg">
                    <div style="display: flex">
                        <div id="thumb-output" class="container-sm imgDiv">
                            <?php
                            $src = $oldData["img-personal"];
                                if (!empty($src)) {
                                    echo "<img class='container-sm imgDiv' src='$src' alt='$src'/>";
                                }
                            ?>
                        </div>
                    </div>
                </td>
            </tr>

        </tr>

    </table>
    <button type="submit" class="btn btn-primary" name="edit">Cập nhật</button>
</form>
