<?php
require_once(__DIR__ . '/../loader.php');

$request = json_decode(file_get_contents('php://input'));

$car_id = $request->$car_id; ////*** ยิง id ของรถเข้ามาเพื่อรับเรียงรายชื่อนักเรียน */

$incar = db_get_records_array('stuincar',[], 'id_car');
$incarJson = json_encode($incar);
$newIncar = json_decode($incarJson,true);

$incarlength = count($incar);
$count_stu_incar = 0;
$idStuInCar = array();///////////  id stu

for($i=0;$i<$incarlength;$i++){
    if($newIncar[$i]["id_car"] === $car_id){
        $count_stu_incar++;
        array_push($idStuInCar,$newIncar[$i]["id_stu"]);
    }
}
///////////////////******   student lat lng   */
$stu = db_get_records_array('students',[], 'id');
$stu_json = json_encode($stu);
$newstu = json_decode($stu_json,true);

$count_all_stu = count($stu);

$stu_lat = array();////****  lat stu arr */
$stu_lng = array();////****  lng stu arr */

for($i=0;$i<$incarlength;$i++){
    $check = false;
    $j = 0;
    while(!$check){
        if($newstu[$i]["id"] === $idStuInCar[$j]){
            array_push($stu_lat,$newstu[$i]["lat"]);
            array_push($stu_lng,$newstu[$i]["lng"]);
            $check = true;
        }
        else if($j === $count_stu_incar-1){
            $check = true;
        }
        $j++;
    }
}

$stu_lat_02 = $stu_lat;
$stu_lng_02 = $stu_lng;

$car =  db_get_records_array('drivers',[], 'id');
$car_json = json_encode($car);
$new_car = json_decode($car_json,true);

$car_length = count($car);

$origin_lat = 0; 
$origin_lng = 0;
$destination_lat = 0;
$destination_lng = 0;

for($i = 0;$i<$car_length;$i++){
    if($new_car[$i]["id"] === $car_id){
          $origin_lat = $new_car[$i]["lat_origin"];
          $origin_lng = $new_car[$i]["lng_origin"];

          $destination_lat = $new_car[$i]["lat_destination"];
          $destination_lng = $new_car[$i]["lng_destination"];
    }
}

sorth_first_direction(); 

function sorth_first_direction(){ 
    $sequence_stu = array();
    $picup_stu = array();
    global $origin_lat,$origin_lng,$stu_lat,$stu_lng,$count_stu_incar,$newstu,$idStuInCar,$stu_lat_02,$stu_lng_02;

    $want_remove=0;
    $spair_lat = $stu_lat[0];
    $spair_lng = $stu_lng[0];
    $distance_01 = abs(($origin_lat - $stu_lat[0]) + ($origin_lng - $stu_lng[0]));
    for($j = 0;$j<$count_stu_incar;$j++){
        $distance_02 = abs(($origin_lat - $stu_lat[$j]) + ($origin_lng - $stu_lng[$j]));
        if($distance_01 > $distance_02){
            $distance_01 = $distance_02;   
            $spair_lat = $stu_lat[$j];
            $spair_lng = $stu_lng[$j];
        }
    }
    $addToSq = serch_id_stu($spair_lat,$spair_lng); 
    array_push($sequence_stu,$addToSq);
    $stu_lat = remove_stu_lat($stu_lat,$spair_lat);
    $stu_lng = remove_stu_lng($stu_lng,$spair_lng);
    $idStuInCar = remove_stu_id($idStuInCar,$addToSq);
    ///**  other round */
    for($i=0;$i<$count_stu_incar-2;$i++){
        
        $lat_origin_left = get_lat($sequence_stu[$i]);
        $lng_origin_left = get_lng($sequence_stu[$i]);
        
        $stu_left = count($idStuInCar);
        
        $want_remove=0;
        $spair_lat = $stu_lat[0];
        $spair_lng = $stu_lng[0];
        
        $distance_03 = abs(($lat_origin_left - $stu_lat[0]) + ($lng_origin_left - $stu_lng[0]));
        for($j=0;$j<$stu_left;$j++){
            $distance_04 = abs(($origin_lat - $stu_lat[$j]) + ($origin_lng - $stu_lng[$j]));
            if($distance_03 > $distance_04){
                $distance_03 = $distance_04;   
                $spair_lat = $stu_lat[$j];
                $spair_lng = $stu_lng[$j];
            }
        }
        $addToSq = serch_id_stu($spair_lat,$spair_lng); 
        array_push($sequence_stu,$addToSq);
        $stu_lat = remove_stu_lat($stu_lat,$spair_lat);
        $stu_lng = remove_stu_lng($stu_lng,$spair_lng);
        $idStuInCar = remove_stu_id($idStuInCar,$addToSq);
    }
    array_push($sequence_stu,$idStuInCar[0]);
    push_sequence($sequence_stu);
}

function find_lat_from_id($stu_lat,$sequence){ 
    $need_check = get_lat($stu_lat,$sequence);
    echo $need_check;
    $stu_lat_length = count($stu_lat);
        for($j = 0;$j<$stu_lat_length;$j++){
            if($need_check == $stu_lat[$j]){
                echo "*/*/";
                return $stu_lat[$j];
            }
        }
}

function serch_id_stu($lat_serch,$lng_serch){
    global $newstu,$count_all_stu,$sequence_stu;
    for($i = 0;$i<$count_all_stu;$i++){
        if($lat_serch === $newstu[$i]["lat"] && $lng_serch === $newstu[$i]["lng"]){
            return $newstu[$i]["id"];
        }
    }
}

function check_pickup($stu_pickup,$need_check){
    $x = count($stu_pickup);
    for($i = 0;$i<$x;$i++){
        if($stu_pickup[$i] == $need_check){
            return true;
        }
    }
    return true;
}

function get_lat($serch){
    global $newstu;
    global $count_all_stu;
    for($i=0;$i<$count_all_stu;$i++){
        if($newstu[$i]["id"] === $serch){
            return $newstu[$i]["lat"];
        }
    }
}

function get_lng($serch){
    global $newstu;
    global $count_all_stu;
    for($i=0;$i<$count_all_stu;$i++){
        if($newstu[$i]["id"] === $serch){
            return $newstu[$i]["lng"];
        }
    }
}


////*** clear arr */
function remove_stu_lat($arr,$want_remove){ /// want to remove must be index
    $new_arr = $arr;
    $x = array_search($want_remove,$arr);
    unset($arr[$x]);
    $new_arr = array_values($arr);
    return $new_arr;
}
function remove_stu_lng($arr,$want_remove){
    $new_arr;
    $x = array_search($want_remove,$arr);
    unset($arr[$x]);
    $new_arr = array_values($arr);
    return $new_arr;
}
function remove_stu_id($arr,$want_remove){
    $new_arr;
    $x = array_search($want_remove,$arr);
    unset($arr[$x]);
    $new_arr = array_values($arr);
    return $new_arr;
}

///*** push to table */
function push_sequence($want_update){
    ////** update to table (order in car) */
}