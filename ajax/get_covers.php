<?php
include_once '../includes/db_connection.php';

header('Content-Type: application/json');
error_reporting(0);

// Query updated columns
$sql = "SELECT id, cover_code, cover_name, description, premium_amount FROM covers ORDER BY cover_name ASC";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => 'Database query error: ' . $conn->error
    ]);
    exit;
}

$covers = [];
while ($row = $result->fetch_assoc()) {
    $covers[] = $row;
}

echo json_encode([
    'success' => true,
    'data' => $covers
]);
exit;
