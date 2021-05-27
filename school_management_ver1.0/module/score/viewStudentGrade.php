 <?php

 if (isset($_GET['action'])) {
     echo "<div class='alert alert-success'>Cập nhật điểm thành công.</div>";
 }
    ?>
<h3 style='text-align: center; color: red'>Kết quả học tập</h3>;
    <div style='display: flex; margin: 0px 300px'>
                            <div style='margin-right: auto;'>Mã sinh viên: <?= $idStudent?></div>
                            <div> Sinh viên: <?=$studentName?> </div>

                        </div><form  method='post' action='#'>
                                <table class='table table-bordered table-hover table-striped' style='width:  100%;'>
                                    <tr>
                                        <th>Mã môn học</th>
                                        <th>Tên môn học</th>
                                        <th>Số tín</th>
                                        <th>Điểm</th>
                                    </tr>
                                    <?php

    if ($queryStudent) {
        foreach ($queryStudent as $data) {
//            dd($data);
            $courseId = $data['courseId'];
            if (!empty($data['score'])) {

                $scoreOfThisCourse = $data['score'];
                $valueT = $scoreOfThisCourse;
                $sum += $valueT * $data['credit'];
            } else {
                $valueT = 0;
            }

            $toTalCredit += $data['credit'];

            echo "
        	            <tr>
        	            <td>$data[courseCode]</td>
        	            <td>$data[courseName]</td>
        	            <td>$data[credit]</td>";
            global $title;
            if ($title == 'admin') {
                $namePart = "$courseId"."_"."$idStudent";
                echo "<td><input type='text' name='$namePart' style='width: 50px;' value='$valueT'></td>
        	            </tr>";
            } else if ($title == 'student') {
                echo "<td>$valueT</td>
        	            </tr>";
            }

        }

        $res = 0;
        if ($toTalCredit != 0) {
            $avg = $sum / $toTalCredit;
            $res = round($avg, 1);
        }
        echo "Điểm trung bình: $res <br />";
        ?>
        </table> <?php
        global $title;
        if ($title == 'admin') {
            echo '<button type="submit" name="submit" value="submit" class="btn btn-primary">Ghi nhận</button>';
            echo "<a type='submit' class='btn btn-info'
                href='queryOnRegister.php?type=view&for=$idStudent'>Quay lại</a>";

        } else if ($title == 'student') {

            echo "<a type='submit' class='btn btn-info'
               href='process.php'>Quay lại</a>";

        } ?>
        </form>
        <?php
    } else {
        echo "error at GetData";
    }
