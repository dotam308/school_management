<?php
$selectTeachers = "
<select name='selectTeacher' class='form-control'>
    <option value='' selected='selected'>----select----</option>";
for ($i = 0; $i < count($teachers); $i++) {
    $fullName = $teachers[$i][1];
    $id = $teachers[$i][0];
    $showTeacher = $fullName . "-" . $id;
    $flag = '';
    if ((isset($selected) && $selected == $id) || $oldData['teacherId'] == $id) {
        $flag = 'selected';
    }

    $selectTeachers .= "<option $flag value='$id'>$showTeacher</option>";
}
$selectTeachers .= '</select>';
echo " <form method='post' action='#'>
    <table style='width:100%' class='table'>
        <tr class='row'>
        <th class='col-sm-3'>Mã ID</th><td><input class='form-control' type='text' name='id1' value='$oldData[id]' disabled/>
                
        </td>
        </tr>
        <tr class='row'>
        <th class='col-sm-3'>Số tín</th><td><input class='form-control' type='text' name='credit' value='$oldData[credit]'/></td>
            </tr>
             <tr class='row'>
        <th class='col-sm-3'>Mã khoá học</th><td><input class='form-control' type='text' name='courseCode' value='$oldData[courseCode]'/></td>
            </tr>
             <tr class='row'>
        <th class='col-sm-3'>Tên khoá học</th><td><input class='form-control' type='text' name='courseName' value='$oldData[courseName]'/></td>
            </tr>
             <tr class='row'>
        <th class='col-sm-3'>Mã lớp môn học</th><td><input class='form-control' type='text' name='courseClassCode' value='$oldData[courseClassCode]'/></td>
            </tr>
             <tr class='row'>
        <th class='col-sm-3'>Sĩ số tối đa</th><td><input class='form-control' type='text' name='maxStudent' value='$oldData[maxStudent]'/></td>
            </tr>
             <tr class='row'>
        <th class='col-sm-3'>Giáo viên</th><td>$selectTeachers</td>
            </tr>
            <tr class='row'>
        <th class='col-sm-3'>Bắt đầu</th><td><input class='form-control' type='text' name='startTime' value='$oldData[startTime]'/></td>
            </tr>
             <tr class='row'>
        <th class='col-sm-3'>Kết thúc</th><td><input class='form-control' type='text' name='endTime' value='$oldData[endTime]'/></td>
            </tr>
             <tr class='row'>
        <th class='col-sm-3'>Địa điểm</th><td><input class='form-control' type='text' name='place' value='$oldData[place]'/></td>

        </tr>";
$sqlFindTeacherNameThroughId = "SELECT `fullName` FROM `teachers` WHERE id ='$oldData[teacherId]'";

$teacherName = $conn->query($sqlFindTeacherNameThroughId)->fetch_all()[0][0];


echo "
    </table>
    <button type='submit' class='btn btn-primary'>Hoàn tất</button>
</form>";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
// Thiết lập mảng lưu lỗi => Mặc định rỗng
    $error = array();
    if (empty($_POST['selectTeacher'])) {
        $error['selectTeacher'] = "Bạn cần chọn giáo viên";
    } else {
        $selected = $_POST['selectTeacher'];
    }
    if (empty($error)) {
    }
}
if (isset($_POST['credit'])) {


    $sqlUpdate = "UPDATE `courses` SET`credit`='$_POST[credit]',`startTime`='$_POST[startTime]',
`endTime`='$_POST[endTime]',`place`='$_POST[place]',`courseCode`='$_POST[courseCode]',`courseName`='$_POST[courseName]',
`courseClassCode`='$_POST[courseClassCode]',`maxStudent`='$_POST[maxStudent]',`teacherId`='$_POST[selectTeacher]' WHERE id='$oldData[id]'";
    if ($conn->query($sqlUpdate)) {
        header("location: manageCourse.php?type=view&action=edited");
    } else {
        echo $conn->error . "error at update Course";
    }
}