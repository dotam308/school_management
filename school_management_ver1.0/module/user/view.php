<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'create') {
        echo "<div class='alert alert-success'>Thêm thành công</div>";
    } else if ($action == 'edited') {

        echo "<div class='alert alert-success'>Cập nhật thành công</div>";
    } else if ($action == 'deleted') {

        echo "<div class='alert alert-success'>Xoá thành công</div>";
    } else if ($action == 'deletedRestrict') {

        echo "<script>alert('Không được phép xoá tài khoản này')</script>";
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
?>
<form method='get'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>
            <th>Mã ID</th>
            <th>Ảnh đại diện</th>
            <th>Chức vụ</th>

            <th>Tên đăng nhập</th>
            <th>Tên đại diện</th>
            <th>Action</th>
        </tr>

        <tr>
            <th>
                <input type="text" name="id" class="form-control" placeholder="Mã ID" />
            </th>
            <th>
                <input type="text" name="teacherName" class="form-control" placeholder="Ảnh đại diện" disabled />
            </th>
            <th>
                <input type="text" name="title" class="form-control" placeholder="Chức vụ" />
            </th>

            <th>
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" />
            </th>
            <th>
                <input type="text" name="representName" class="form-control" placeholder="Tên đại diên" />
            </th>
            <th>
                <input type="submit" class="btn btn-success" value="Lọc" style="padding: 7px 10px; margin: 0px 11px" name="filter">
            </th>
        </tr>
<?php
    foreach ($usersAccount as $row) {

        $query = getActionForm('queryOnAccount.php', $row['id']);
        $imgSRC = $row['img-personal'];
        $img = "<img src='$imgSRC' alt='imageUser' id='imgUser'/>"
        ?>
        <tr>
            <td><?=$row['id']?></td>

            <td class="imgDiv"><?=$img?></td>
            <td><?=$row['title']?></td>
            <td><?=$row['username']?></td>
            <td><?= ($row['representName'] == "NULL") ? "" : $row['representName'] ?></td>
            <td><?=$query?></td>
        </tr>
    <?php } ?>

    </table>
</form>
<?php } ?>
<?php

$total_pages = ceil($users->get()->num_rows/ LIMIT);

//$selectObjectFilter = selectElementFrom("temp_teacher", "*", "1");
$pagLink = "<ul class='pagination'>";
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    if ($page > 1) {
    $pagLink .= "<li class='page-item'>
        <a class='page-link'
           href='queryOnAccount.php?type=view&page=" . ($page - 1) . "'>" . 'prev' . "
        </a>
    </li>";
    }
    for ($i=1; $i<=$total_pages; $i++) {
    $pagLink .= "<li class='page-item'>";

        $toLink = "queryOnAccount.php?type=view";

        if (isset($_GET['page']) && $_GET['page'] == $i) {
        $toLink .= "&page=$i";
        $pagLink .= "<a class='page-link active' href='$toLink'>" . $i . "</a>";

        } else {
        $toLink .= "&page=$i";
        $pagLink .= "<a class='page-link' href='$toLink'>" . $i . "</a>";
        }
        $pagLink .= "</li>";
    }
    if ($page < $total_pages) {

    $pagLink .= "<li class='page-item'>
        <a class='page-link'
           href='queryOnAccount.php?type=view&page=" . ($page + 1) . "'>" . 'next' . "
        </a>
    </li>";
    }
    echo $pagLink . "</ul>";
