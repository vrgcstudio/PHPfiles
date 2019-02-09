<?php  
	require 'connection.php';

    $school = $_GET['school'];

	$sql = "SELECT first_name_stu,last_name_stu FROM students WHERE school = '$school' ORDER BY first_name_stu ASC";

	$result = mysqli_query($connect,$sql);

	if ($result) {
		while ($row = mysqli_fetch_array($result)) {
		echo $row['first_name_stu']." ".$row['last_name_stu'];
		echo "<br>";
		    if ($row == 0) {
			    echo "ไม่พบข้อมูล";
		    }
		}
	}else{
		echo "ฐานข้อมูลผิดพลาด";
	}

	
