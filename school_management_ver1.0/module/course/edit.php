<form method='post' action='#'>
    <table style='width:100%' class='table'>
        <tr class='row'>
            <th class='col-sm-3'>Mã ID</th>
            <td><input class='form-control' type='text' name='id1' value='<?= $oldData['id'] ?>' disabled/>

            </td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Số tín</th>
            <td><input class='form-control' type='text' name='credit' value='<?= $oldData['credit'] ?>'/></td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Mã khoá học</th>
            <td><input class='form-control' type='text' name='courseCode' value='<?= $oldData['courseCode'] ?>'/></td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Tên khoá học</th>
            <td><input class='form-control' type='text' name='courseName' value='<?= $oldData['courseName'] ?>'/></td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Mã lớp môn học</th>
            <td><input class='form-control' type='text' name='courseClassCode'
                       value='<?= $oldData['courseClassCode'] ?>'/></td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Sĩ số tối đa</th>
            <td><input class='form-control' type='text' name='maxStudent' value='<?= $oldData['maxStudent'] ?>'/></td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Giáo viên</th>
            <td><?= $selectTeachers ?></td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Bắt đầu</th>
            <td><input class='form-control' type='text' name='startTime' value='<?= $oldData['startTime'] ?>'/></td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Kết thúc</th>
            <td><input class='form-control' type='text' name='endTime' value='<?= $oldData['endTime'] ?>'/></td>
        </tr>
        <tr class='row'>
            <th class='col-sm-3'>Địa điểm</th>
            <td><input class='form-control' type='text' name='place' value='<?= $oldData['place'] ?>'/></td>

        </tr>
    </table>
    <button type='submit' class='btn btn-primary'>Hoàn tất</button>
</form>