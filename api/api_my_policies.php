<?php
require_once '../includes/db_connection.php';
session_start(); // Start session if not already started

header('Content-Type: application/json');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not authenticated'
    ]);
    exit;
}

$userId = $_SESSION['user_id'];

$sql = "
    SELECT 
        up.id,
        lp.policy_name,
        CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
        lp.premium_amount,
        lp.coverage_amount,
        CONCAT(lp.min_age, '-', lp.max_age) AS age_limit,
        DATE_FORMAT(up.created_date, '%Y-%m-%d') AS req_date,
        up.status_id
    FROM user_life_policy up
    INNER JOIN life_policy lp ON up.life_policy_id = lp.id
    INNER JOIN general_user_profile u ON up.gup_id = u.id
    WHERE up.status_id = 2 AND up.gup_id = ?
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Database prepare failed'
    ]);
    exit;
}

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'data' => $data
]);

$stmt->close();
$conn->close();
