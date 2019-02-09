<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "schoolroute";

$connect = new mysqli ($server,$username,$password,$db);

mysqli_query($connect,"set character set utf8");