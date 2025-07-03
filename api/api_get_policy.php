<?php
header('Content-Type: application/json');

// Include database connection
require_once '../includes/db_connection.php';

if (!isset($_GET['policy_id']) || !is_numeric($_GET['policy_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid or missing policy_id'
    ]);
    exit;
}

$policy_id = intval($_GET['policy_id']);

try {
    $stmt = $conn->prepare("
        SELECT policy_name, term_years, premium_amount, min_age, max_age 
        FROM life_policy 
        WHERE id = ? AND is_active = 1
    ");
    $stmt->bind_param("i", $policy_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $policy = [
            'plan' => $row['policy_name'],
            'term' => $row['term_years'] . ' Years',
            'premium' => 'LKR ' . number_format($row['premium_amount'], 2) . ' / month',
            'eligibility' => $row['min_age'] . '–' . $row['max_age']
        ];

        echo json_encode([
            'success' => true,
            'policy' => $policy
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Policy not found'
        ]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
