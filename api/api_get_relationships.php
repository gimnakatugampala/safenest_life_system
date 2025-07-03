<?php
header('Content-Type: application/json');
require_once '../includes/db_connection.php';

try {
    $stmt = $conn->prepare("SELECT id, relation FROM relationship");
    $stmt->execute();
    $result = $stmt->get_result();

    $relations = [];
    while ($row = $result->fetch_assoc()) {
        $relations[] = $row;
    }

    echo json_encode([
        'success' => true,
        'data' => $relations
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
