<?php

$salt = $userC['salt'];
if (isset($_POST['confirm'])) {
    if (md5($_POST['pass'].$salt) == $userC['pass']) {
        header("location: queryOnAccount.php?type=edit&for=$id&check=true");
    } else {
        echo  "<script>alert('Sai mật khẩu')</script>";
    }
}
?>
    <h3>Nhập lại mật khẩu</h3>
    <form method='post'>
        <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
            <tr>    <tr>
            
            <th>Tên đăng nhập</th>
                <td><input type='text' value='<?= $_SESSION['username']?>' class='form-control' disabled>
                    <input type='text' value='<?= $_SESSION['username']?>' class='form-control' hidden>
                </td>
            </tr>
            <tr>
            <th>Mật khẩu</th>
                <td><input type='password' class='form-control' name="pass"></td>
            </tr>
            <tr>
        </tr>

    </table>
        <button type="submit" class="btn btn-primary" name="confirm">Xác nhận</button>
    </form>

