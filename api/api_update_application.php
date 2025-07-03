<?php
require_once '../includes/db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = isset($data['id']) ? (int)$data['id'] : 0;
$status = isset($data['status']) ? (int)$data['status'] : 0;

if ($id <= 0 || !in_array($status, [2, 3])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

$sql = "UPDATE user_life_policy SET status_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $status, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Status updated.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Update failed.']);
}
