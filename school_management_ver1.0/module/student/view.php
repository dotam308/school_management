<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case "added":
            echo "<div class='alert alert-success'>Thêm sinh viên thành công</div>";
            break;
        case "deleted":
            echo "<div class='alert alert-success'>Xoá sinh viên thành công</div>";
            break;
        case "edited":
            echo "<div class='alert alert-success'>Cập nhật sinh viên thành công</div>";
            break;
    }
}
?>
<div class="row">

    <div class="col-sm-6">
        <h3>Danh sách sinh viên</h3>
    </div>
    <div class='col-sm-6 text-right'>
        <a class='nav-link' href='manageStudent.php?type=add'>
            <button class="btn btn-primary">Thêm sinh viên</button>
        </a>
    </div>
</div>
<?php

if (count($students) <= 0) {
    echo "0 results";
} else { ?>
    <form method='post' action="#">
        <table style='width: 100%' class='table table-striped table-bordered table-hover'>
            <tr class="row">
                <th class="col-sm-2">Mã sinh viên</th>
                <th class="col-sm-2">Họ tên</th>
                <th class="col-sm-2">Lớp</th>
                <th class="col-sm-2">Số điện thoại</th>
                <th class="col-sm-2">Ngày sinh</th>
                <th class="col-sm-2">Action</th>
            </tr>
            <tr class="row">
                <th class="col-sm-2">
                    <input name="studentId" class="form-control" type="text" placeholder="Mã sinh viên">
                </th>
                <th class="col-sm-2">
                    <input name="studentName" class="form-control" type="text" placeholder="Họ tên">
                </th>
                <th class="col-sm-2">
                    <input name="className" class="form-control" type="text" placeholder="Lớp">
                </th>
                <th class="col-sm-2">
                    <input name="contactNumber" class="form-control" type="text" placeholder="Số điện thoại">
                </th>
                <th class="col-sm-2">
                    <input name="dob" class="form-control" type="text" placeholder="Ngày sinh">
                </th>
                <th class="col-sm-2">
                    <input type="submit" class="btn btn-success" value="Lọc" style="padding: 7px 10px; margin: 0px 11px" name="filter">
                </th>
            </tr>
            <?php
            foreach ($students as $row) {
                echo "<tr class='row'>";
                $query = getActionForm('manageStudent.php', $row['id'], true, true, "", true, false, $row['id']);
                echo "<td class='col-sm-2'>$row[id]</td>
                <td class='col-sm-2'>$row[fullName]</td>
                <td class='col-sm-2'>$row[className]</td>
                <td class='col-sm-2'>$row[contactNumber]</td>
                <td class='col-sm-2'>$row[dob]</td>
                <td class='col-sm-2'>$query</td>
                </tr>";
            }
            ?>
        </table>
    </form>
<?php } ?>
