<?php
    global $conn;
    $editStatus = 0;
    if (isset($_POST['edit'])) {
        if ($_POST['pass'] != '') {
            $encodePass = md5($_POST['pass']);
            $sqlUpdate = "UPDATE `users` 
                SET `title`='$_POST[title]',`pass`='$encodePass',
                  `representName`='$_POST[representName]' WHERE id = '$_GET[for]'";
        } else {
            $sqlUpdate = "UPDATE `users` 
                SET `title`='$_POST[title]',
                  `representName`='$_POST[representName]' WHERE id = '$_GET[for]'";
        }
        if ($conn->query($sqlUpdate)) {
            $editStatus++;
        }
    }
    if (isset($_FILES['imgSrc'])) {
        uploadImage("$_GET[for]", "imgSrc");
        $editStatus++;
    }
    if ($editStatus == 2) {
        header("location: queryOnAccount.php?type=view&action=edited");
    }
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

                    <option value="abc">select</option>
                    <option <?= ($oldData['title'] == 'admin' ? 'selected' : '') ?>>admin</option>
                    <option <?= ($oldData['title'] == 'student' ? 'selected' : '') ?>>student</option>
                </select>
              </td>
            </tr>
            <tr>
            
            <th>Tên đăng nhập</th>
                <td><input type='text' value='<?=$oldData['username'] ?>' class='form-control' disabled></td>
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

                    <input type='text' value='<?=$imgSRC?>' class='form-control' name="imgSrc" >
                    <input type='file' class='form-control' name="imgSrc" >
                </td>
            </tr>

        </tr>

    </table>
    <button type="submit" class="btn btn-primary" name="edit">Cập nhật</button>
</form>
