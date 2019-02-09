<?php
include ('connection.php');

$id_stu = $_GET['id_stu'];

$sqlAlert = "SELECT * FROM confirmadd INNER JOIN parents ON confirmadd.id_par = parents.id_par WHERE id_stu ='$id_stu' Limit 1 ";
$AlertAdd = mysqli_query($connect, $sqlAlert);
$getNumAccount = mysqli_num_rows($AlertAdd);
$getInfo = mysqli_fetch_array($AlertAdd);

if ($getNumAccount > 0 ) {
    echo $getInfo['first_name_par']." ".$getInfo['last_name_par'].";";
    echo $getInfo['id_par'];
}else{
    echo "0";
}