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
<h3>Thêm lớp mới</h3>
<form method='post' action='#'>
    <table style='width:100%' class='table'>
        <tr>
            <th>Tên lớp</th>
            <td><input type='text' name='className' class='form-control' placeholder='Tên lớp' autocomplete='off'/>
            </td>
        </tr>
        <tr>
            <th>Sĩ số tối đa</th>
            <td><input type='text' name='maxStudent' class='form-control' placeholder='Sĩ số tối đa'
                       autocomplete='off'/></td>

        </tr>
        <tr>
            <th>Cố vấn học tập</th>
            <td><?= $selectTeachers ?></td>

        </tr>


    </table>
    <div>
        <input type='submit' class='btn btn-sm btn-primary' name="create" value="Tạo">
        <input type='submit' class='btn btn-sm btn-info' name='continue' value="Tạo và tiếp tục">
    </div>
    <input type='submit' class='btn btn-sm btn-dark' name='back' value="Back">
</form>