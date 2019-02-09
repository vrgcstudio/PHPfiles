<?php
require_once(__DIR__ . '/../loader.php');

$request = json_decode(file_get_contents('php://input'));

if(!is_object($request) ||!isset($request->lat_car)||!isset($request->lng_car)){
    http_response_code(400); exit;
}
$driver_update = db_get_record('drivers', ['id' => $request->id_driver]);
if (!$driver_update ) {
    http_response_code(404);
    exit;
}

$driver_update = new stdClass();
$driver_update->id_driver = $request->id_driver;
$driver_update->lat_gps = $request->lat_gps;
$driver_update->lng_gps = $request->lng_gps;


if (!db_update_records('driver', $driver_update)) {
    http_response_code(500);
    exit;
}