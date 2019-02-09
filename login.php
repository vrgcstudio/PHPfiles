<?php
include ('connection.php');
session_start();
session_unset(); 

$email = $_POST['email'];
$password = $_POST['password'];

$salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$hash_login_password = hash_hmac('sha256',$password,$salt);

$sql = "SELECT * FROM main WHERE email='$email' and password='$hash_login_password'";
$result = mysqli_query($connect,$sql);

if($result) {
	while ($row = mysqli_fetch_assoc($result)) {
		$_SESSION['email'] = $row['email'];
		$_SESSION['status'] = $row['status'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['pic_profile'] = $row['pic_profile'];
		$id = $row['id'];

		if ($row['status']=="student") {
			$sql1 = "SELECT * FROM students WHERE main_id='$id'";
			$getDataStu = mysqli_query($connect,$sql1);
			if ($getDataStu) {
				while ($row1 = mysqli_fetch_assoc($getDataStu)) {
					$username = $row1['first_name_stu']." ".$row1['last_name_stu'];
					$_SESSION['Username'] = $username;
					$_SESSION['Tel'] = $row1['tel_stu'];
					$_SESSION['id_stu'] = $row1['id_stu'];
				}
			}
		}elseif ($row['status']=="parent") {
			$sql2 = "SELECT * FROM parents WHERE main_id='$id'";
			$getDataPar = mysqli_query($connect,$sql2);
			if ($getDataPar) {
				while ($row2 = mysqli_fetch_assoc($getDataPar)) {
					$username = $row2['first_name_par']." ".$row2['last_name_par'];
					$_SESSION['Username'] = $username;
					$_SESSION['Tel'] = $row2['tel_par'];
					$_SESSION['id_par'] = $row2['id_par'];
				}
			}
		}elseif ($row['status']=="dirver") {
			$sql3 = "SELECT * FROM dirver WHERE main_id='$id'";
			$getDataDir = mysqli_query($connect,$sql3);
			if ($getDataDir) {
				while ($row3 = mysqli_fetch_assoc($getDataDir)) {
					$username = $row3['first_name_dir']." ".$row3['last_name_dir'];
					$_SESSION['Username'] = $username;
					$_SESSION['Tel'] = $row3['tel_dri'];
					$_SESSION['id_dri'] = $row['id_dri'];
				}
			}
		}else {
			
		}
	}
}
else{
	session_destroy();
}
