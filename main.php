<?php
session_start();
if (isset($_SESSION['email'])){
    echo $_SESSION['status'].";";
    if (isset($_SESSION['Username'])){
        echo $_SESSION['Username'].";";
        if (isset($_SESSION['Tel'])){
            echo $_SESSION['Tel'].";";
            if (isset($_SESSION['password'])){
                echo $_SESSION['password'].";";
                if (isset($_SESSION['id_stu'])){
                    echo $_SESSION['id_stu'];
                }elseif (isset($_SESSION['id_par'])) {
                    echo $_SESSION['id_par'];
                }elseif (isset($_SESSION['id_dri'])) {
                    echo $_SESSION['id_dri'];
                }
                echo ";".$_SESSION['email']. ";".$_SESSION['pic_profile'];
            }
        }
    }
}else {
    echo "ไม่พบข้อมูล กรุณาลองอีกครั้ง";
}
