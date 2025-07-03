<?php
session_start();
require_once '../includes/db_connection.php'; // Adjust path if needed

header('Content-Type: application/json');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated.']);
    exit;
}

$userId = $_SESSION['user_id'];

// Sanitize and validate input
function getPost($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : null;
}

$firstName     = getPost('first_name');
$lastName      = getPost('last_name');
$fullName      = getPost('full_name');
$dob           = getPost('dob'); // Format: YYYY-MM-DD
$age           = (int) getPost('age');
$nomineeName   = getPost('nominee_full_name');
$nomineeAge    = (int) getPost('nominee_age');
$relationshipId = (int) getPost('nominee_relation');
$isAccepted    = 1; // Already validated on frontend
$comment       = getPost('comment');

$policyId = isset($_POST['policy_id']) ? (int)$_POST['policy_id'] : null;

if (!$policyId) {
    echo json_encode(['success' => false, 'message' => 'Invalid or missing policy ID.']);
    exit;
}

// Step 1: Insert into user_life_policy
$insertPolicySQL = "
    INSERT INTO user_life_policy (life_policy_id, gup_id, status_id, created_date)
    VALUES (?, ?, 1, NOW())
";
$stmtPolicy = $conn->prepare($insertPolicySQL);
$stmtPolicy->bind_param("ii", $policyId, $userId);


if (!$stmtPolicy->execute()) {
    echo json_encode(['success' => false, 'message' => 'Failed to create policy record.']);
    exit;
}

$lifePolicyId = $stmtPolicy->insert_id;

// Step 2: Insert into policy_application_form
$insertAppSQL = "INSERT INTO policy_application_form (
    first_name,
    last_name,
    full_name,
    dob,
    age,
    full_name_nominee,
    age_nominee,
    is_accepted,
    relationship_id_nominee,
    user_life_policy_life_policy_id,
    comment
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmtApp = $conn->prepare($insertAppSQL);
$stmtApp->bind_param(
    "ssssissiiis",
    $firstName,
    $lastName,
    $fullName,
    $dob,
    $age,
    $nomineeName,
    $nomineeAge,
    $isAccepted,
    $relationshipId,
    $lifePolicyId,
    $comment
);

if ($stmtApp->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Application submission failed.']);
}

$stmtPolicy->close();
$stmtApp->close();
$conn->close();
