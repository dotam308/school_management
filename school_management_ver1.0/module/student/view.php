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
        case "filterFailed":
            echo "<div class='alert alert-danger'>Dữ liệu không tồn tại</div>";
            break;
    }
}
?>
<div class="row">

    <div class="col-sm-6">
        <h3>Danh sách sinh viên</h3>
    </div>
    <div class='col-sm-6 text-right'>
        <div class="btn btn-sm btn-primary">
            <a class='nav-link' href='manageStudent.php?type=add' style="color: white">
                Thêm sinh viên
            </a>
        </div>
    </div>
</div>
<?php

if (count($students) <= 0) {
    echo "0 results";
} else { ?>
    <form method='post' action="#">
        <table style='width: 100%' class='table table-striped table-bordered table-hover'>
            <tr class="row">
                <th class="col-sm-2">Mã sinh viên
                    <a href="manageStudent.php?type=view&page=1&order=id&direction=ASC"
                       class="<?= (checkStatusOrder('id', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageStudent.php?type=view&page=1&order=id&direction=DESC"
                       class="<?= (checkStatusOrder('id', 'DESC')) ? 'activeDir' : '' ?>">
                         <i class="material-icons">arrow_downward</i>
                    </a>
                </th>
                <th class="col-sm-2">Họ tên

                    <a href="manageStudent.php?type=view&page=1&order=fullName&direction=ASC"
                       class="<?= (checkStatusOrder('fullName', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageStudent.php?type=view&page=1&order=fullName&direction=DESC"
                       class="<?= (checkStatusOrder('fullName', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </th>
                <th class="col-sm-2">Lớp

                    <a href="manageStudent.php?type=view&page=1&order=className&direction=ASC"
                       class="<?= (checkStatusOrder('className', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageStudent.php?type=view&page=1&order=className&direction=DESC"
                       class="<?= (checkStatusOrder('className', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </th>
                <th class="col-sm-2">Số điện thoại

                    <a href="manageStudent.php?type=view&page=1&order=contactNumber&direction=ASC"
                       class="<?= (checkStatusOrder('contactNumber', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageStudent.php?type=view&page=1&order=contactNumber&direction=DESC"
                       class="<?= (checkStatusOrder('contactNumber', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </th>
                <th class="col-sm-2">Ngày sinh

                    <a href="manageStudent.php?type=view&page=1&order=dob&direction=ASC"
                       class="<?= (checkStatusOrder('dob', 'ASC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_upward</i>
                    </a>
                    <a href="manageStudent.php?type=view&page=1&order=dob&direction=DESC"
                       class="<?= (checkStatusOrder('dob', 'DESC')) ? 'activeDir' : '' ?>">
                        <i class="material-icons">arrow_downward</i>
                    </a>
                </th>
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
<?php
    $selectStudents = selectElementFrom("students", "*", "1");
    $total_pages = ceil($selectStudents->num_rows / 10);
    $pagLink = "<ul class='pagination'>";
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    if ($page > 1) {
        $pagLink .= "<li class='page-item'>
        <a class='page-link' 
                href='manageStudent.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=".($page - 1)."'>".'prev'."
        </a>
    </li>";
    }
        for ($i=1; $i<=$total_pages; $i++) {

            $pagLink .= "<li class='page-item'>";
            if (isset($_GET['page']) && $_GET['page'] == $i) {
                if (isset($_GET['order'])) {
                    $pagLink .= "<a class='page-link active' href='manageStudent.php?type=view&order=$_GET[order]&direction=$_GET[direction]&page=".$i."'>".$i."</a>";
                } else {
                    $pagLink .= "<a class='page-link active' href='manageStudent.php?type=view&page=".$i."'>".$i."</a>";
                }
            } else {
                if (isset($_GET['order'])) {
                    $pagLink .= "<a class='page-link' href='manageStudent.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=".$i."'>".$i."</a>";
                } else {
                    $pagLink .= "<a class='page-link' href='manageStudent.php?type=view&page=".$i."'>".$i."</a>";
                }
            }
            $pagLink .= "</li>";
        }
    if ($page < $total_pages) {

        $pagLink .= "<li class='page-item'>
        <a class='page-link' 
                href='manageStudent.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=".($page + 1)."'>".'next'."
        </a>
    </li>";
    }
        echo $pagLink . "</ul>";
     }
