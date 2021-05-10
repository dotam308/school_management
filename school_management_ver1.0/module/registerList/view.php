<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'deleted')
        echo '<div class="alert alert-success">Xoá thành công.</div>';
    else
        echo '<div class="alert alert-danger">Xoá thất bại.</div>';
}
if (count($dataRegis) <= 0) {
echo "0 results";
} else {
    ?>
    <h3>Danh sách đăng kí</h3>
<form method='post' action="#">
    <table style='width:100%' class='table table-striped table-bordered table-hover'>
        <tr class="row">

            <th class="col-sm-1">Mã sinh viên</th>
            <th class="col-sm-2">Họ tên</th>
            <th class="col-sm-1">Lớp</th>

            <th class="col-sm-1">Mã môn học</th>
            <th class="col-sm-2">Môn học</th>
            <th class="col-sm-2">Mã lớp môn học</th>
            <th class="col-sm-1">Số tín</th>
            <th class="col-sm-2">Action</th>

        </tr>
        <tr class="row">

            <td class="col-sm-1"><input class="form-control" type="text" name="studentId" placeholder="Mã SV"
                                        value="<?= isset($_POST['studentId'])? $_POST['studentId'] : ''?>"/></td>
            <td class="col-sm-2"><input class="form-control"  type="text" name="studentName" placeholder="Họ tên"
                                        value="<?= isset($_POST['studentName'])? $_POST['studentName'] : ''?>"/></td>
            <td class="col-sm-1"><input class="form-control"  type="text" name="className" placeholder="Lớp"
                                        value="<?= isset($_POST['className'])? $_POST['className'] : ''?>"/></td>

            <td class="col-sm-1"><input class="form-control"  type="text" name="courseCode" placeholder="Mã MH"
                                        value="<?= isset($_POST['courseCode'])? $_POST['courseCode'] : ''?>"/></td>
            <td class="col-sm-2"><input class="form-control"  type="text" name="courseName" placeholder="Môn học"
                                        value="<?= isset($_POST['courseName'])? $_POST['courseName'] : ''?>"/></td>
            <td class="col-sm-2"><input class="form-control"  type="text" name="courseClassCode" placeholder="Mã lớp môn học"
                                        value="<?= isset($_POST['courseClassCode'])? $_POST['courseClassCode'] : ''?>"/></td>
            <td class="col-sm-1"><input class="form-control"  type="text" name="credit" placeholder="Số tín"
                                        value="<?= isset($_POST['credit'])? $_POST['credit'] : ''?>"/></td>
            <td class="col-sm-2"><input type="submit" class="btn btn-success"
                       style="padding: 7px 10px; margin: 0px 11px" name="filter"
                       value="Lọc"></td>

        </tr>
<?php
        foreach ($dataRegis as $row) {
        echo "<tr class='row'>";

            echo "<td class='col-sm-1'>$row[studentId]</td>
            <td class='col-sm-2'>$row[fullName]</td>
            <td class='col-sm-1'>$row[className]</td>
            <td class='col-sm-1'>$row[courseCode]</td>
            <td class='col-sm-2'>$row[courseName]</td>
            <td class='col-sm-2'>$row[courseClassCode]</td>
            <td class='col-sm-1'>$row[credit]</td>
            <td class='col-sm-2'>$row[query]</td>

        </tr>";
        }

        echo "
    </table>
</form>";
}