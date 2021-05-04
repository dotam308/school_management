<?php
$selectTeachers = "
<select name='selectTeacher' class='form-control'>
    <option value='' selected>----select----</option>";
    for ($i = 0; $i < count($teachers); $i++) {
    $fullName = $teachers[$i][1];
    $id = $teachers[$i][0];
    $showTeacher = $fullName . "-" . $id;
    $flag = '';
    if ( $oldData['teacherId'] == $id) {
    $flag = 'selected';
    }

    $selectTeachers .= "<option $flag value='$id'>$showTeacher</option>";
    }
    $selectTeachers .= '</select>';
echo " <form method='post' action='#'>
    <table style='width:100%' class='table'>
        <tr>
            <th>Tên lớp</th><td><input class='form-control' type='text' name='className' value='$oldData[className]'/></td>
        </tr>
        <tr>
         <th>Sĩ số tối đa</th><td><input class='form-control' type='text' name='maxStudent' value='$oldData[maxStudent]'/></td>
        </tr>
        <tr>
         <th>Cố vấn học tập</th><td>$selectTeachers</td>
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
if (isset($_POST['className'])) {


$sqlUpdate = "UPDATE `classes`
SET `className`='$_POST[className]',`maxStudent`='$_POST[maxStudent]',
`teacherId`='$_POST[selectTeacher]'
WHERE id='$oldData[id]'";
if ($conn->query($sqlUpdate)) {
    header("location: manageClass.php?type=view&action=edited");
} else {
echo $conn->error . "error at update Course";
}
}