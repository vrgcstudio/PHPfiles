<?php
require_once(__DIR__ . '/../loader.php');


// if (!isset($_GET['id'])) {
//     http_response_code(400);
//     exit;
// }

// $id_stu = $_GET['id'];
$id_stu = '64';

$result = db_get_record('stuincar', ['id_stu' => $id_stu]);

if (!$result) {
    http_response_code(404);
    exit;
}

echo json_encode($result);
