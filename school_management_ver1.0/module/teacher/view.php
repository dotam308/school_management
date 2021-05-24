<?php
    $message = null;
    if (isset($_GET['action'])) {

        $action = $_GET['action'];
        if ($action == 'edited') {
            $message = 'Chỉnh sửa thành công';
        }
        if ($action == 'deleted') {
            $message = 'Xoá thành công';
        }
        if ($action == 'created') {
            $message = 'Thêm thành công';
        }

        if (!empty($message)) {
            echo "<div class='alert alert-success'>$message</div>";
        } else {
            echo "<div class='alert alert-danger'>Thao tác thất bại</div>";
        }
    }
    ?>
<div class='row'>
    	<div class='col-md-6'>
    		<h3>Danh sách giáo viên</h3>
    	</div>
    	<div class='col-md-6 text-right'>
    		<a href='manageTeacher.php?type=add'>
    			<button class='btn btn-primary' type='button'>Thêm mới giáo viên</button>
    		</a>
    	</div>
    </div>
<?php
    if (count($teachers) <= 0) {
        echo "0 results";
    } else {
  ?>
    <table style='width: 100%'
    	class='table table-striped table-bordered table-hover'>
	<tr>
		<th>Mã giáo viên
            <a href="manageTeacher.php?type=view&page=1&order=id&direction=ASC"
               class="<?= (checkStatusOrder('id', 'ASC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_upward</i>
            </a>
            <a href="manageTeacher.php?type=view&page=1&order=id&direction=DESC"
               class="<?= (checkStatusOrder('id', 'DESC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_downward</i>
            </a>
        </th>
		<th>Họ tên
            <a href="manageTeacher.php?type=view&page=1&order=fullName&direction=ASC"
               class="<?= (checkStatusOrder('fullName', 'ASC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_upward</i>
            </a>
            <a href="manageTeacher.php?type=view&page=1&order=fullName&direction=DESC"
               class="<?= (checkStatusOrder('fullName', 'DESC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_downward</i>
            </a>
        </th>
		<th>Đơn vị
            <a href="manageTeacher.php?type=view&page=1&order=unit&direction=ASC"
               class="<?= (checkStatusOrder('unit', 'ASC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_upward</i>
            </a>
            <a href="manageTeacher.php?type=view&page=1&order=unit&direction=DESC"
               class="<?= (checkStatusOrder('unit', 'DESC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_downward</i>
            </a>
        </th>
		<th>Số điện thoại
            <a href="manageTeacher.php?type=view&page=1&order=contactNumber&direction=ASC"
               class="<?= (checkStatusOrder('contactNumber', 'ASC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_upward</i>
            </a>
            <a href="manageTeacher.php?type=view&page=1&order=contactNumber&direction=DESC"
               class="<?= (checkStatusOrder('contactNumber', 'DESC')) ? 'activeDir' : '' ?>">
                <i class="material-icons">arrow_downward</i>
            </a>
        </th>
		<th>Action</th>

	</tr>

        <tr>
            <th>
                <input type="text" name="id" placeholder="Mã giáo viên" class="form-control"
                                        value="<?= isset($_POST['id']) ? $_POST['id'] : '' ?>">
            </th>
            <th>
                <input type="text" name="fullName" placeholder="Họ tên"class="form-control"
                                        value="<?= isset($_POST['fullName']) ? $_POST['fullName'] : '' ?>">
            </th>
            <th>
                <input type="text" name="unit" placeholder="Đơn vị"  class="form-control"
                                        value="<?= isset($_POST['unit']) ? $_POST['unit'] : '' ?>">
            </th>
            <th>
                <input type="text" name="contactNumber" placeholder="Số điện thoại" class="form-control"
                                        value="<?= isset($_POST['contactNumber']) ? $_POST['contactNumber'] : '' ?>">
            </th>
            <th><input type="submit" class="btn btn-success"
                                        style="padding: 7px 10px; margin: 0px 11px" name="filter"
                                        value="Lọc"></th>
        </tr>
    <?php
        foreach ($teachers as $row) {

            $query = getActionForm('manageTeacher.php', $row['id']);

            echo "<tr>
                        <td>$row[id]</td>
                        <td>$row[fullName]</td>
                        <td>$row[unit]</td>
                        <td>$row[contactNumber]</td>
                        <td>$query</td>
                </tr>";
        }
        ?>
    </table>
<?php  }

$selectTeachers = selectElementFrom("teacherSelectedList", "*", "1");
$total_pages = ceil($selectTeachers->num_rows/ LIMIT);

//$selectObjectFilter = selectElementFrom("temp_teacher", "*", "1");
$pagLink = "<ul class='pagination'>";
$page = isset($_GET['page']) ? $_GET['page'] : 0;
if ($page > 1) {
    $pagLink .= "<li class='page-item'>
        <a class='page-link' 
                href='manageTeacher.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=" . ($page - 1) . "'>" . 'prev' . "
        </a>
    </li>";
}
for ($i=1; $i<=$total_pages; $i++) {
    $pagLink .= "<li class='page-item'>";

    $toLink = "manageTeacher.php?type=view";

    if (isset($_GET['page']) && $_GET['page'] == $i) {
        $toLink .= "&page=$i";
        if (isset($_GET['order'])) {
            $toLink .= "&order=$_GET[order]&direction=$_GET[direction]";
        }
        $pagLink .= "<a class='page-link active' href='$toLink'>" . $i . "</a>";

    } else {
        $toLink .= "&page=$i";
        if (isset($_GET['order'])) {
            $toLink .= "&order=$_GET[order]&direction=$_GET[direction]";
        }
        $pagLink .= "<a class='page-link' href='$toLink'>" . $i . "</a>";
    }
    $pagLink .= "</li>";
}
    if ($page < $total_pages) {

        $pagLink .= "<li class='page-item'>
        <a class='page-link' 
                href='manageTeacher.php?type=view&direction=$_GET[direction]&order=$_GET[order]&page=" . ($page + 1) . "'>" . 'next' . "
        </a>
    </li>";
    }
echo $pagLink . "</ul>";

