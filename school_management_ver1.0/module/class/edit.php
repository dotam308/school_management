<form method='post' action='#'>
    <table style='width:100%' class='table'>
        <tr>
            <th>Tên lớp</th>
            <td>
                <input class='form-control' type='text' name='className' value='<?=$oldData['className']?>'/>
            </td>
        </tr>
        <tr>
         <th>Sĩ số tối đa</th>
            <td>
                <input class='form-control' type='text' name='maxStudent' value='<?=$oldData['maxStudent']?>'/>
            </td>
        </tr>
        <tr>
         <th>Cố vấn học tập</th>
            <td><?=$teacherModel?></td>
        </tr>
    </table>
    <button type='submit' class='btn btn-primary'>Hoàn tất</button>
</form>