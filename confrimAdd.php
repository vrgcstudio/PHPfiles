<?php
include ('connection.php');

$id_stu = $_GET['id_stu'];
$id_par = $_GET['id_par'];

$sqlInFamily = "INSERT INTO family (id_stu,id_par) VALUES ('$id_stu','$id_par')";
$InsertFamily = mysqli_query($connect, $sqlInFamily);
if ($InsertFamily) {
    $sqlClearAdd = "DELETE FROM confirmadd WHERE id_stu = '$id_stu' AND id_par = '$id_par'";
    $ClearAdd = mysqli_query($connect, $sqlClearAdd);
    echo '2';
}