<?php
include ('connection.php');

if (isset($_GET['id_stu'])) {
    $id_stu = $_GET['id_stu'];
    $sqlselect = "SELECT * FROM students WHERE id_stu = '$id_stu'";
    $selectidadd = mysqli_query($connect,$sqlselect);
    if ($selectidadd) {
        $getInfo = mysqli_fetch_array($selectidadd);
        echo $getInfo['Id_Add'];
    }else {
        echo "ระบบเกิดขข้อผิดพลาด";
    }
}