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



// output data of each row
    echo "
<form method='get'>
    <table style='width:100%; text-align: left' class='table table-striped table-bordered table-hover'>
        <tr>";

    echo "<th>Mã ID</th>
            <th>Chức vụ</th>

            <th>Tên đăng nhập</th>
            <th>Tên đại diện</th>
            <th>Ảnh đại diện(source)</th>
            <th>Action</th>
        </tr>";

    foreach ($usersAccount as $row) {

        $query = getActionForm('queryOnAccount.php', $row['id']);
        $imgSRC = $row['img-personal'];?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=$row['title']?></td>
            <td><?=$row['username']?></td>
            <td><?= ($row['representName'] == "NULL") ? "" : $row['representName'] ?></td>
            <td><?= ($imgSRC == "NULL") ? "" : $imgSRC?></td>
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
