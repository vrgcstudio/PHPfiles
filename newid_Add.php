<?php
include ('connection.php');

if (isset($_GET['id_stu'])) {
    $id_stu = $_GET['id_stu'];
    $new_id_add = rand();
    $sqlupdate = "UPDATE students SET Id_Add = '$new_id_add' WHERE id_stu = '$id_stu'";
    $updateIDadd = mysqli_query($connect, $sqlupdate);
    if ($updateIDadd) {
        echo "1";
    }
}