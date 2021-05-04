<?php
global $conn;
$myTable = REGISTER_TABLE;
if (isset($_POST['filter'])) {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    $result = filterRegisterList();
} else {
    $result = selectElementFrom("$myTable", "*", "1");
}
?>
<?php
if ($result->num_rows <= 0) {
echo "0 results";
} else {
    ?>
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
            <td class="col-sm-2"><input type="submit" class="btn btn-info"
                       style="padding: 7px 10px; margin: 0px 11px" name="filter"
                       value="Lọc"></td>

        </tr>
<?php
        while ($row = $result->fetch_assoc()) {
        echo "<tr class='row'>";
//            $selectClass = selectElementFrom('classes', "*", "studentId = $row[studentId] AND courseId = $row[]")

            //             $sqlFindClassNameThroughId = "SELECT `className` FROM `classes` WHERE `id` = '$row[classId]'";
            $queryStudent = selectElementFrom('students', "*", "id='$row[studentId]'");

            $rowStudent = $queryStudent->fetch_assoc();

            $classId = $rowStudent['classId'];

            $queryClass = selectElementFrom('classes', "*", "id='$classId'");
            $thisClass = $queryClass->fetch_assoc();
            $className = $thisClass['className'];

            $queryCourse = selectElementFrom('courses', "*", "id='$row[courseId]'");
            $rowCourse = $queryCourse->fetch_assoc();


            $query = getActionForm('manageRegister.php', $row['studentId'], false, true,
                "$rowCourse[id]",true, false, $row['studentId']);
            echo "<td class='col-sm-1'>$row[studentId]</td>
            <td class='col-sm-2'>$rowStudent[fullName]</td>
            <td class='col-sm-1'>$className</td>
            <td class='col-sm-1'>$rowCourse[courseCode]</td>
            <td class='col-sm-2'>$rowCourse[courseName]</td>
            <td class='col-sm-2'>$rowCourse[courseClassCode]</td>
            <td class='col-sm-1'>$rowCourse[credit]</td>
            <td class='col-sm-2'>$query</td>

        </tr>";
        }

        echo "
    </table>
</form>";
}