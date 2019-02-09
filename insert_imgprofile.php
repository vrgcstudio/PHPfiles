<?php
    include 'connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $hash_login_password = hash_hmac('sha256',$password,$salt);

    $sql_checkuser = "SELECT * FROM main WHERE email='$email' AND password='$hash_login_password'";
    $checkuser = mysqli_query($connect, $sql_checkuser);
    $getNumAccount = mysqli_num_rows($checkuser);

    if ($getNumAccount > 0) {
        $imge_ext = pathinfo(basename($_FILES['stem_filename']['name']),PATHINFO_EXTENSION);
        $new_image_name = 'stem_'.uniqid().".".$imge_ext;
        $image_path = "pic_profile/";
        $image_upload_path = $image_path.$new_image_name;
        $success = move_uploaded_file($_FILES['stem_filename']['tmp_name'],$image_upload_path);
        if ($success==false) {
            echo "ไม่สามารถ upload รูปภาพได้";
            exit();
        }
        $sqlinsertpic = "UPDATE main SET pic_profile = '$new_image_name' WHERE email='$email' AND password='$hash_login_password' ";
        $insert_pic = mysqli_query($connect, $sqlinsertpic);
    }else {
        echo "ไม่พบบัญชีผู้ใช้";
    }