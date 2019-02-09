<?php
include ('connection.php');

$email = $_POST['email'];
$password = $_POST['password'];
$status = $_POST['status'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$tel = $_POST['tel'];

$salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$hash_login_password = hash_hmac('sha256',$password,$salt);

$sql = "insert into main (email, password, status, pic_profile) values ('$email', '$hash_login_password', '$status' , '')";
$register = mysqli_query($connect, $sql);
if ($register) {
    $sql1 = "SELECT id from main where email='$email' AND password='$hash_login_password'";
    $getid = mysqli_query($connect, $sql1);
    $fetchID = mysqli_fetch_array($getid);
    $id = $fetchID['id'];
    if ($getid) {
        if ($status=="student") {
            $Id_Add = rand();
            $sql2 = "INSERT INTO students (main_id, email_stu, first_name_stu, last_name_stu, gender_stu, bd_stu, address, lat, lon, sick_stu, school, tel_stu, Id_Add) VALUES ('$id', '$email', '$firstname', '$lastname', '$gender', '', '', 0, 0, '', '', '$tel', '$Id_Add')";
            $insertstudent = mysqli_query($connect, $sql2);
        }elseif ($status=="parent") {
            $sql3 = "INSERT INTO parents (main_id, email_par, first_name_par, last_name_par, gender_par, tel_par, tel_par_work) VALUES ('$id', '$email', '$firstname', '$lastname', '$gender', '$tel',0)";
            $insertparent = mysqli_query($connect, $sql3);
        }elseif ($status=="driver") {
            $sql4 = "INSERT INTO driver (main_id, email_dri, first_name_dri, last_name_dri, bd_dri, gender_dri, id_card_dri, tel_dri) VALUES ('$id', '$email', '$firstname', '$lastname', '', '$gender',0, '$tel')";
            $insertdriver = mysqli_query($connect, $sql4);
        }
    }
}else {
    echo "เพิ่มไม่ได้";
}
