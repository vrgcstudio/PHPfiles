<?php
require_once(__DIR__ . '/../loader.php');

$request = json_decode(file_get_contents('php://input'));

$student = db_get_records('students', [], 'id');

$id = $_GET['id'];

$item = db_get_record('items', ['id' => $id]);
if (!$item) {
    http_response_code(404);
    exit;
}

echo json_encode($item);