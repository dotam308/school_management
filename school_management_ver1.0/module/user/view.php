<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'create') {
        echo "<div class='alert alert-success'>Thêm thành công</div>";
    } else if ($action == 'edited') {

        echo "<div class='alert alert-success'>Cập nhật thành công</div>";
    } else if ($action == 'deleted') {

        echo "<div class='alert alert-success'>Xoá thành công</div>";
    }
}
?>
    <div class="row">
        <div class="col-sm-3">
            <h3>Danh sách tài khoản</h3>
        </div>
        <div class='col-sm-9 text-right'>
            <a class='nav-link' href='queryOnAccount.php?type=add'>
                <button class="btn btn-primary">Thêm tài khoản</button>
            </a>
        </div>
    </div>

<?php
if (count($usersAccount) <= 0) {
    echo "0 results";
} else {



// output data of each row
    echo "
<form method='get'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>";

    echo "<th>Mã ID</th>
            <th>Chức vụ</th>

            <th>Tên đăng nhập</th>
            <th>Mật khẩu(md5)</th>
            <th>Tên đại diện</th>
            <th>Ảnh đại diện(source)</th>
            <th>Action</th>
        </tr>";

    foreach ($usersAccount as $row) {

        $query = getActionForm('queryOnAccount.php', $row['id']);
        $imgSRC = $row['img-personal'];
        echo "<tr>";
        echo "<td>$row[id]</td>
                <td>$row[title]</td>
                <td>$row[username]</td>
                <td>$row[pass]</td>
                <td>$row[representName]</td>
                <td>$imgSRC</td>
                <td>$query</td>
            </tr>";
    }

    echo "
    </table>
</form>";
}