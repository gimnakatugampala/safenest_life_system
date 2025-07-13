<?php
include_once '../includes/db_connection.php';

header('Content-Type: application/json');
error_reporting(0);

// Allow DELETE method via raw input
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get DELETE body
parse_str(file_get_contents("php://input"), $data);
$id = isset($data['id']) ? intval($data['id']) : 0;

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid cover ID']);
    exit;
}

$sql = "DELETE FROM covers WHERE id = $id";
if ($conn->query($sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Delete failed: ' . $conn->error]);
}
exit;
