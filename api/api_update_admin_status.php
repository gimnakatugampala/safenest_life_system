<?php
header('Content-Type: application/json');
include_once '../includes/db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'] ?? null;
$status = $data['user_status_id'] ?? null;

if (!$id || !$status) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$sql = "UPDATE general_user_profile SET user_status_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $status, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Admin status updated']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update status']);
}
?>
