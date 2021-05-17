<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'added') {
        echo "<div class='alert alert-success'>Thêm thành công</div>";
    } else if ($action == 'failed') {
        echo "<div class='alert alert-danger'>Thêm thất bại</div>";
    }
}
?>
<h3>Thêm khoá học</h3>
<form method='post' action='#'>
    <table style='width:100%' class='table'>

        <tr>
            <th>Số tín</th>
            <td><input class='form-control' type='text' name='credit' autocomplete='off'/></td>
        </tr>

        <tr>
            <th>Mã khoá học</th>
            <td><input class='form-control' type='text' name='courseCode' autocomplete='off'/></td>
        </tr>

        <tr>
            <th>Tên khoá học</th>
            <td><input class='form-control' type='text' name='courseName' autocomplete='off'/></td>
        </tr>

        <tr>
            <th>Mã lớp môn học</th>
            <td><input class='form-control' type='text' name='courseClassCode' autocomplete='off'/></td>
        </tr>

        <tr>
            <th>Sĩ số tối đa</th>
            <td><input class='form-control' type='text' name='maxStudent' autocomplete='off'/></td>
        </tr>

        <tr>
            <th>Giáo viên</th>
            <td><?= $selectTeachers ?></td>
        </tr>

        <tr>
            <th>Bắt đầu</th>
            <td><input class='form-control' type='text' name='startTime' autocomplete='off'/></td>
        </tr>

        <tr>
            <th>Kết thúc</th>
            <td><input class='form-control' type='text' name='endTime' autocomplete='off'/></td>
        </tr>

        <tr>
            <th>Địa điểm</th>
            <td><input class='form-control' type='text' name='place' autocomplete='off'/></td>
        </tr>
    </table>
    <div>
        <input type='submit' class='btn btn-sm btn-primary' name="create" value="Tạo">
        <input type='submit' class='btn btn-sm btn-info' name='continue' value="Tạo và tiếp tục">
    </div>
    <input type="submit" class="btn btn-dark" name="back" value="Back"/>
</form>