<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/db_connection.php';  // provides $conn

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	$response['message'] = 'Invalid request method.';
	echo json_encode($response);
	exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
	$response['message'] = 'Email and password are required.';
	echo json_encode($response);
	exit;
}

try {
	// Prepare statement
	$stmt = $conn->prepare("SELECT * FROM general_user_profile WHERE email = ? AND user_status_id = 1 LIMIT 1");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();

	if ($user && password_verify($password, $user['password'])) {
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['user_email'] = $user['email'];
		$_SESSION['first_name'] = $user['first_name'];
		$_SESSION['user_type'] = $user['gup_type_id'];  // store user type

		echo json_encode(['success' => true]);
		exit;
	} else {
		$response['message'] = 'Invalid email or password.';
	}
} catch (Exception $e) {
	// Log error safely, then send generic message
	error_log($e->getMessage());
	$response['message'] = 'Server error. Please try again later.';
}

echo json_encode($response);
