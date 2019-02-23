<?php  
	include ('connection.php');

	$grade = $_GET['grade'];
    $classroom = $_GET['classroom'];

    if ($grade == "all"){
        $sql  = "SELECT * FROM prc ORDER BY grade,classroom,num ASC";
    }
    else if ($classroom == "all"){
		$sql = "SELECT * FROM prc WHERE grade = '$grade' ORDER BY grade,classroom,num ASC";
	}
	else{
		$sql = "SELECT * FROM prc WHERE grade = '$grade' and classroom = '$classroom' ORDER BY grade,classroom,num ASC";
	}
    
	
	$result = mysqli_query($connect,$sql);

	if ($result) {
		echo"<table style='border: 1px solid black; border-collapse: collapse;'>";
            echo"<tr style='border: 1px solid black; border-collapse: collapse; '>";
				echo"<th style='border: 1px solid black; border-collapse: collapse;'>เลขที่</th>";
				echo"<th style='border: 1px solid black; border-collapse: collapse;'>ชั้น</th>";
				echo"<th style='border: 1px solid black; border-collapse: collapse;'>คำนำหน้าชื่อ</th>";
				echo"<th style='border: 1px solid black; border-collapse: collapse;'>ชื่อจริง</th>";
				echo"<th style='border: 1px solid black; border-collapse: collapse;'>นามสกุล</th>";
				echo"<th style='border: 1px solid black; border-collapse: collapse;'>สถานะ</th>";
            echo"</tr>";  
			while ($row = mysqli_fetch_array($result)) {
				echo"<tr style='border: 1px solid black; border-collapse: collapse;'>";
                    echo"<th style='border: 1px solid black; border-collapse: collapse;'>".$row['num']."</th>";
					echo"<th style='border: 1px solid black; border-collapse: collapse;'>".$row['grade'].'/'.$row['classroom']."</th>";
					echo"<th style='border: 1px solid black; border-collapse: collapse;'>".$row['prename']."</th>";
					echo"<th style='border: 1px solid black; border-collapse: collapse;'>".$row['fname']."</th>";
					echo"<th style='border: 1px solid black; border-collapse: collapse;'>".$row['lname']."</th>";
					echo"<th style='border: 1px solid black; border-collapse: collapse;'>".$row['status']."</th>";
                echo"</tr>";
			}
		echo"</table>";
	}else{
		echo "ฐานข้อมูลผิดพลาด";
	}
