<?php
require 'connection.php';

$status = $_POST['status'];

$id_stu = 64;

$sql = "UPDATE stuincar SET status_stu='$status' WHERE id_stu = '$id_stu'";

$result = mysqli_query($connect,$sql);
