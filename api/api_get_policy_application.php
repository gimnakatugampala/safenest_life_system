<?php
require_once '../includes/db_connection.php';
header('Content-Type: application/json');

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
    WHERE up.status_id = 1 
";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'data' => $data
]);
