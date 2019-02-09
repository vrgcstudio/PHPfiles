<!doctype html>
<html>
<head>
	<meta charset = "utf-8">
	<meta name = "viewport" content = "width=device-width, inital-scale=1">
	<link rel = "stylesheet" type = 'text/css' href = '../css/bootstrap.min.css'>
	<link rel = 'stylesheet' type = 'text/css' href = '../css/bootstrap-theme.min.css'>
	<link rel="stylesheet" type="text/css" href= '../css/style_pack.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>School Route - เพิ่มรูปภาพโปรไฟล์</title>
</head>
	
<body id="Login_Background" style="background-color: lavender">
	<div class="row">
	    <div class="col-sm-3"></div>
		<div class="col-sm-6" style="background-color: #ffffff">
		<br>
		<h1>เพิ่มรูปภาพโปรไฟล์ </h1><h3><span class="badge badge-pill badge-danger">สำหรับสมาชิกเท่านั้น!</span></h3>
			<br>
            <form action="../insert_imgprofile.php" method="POST" enctype="multipart/form-data">
                <h3>กรอกข้อมูลเพื่อยืนยันการเปลี่ยน <i class="fa fa-lock"></i><br></h3>
                <input id="inputemail" type="text" name="email" placeholder="Email" class="form-control" required><br>
                <input id="inputpassword" type="password" name="password" placeholder="Password" class="form-control" required><br>
				<br><h3>เลือกรูปภาพ <i class="fa fa-user-circle"></i><br></h3>
                <input type="file" name="stem_filename" required><br><br>
                <button type="submit" class="btn btn-primary btn-block">เพิ่ม</button>
			</form><br>
		</div>
		<div class="col-sm-3"></div>
	</div>
</body>
</html>