<?php
include_once '../includes/db_connection.php';

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

// Validate required inputs
if (
    !isset($data['email'], $data['password'], $data['full_name'], $data['gender']) ||
    empty($data['email']) || empty($data['password']) || empty($data['full_name']) || empty($data['gender'])
) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

// Sanitize and prepare
$email = trim($data['email']);
$password = password_hash($data['password'], PASSWORD_DEFAULT);
$full_name = trim($data['full_name']);
$city = isset($data['city']) ? trim($data['city']) : null;
$state = isset($data['state']) ? trim($data['state']) : null;
$gender = strtolower($data['gender']) === 'male' ? 1 : 2;
$gup_type_id = 2; // customer
$user_status_id = 1; // active

try {
    // 🔍 Check if email already exists
    $check = $conn->prepare("SELECT id FROM general_user_profile WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        http_response_code(409); // Conflict
        echo json_encode(["success" => false, "message" => "Email already registered"]);
        exit;
    }

    // ✅ Insert into general_user_profile
    $stmt1 = $conn->prepare("INSERT INTO general_user_profile (email, password, gup_type_id, user_status_id) VALUES (?, ?, ?, ?)");
    $stmt1->bind_param("ssii", $email, $password, $gup_type_id, $user_status_id);
    $stmt1->execute();
    $profile_id = $stmt1->insert_id;

    // ✅ Insert into user_details
    $stmt2 = $conn->prepare("INSERT INTO user_details (full_name, city, state, gender_id, general_user_profile_id) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssii", $full_name, $city, $state, $gender, $profile_id);
    $stmt2->execute();

    http_response_code(201); // Created
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Server error: " . $e->getMessage()]);
}
