<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'create') {
        echo "<div class='alert alert-success'>Thêm thành công</div>";
    }
}
if ($addStatus != -1) {
    if ($addStatus !== true) {
        echo "<div class='alert alert-danger'>Thêm thất bại</div>";
    }
}
?>
<h3>Thêm tài khoản</h3>
<form method='post' action='#'>
    <table style='width:100%' class='table'>
        <tr>
            <th>Chức vụ</th>
            <td>
                <select name="title" class="form-control" required>

                    <option style="display: none" value="">select</option>
                    <option value="admin">admin</option>
                    <option value="student">student</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Tên đăng nhập</th>
            <td><input type='text' name='username' class='form-control' placeholder='Tên đăng nhập'
                       autocomplete='off' required/></td>

        </tr>
        <tr>
            <th>Mật khẩu</th>
            <td><input type='password' name='pass' class='form-control' placeholder='Mật khẩu'
                       autocomplete='off' required/></td>

        </tr>


    </table>
    <div>
        <input type='submit' class='btn btn-sm btn-primary' name="create" value="Tạo">
        <input type='submit' class='btn btn-sm btn-info' name='continue' value="Tạo và tiếp tục">
    </div>
</form>
<form method="post">

    <input type='submit' class='btn btn-sm btn-dark' name='back' value="Back">
</form>