<?php
include ('connection.php');

if (isset($_GET['id_stu'])) {
    $id_stu = $_GET['id_stu'];
    $id_par = $_GET['id_par'];
    $sqlAdd = "INSERT INTO confirmadd (id_stu,id_par,status_add) VALUES ('$id_stu','$id_par','waitconfirm')";
    $Addstudent = mysqli_query($connect, $sqlAdd);
}