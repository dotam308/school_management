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
<?php
$selectTeachers = "
<select name='selectTeacher' class='form-control'>
    <option value='' selected>----select----</option>";
for ($i = 0; $i < count($teachers); $i++) {
    $fullName = $teachers[$i][1];
    $id = $teachers[$i][0];
    $showTeacher = $fullName . "-" . $id;
    $flag = '';
    $selectTeachers .= "<option value='$id'>$showTeacher</option>";
}
$selectTeachers .= '</select>';
?>
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
    <td><?=$selectTeachers?></td>
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
    <button class='btn btn-light'><a href='manageCourse.php?type=view'>Back</a></button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
    $sqlInsert = "INSERT INTO `courses` (`id`, `credit`, `startTime`, `endTime`, `place`, `courseCode`, `courseName`, `courseClassCode`, `maxStudent`, `teacherId`)
VALUES (NULL, '$_POST[credit]', '$_POST[startTime]', '$_POST[endTime]', '$_POST[place]', '$_POST[courseCode]', '$_POST[courseName]', '$_POST[courseClassCode]', '$_POST[maxStudent]', '$_POST[selectTeacher]')";

    if ($result = $conn->query($sqlInsert)) {
        if (isset($_POST['create'])) {
            header("location: manageCourse.php?type=view&action=added");
        } else if (isset($_POST['continue'])) {
            header("location: manageCourse.php?type=add&action=added");
        }
    } else {

        header("location: manageCourse.php?type=add&action=failed");
    }
}
