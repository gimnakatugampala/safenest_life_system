<?php
require_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $policyId = $data['policy_id'] ?? null;

    if ($policyId) {
        $stmt = $conn->prepare("UPDATE user_life_policy SET is_paid = 1 WHERE id = ?");
        $stmt->bind_param("i", $policyId);
        $success = $stmt->execute();
        echo json_encode(['success' => $success]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing policy_id']);
    }
}
