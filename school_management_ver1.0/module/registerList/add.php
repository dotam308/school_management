<?php
global $conn;
$myTable = REGISTER_TABLE;

$selectClass = createSelectClasses();
?>
<form method='post' action='#'>
    <table style='width:100%' class='table'>
    <tr>
    <th>Họ tên</th>
    <th>Lớp</th>
    <th>Số điện thoại</th>
    <th>Ngày sinh</th>

    </tr>
    <tr>
    <td><input type='text' name='fullName'/></td>
    <td><?=$selectClass?></td>
    <td><input type='text' name='contactNumber'/></td>
    <td><input type='date' name='dob'/></td>

    </tr>

    </table>
    <button type='submit' class="btn btn-primary">Hoàn tất</button>
    </form>
<?php
if (isset($_POST['fullName'])) {
    $sqlInsert = "INSERT INTO `$myTable` (`id`, `fullname`, `classId`, `contactNumber`, `dob`)
        VALUES (NULL, '$_POST[fullName]', '$_POST[selectedClass]', '$_POST[contactNumber]', '$_POST[dob]')";
    $result = $conn->query($sqlInsert);
    return $result;
}