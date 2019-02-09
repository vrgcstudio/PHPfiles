<?php
include ('connection.php');

if (isset($_GET['IDadd'])) {
    $ID_Add = $_GET['IDadd'];
    $sqlsearch = "SELECT * FROM students WHERE ID_Add = '$ID_Add'";
    $searchStudent = mysqli_query($connect, $sqlsearch);
    $getNumStudent = mysqli_num_rows($searchStudent);
    
    if($getNumStudent > 0){
        $getInfo = mysqli_fetch_array($searchStudent);
        echo $getInfo['first_name_stu']." ".$getInfo['last_name_stu'].";";
        echo $getInfo['id_stu'].";";
        $sqlAdd = "SELECT * FROM confirmadd WHERE id_stu = '$id_stu' AND id_par = '$id_par'";
        $searchAdd = mysqli_query($connect, $sqlAdd);
        $getNumsearchAdd = mysqli_num_rows($searchAdd);
        if ($getNumsearchAdd > 0) {
            echo "2";
        }else {
            $sqlFamily = "SELECT * FROM family WHERE id_stu = '$id_stu' AND id_par = '$id_par'";
            $searchFamily = mysqli_query($connect, $sqlFamily);
            $getNumsearchFamily = mysqli_num_rows($searchFamily);
            if ($getNumsearchFamily > 0) {
                echo "3";
            }
        }
    }else {
        echo "0";
    }
}