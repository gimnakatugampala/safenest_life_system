<?php
require_once '../includes/db_connection.php';
header('Content-Type: application/json');

// Get and validate ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid or missing application ID'
    ]);
    exit;
}

$sql = "
   SELECT 
        up.id,
        lp.policy_name,
        CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
        lp.premium_amount,
        lp.coverage_amount,
        CONCAT(lp.min_age, '-', lp.max_age) AS age_limit,
        DATE_FORMAT(up.created_date, '%Y-%m-%d') AS req_date,
        up.status_id,
        paf.*
    FROM user_life_policy up
    INNER JOIN life_policy lp ON up.life_policy_id = lp.id
    INNER JOIN general_user_profile u ON up.gup_id = u.id
    INNER JOIN policy_application_form paf ON paf.user_life_policy_life_policy_id = up.id
    WHERE up.id = ?
    LIMIT 1
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: prepare failed'
    ]);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    echo json_encode([
        'success' => true,
        'data' => $data
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Application not found'
    ]);
}

$stmt->close();
$conn->close();
