<?php
require_once(__DIR__ . '/../loader.php');

$request = json_decode(file_get_contents('php://input'));

if(!is_object($request) ||!isset($request->name)||!isset($request->status)){
    http_response_code(400); exit;
}
if($request->status == 'driver'){
    $driver =new stdClass();
    $driver->id = $request->id;
    $driver->name = $request->name;
    $driver->status = $request->status; 
    $driver->lat_origin = $request->lat_origin; 
    $driver->lng_origin = $request->lng_origin; 
    $driver->lat_destination = $request->lat_destination;
    $driver->lng_destination = $request->lng_destination;
    
    $driverID = db_insert_record('drivers',$driver);
    if(!$driverID){
        http_response_code(500); exit;
    }
    echo json_encode($driverID);
    // echo json_encode($request->lat_origin);
}

if($request->status == 'student'){
    $student =new stdClass();
    $student->id = $request->id;
    $student->name = $request->name;
    $student->status = $request->status; 
    $student->lat = $request->lat; 
    $student->lng = $request->lng; 
    
    $studentID = db_insert_record('students',$student);
    if(!$studentID){
        http_response_code(500); exit;
    }
    echo json_encode($studentID);
    // echo json_encode($request->lat_origin);
}

