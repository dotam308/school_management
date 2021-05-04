<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'create') {

        echo "<div class='alert alert-success'>Thêm thành công</div>";
    }

}
$selectTeachers = "
<select name='selectTeacher' class='form-control'>
    <option value='' selected>----select----</option>";
for ($i = 0; $i < count($teachers); $i++) {
    $fullName = $teachers[$i][1];
    $id = $teachers[$i][0];
    $showTeacher = $fullName . "-" . $id;
    $selectTeachers .= "<option  value='$id'>$showTeacher</option>";
}
$selectTeachers .= '</select>';
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
        <button class="btn btn-light"><a href="manageClass.php?type=view">Back</a></button>
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

if (isset($_POST['className'])) {

    print_r($_POST);
    $sqlInsert = "INSERT INTO `classes`(`id`, `className`, `maxStudent`, `numOfStudents`, `teacherId`)
VALUES (NULL,'$_POST[className]','$_POST[maxStudent]','0','$_POST[selectTeacher]')";


    if ($result = $conn->query($sqlInsert)) {
        if (isset($_POST['create'])) {
            header("location: manageClass.php?type=view&action=create");
        } else {
            header("location: manageClass.php?type=add&action=create");
        }
    } else {
        echo $conn->error . " error at Add";
    }
}