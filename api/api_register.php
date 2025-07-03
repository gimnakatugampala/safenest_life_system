<?php
session_start();
require_once '../includes/db_connection.php'; // Update path if needed

header('Content-Type: application/json');

try {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $full_name = $_POST['full_name'];
    $gender_id = $_POST['gender']; // 1 = Male, 2 = Female
    $city = $_POST['city'];
    $state = $_POST['state'];

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT id FROM general_user_profile WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email already exists"]);
        exit;
    }

    // Insert into general_user_profile
    $stmt1 = $conn->prepare("INSERT INTO general_user_profile (email, password, first_name, last_name, gup_type_id, user_status_id) VALUES (?, ?, '', '', 1, 1)");
    $stmt1->bind_param("ss", $email, $password);
    $stmt1->execute();
    $profile_id = $stmt1->insert_id;

    // Insert into user_details
    $stmt2 = $conn->prepare("INSERT INTO user_details (full_name, city, state, gender_id, general_user_profile_id) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssii", $full_name, $city, $state, $gender_id, $profile_id);
    $stmt2->execute();

    // Store user info in session
    $_SESSION['user_id'] = $profile_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['full_name'] = $full_name; // assuming full_name can be used here
    $_SESSION['user_type'] = 1; // fixed gup_type_id for registration

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
