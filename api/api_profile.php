<?php
require_once '../includes/db_connection.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$general_user_id = $_SESSION['user_id'];

// Get profile data (including profile_img)
$sql = "SELECT 
    gup.email,
    gup.first_name,
    gup.last_name,
    ud.full_name,
    ud.dob,
    ud.phone_number,
    ud.occupation,
    ud.address,
    ud.city,
    ud.state,
    ud.province,
    ud.postal_code,
    ud.profile_img,
    c.country,
    g.gender
FROM general_user_profile gup
JOIN user_details ud ON gup.id = ud.general_user_profile_id
LEFT JOIN gender g ON ud.gender_id = g.id
LEFT JOIN country c ON ud.country_id = c.id
WHERE gup.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $general_user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Add default placeholder if no profile image is set
if (empty($user['profile_img'])) {
    $user['profile_img'] = "vendors/images/photo1.jpg"; // default fallback image
}

// Remove any leading slash from profile_img to avoid URL issues
$user['profile_img'] = ltrim($user['profile_img'], '/');

// Get bank info
$sql = "SELECT 
    bank_account_no,
    bank_name,
    bank_branch_name,
    bank_account_holder_name
FROM bank_info 
WHERE user_details_general_user_profile_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $general_user_id);
$stmt->execute();
$bank = $stmt->get_result()->fetch_assoc();

echo json_encode([
    'user' => $user,
    'bank' => $bank
]);

$stmt->close();
$conn->close();
