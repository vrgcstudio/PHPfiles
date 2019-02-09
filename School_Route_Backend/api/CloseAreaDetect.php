<?php 
    require_once(__DIR__ . '/../loader.php');

    $request = json_decode(file_get_contents('php://input'));

    if(!is_object($request) ||!isset($request->drilat)||!isset($request->drilng)){
        http_response_code(400); exit;
    }
    // $HomeLat = $_POST("HomeLat");
    // $HomeLng = $_POST("HomeLng");
    $DriLat = $request->drilat;
    $DriLng = $request->drilng;
    
    $HomeLat =  "18.7962058";
    $HomeLng =  "99.0031853";

    // $DriLat = "1.008";
    // $DriLng = "1.008";
    

    

    if ($DriLat <= $HomeLat + 0.018 && $DriLat >= $HomeLat - 0.018 && $DriLng <= $HomeLng + 0.018 && $DriLng >= $HomeLng - 0.018){
        
        if ($DriLat <= $HomeLat + 0.009 && $DriLat >= $HomeLat - 0.009 && $DriLng <= $HomeLng + 0.009 && $DriLng >= $HomeLng - 0.009)
        {
            if ($DriLat <= $HomeLat + 0.0045 && $DriLat >= $HomeLat - 0.0045 && $DriLng <= $HomeLng + 0.0045 && $DriLng >= $HomeLng - 0.0045){
                $sql = "UPDATE stuincar SET status_stu='รถใกล้ถึงเเล้ว' WHERE id_stu = '70'";
                echo"รถใกล้ถึงเเล้ว";
            }
            else{
                $sql = "UPDATE stuincar SET status_stu='อีก 10 นาที' WHERE id_stu = '70'";
                echo"อีก 10 นาที";
            }
        }
        else{
            $sql = "UPDATE stuincar SET status_stu='อีก 30 นาที' WHERE id_stu = '70'";
            echo"อีก 1 ชม";
        }
    }
    else{
        $sql = "UPDATE stuincar SET status_stu='เหลือเวลาเยอะเเยะ' WHERE id_stu = '70'";
        echo"เหลือเวลาเยอะเเยะ";
    }

    $result = mysqli_query($CONNECTION,$sql);