<?php
include ('connection.php');
if (isset($_GET['id_stu'])) {
    $id_stu = $_GET['id_stu'];
    $time = date("d-m-Y");

    $sqlcheck = "SELECT * FROM cancelvan WHERE id_stu='$id_stu' and time='$time'";
    $checkcancel = mysqli_query($connect, $sqlcheck);
    $getNumAccount = mysqli_num_rows($checkcancel);
    $getInfo = mysqli_fetch_array($checkcancel);

    if ($getNumAccount > 0) {
        echo $getInfo['cancel_status'];
    }else {
        echo "1";
    }
}
