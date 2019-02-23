<?php
require 'connection.php';

$status = $_POST['status'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$id_stu = 64;

$sql = "UPDATE stuincar SET status_stu='$status', lat='$lat', lng='$lng' WHERE id_stu = '$id_stu'";

$result = mysqli_query($connect,$sql);
