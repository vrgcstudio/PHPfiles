<?php
include ('connection.php');
if (isset($_GET['password']) and isset($_GET['id_stu'])) {
    $id_stu = $_GET['id_stu'];
    $password = $_GET['password'];
    $email = $_GET['email'];
    $status = $_GET['status'];
    $time = date("d-m-Y");

    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $hash_login_password = hash_hmac('sha256',$password,$salt);

    $sqlcheck = "SELECT * FROM main WHERE email='$email' and password='$hash_login_password'";
    $checkpassword = mysqli_query($connect, $sqlcheck);
    $getNumAccount = mysqli_num_rows($checkpassword);

    if ($getNumAccount > 0) {
        echo "1";
        $sqlinsert = "INSERT INTO cancelvan (id_stu,cancel_status,time) VALUES ('$id_stu','$status','$time')";
        $insertcancel = mysqli_query($connect, $sqlinsert);
    }else {
        echo "รหัสผ่านไม่ถูกต้อง";
    }
}else {
    echo "ระบบเกิดความผิดพลาด";
}