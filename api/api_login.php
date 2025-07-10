<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/db_connection.php';  // provides $conn

$response = ['success' => false];

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validate input
if (empty($email) || empty($password)) {
    $response['message'] = 'Email and password are required.';
    echo json_encode($response);
    exit;
}

try {
    // Fetch user record
    $stmt = $conn->prepare("SELECT * FROM general_user_profile WHERE email = ? AND user_status_id = 1 LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        // Set user session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['full_name'] = $user['first_name'];
        $_SESSION['user_type'] = $user['gup_type_id'];

        // Default relative path for fallback image
        $defaultImagePath = 'vendors/images/photo1.jpg';

        // Check if user has a profile image
        $stmt2 = $conn->prepare("SELECT profile_img FROM user_details WHERE general_user_profile_id = ?");
        $stmt2->bind_param("i", $_SESSION['user_id']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows === 1) {
            $row = $result2->fetch_assoc();
            $profileImgPath = $row['profile_img']; // e.g., 'uploads/profile_images/user_6_1752055001.jpg'

            // Check if file exists on disk
            $physicalPath = $_SERVER['DOCUMENT_ROOT'] . '/safenest_life_system/' . ltrim($profileImgPath, '/');

            if (!empty($profileImgPath) && file_exists($physicalPath)) {
                $_SESSION['user_image'] = $profileImgPath;
            } else {
                $_SESSION['user_image'] = $defaultImagePath;
            }
        } else {
            $_SESSION['user_image'] = $defaultImagePath;
        }
        $stmt2->close();

        echo json_encode(['success' => true]);
        exit;
    } else {
        $response['message'] = 'Invalid email or password.';
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    $response['message'] = 'Server error. Please try again later.';
}

$conn->close();
echo json_encode($response);
