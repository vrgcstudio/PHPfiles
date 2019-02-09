<?php
require_once(__DIR__ . '/../loader.php');

$request = json_decode(file_get_contents('php://input'));

$car_id = $request->$car_id;

$driver = db_get_record('drivers', ['id' => $request->id_driver]);
if (!$driver) {
    http_response_code(404);
    exit;
}

$lat = $request->lat_gps;
$lng = $request->lng_gps;

echo json_encode($lat);
echo json_encode($lng);