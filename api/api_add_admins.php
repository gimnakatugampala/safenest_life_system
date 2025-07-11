<?php
session_start();
require_once '../includes/db_connection.php';  // Make sure path is correct

header('Content-Type: application/json');

try {
    // Collect and sanitize inputs
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        throw new Exception('Please fill all required fields.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format.');
    }

    if (strlen($password) < 8) {
        throw new Exception('Password must be at least 8 characters.');
    }

    // Check if email already exists in general_user_profile
    $checkStmt = $conn->prepare("SELECT id FROM general_user_profile WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email already registered."]);
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert into general_user_profile
    $stmt = $conn->prepare("INSERT INTO general_user_profile (email, password, first_name, last_name, gup_type_id, user_status_id) VALUES (?, ?, ?, ?, 2, 1)");
    $stmt->bind_param("ssss", $email, $hashedPassword, $first_name, $last_name);

    if (!$stmt->execute()) {
        throw new Exception('Failed to add admin user.');
    }

    $profile_id = $stmt->insert_id;

    // Insert into user_details if needed - here you can add extra info if you want
    // For example, if you have admin-specific details, you can insert here.
    // Skipping for now, but you can add like this:
    // $stmt2 = $conn->prepare("INSERT INTO user_details (general_user_profile_id, ...) VALUES (?, ...)");
    // $stmt2->bind_param("i", $profile_id);
    // $stmt2->execute();

    echo json_encode(["success" => true, "message" => "Admin user added successfully."]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
