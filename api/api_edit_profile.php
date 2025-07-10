<?php
require_once '../includes/db_connection.php';
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // 1) Update User Profile Details
    if (isset($_POST['full_name'])) {
        $stmt = $conn->prepare("UPDATE user_details SET 
            full_name = ?, dob = ?, phone_number = ?, occupation = ?, address = ?, city = ?, state = ?, province = ?, postal_code = ?, gender_id = ?, country_id = ?
            WHERE general_user_profile_id = ?");

        $stmt->bind_param(
            "ssssssssiiii",
            $_POST['full_name'],
            $_POST['dob'],
            $_POST['phone_number'],
            $_POST['occupation'],
            $_POST['address'],
            $_POST['city'],
            $_POST['state'],
            $_POST['province'],
            $_POST['postal_code'],
            $_POST['gender_id'],
            $_POST['country_id'],
            $user_id
        );

        if (!$stmt->execute()) {
            throw new Exception("Failed to update user details.");
        }

        // Update email in separate table
        $stmt2 = $conn->prepare("UPDATE general_user_profile SET email = ? WHERE id = ?");
        $stmt2->bind_param("si", $_POST['email'], $user_id);

        if (!$stmt2->execute()) {
            throw new Exception("Failed to update email.");
        }

        echo json_encode(['success' => true, 'message' => 'Profile updated']);
        exit;
    }

    // 2) Update Bank Info
    if (isset($_POST['bank_account_no'])) {
        $stmt = $conn->prepare("UPDATE bank_info SET 
            bank_account_no = ?, bank_name = ?, bank_branch_name = ?, bank_account_holder_name = ?
            WHERE user_details_general_user_profile_id = ?");

        $stmt->bind_param(
            "ssssi",
            $_POST['bank_account_no'],
            $_POST['bank_name'],
            $_POST['bank_branch_name'],
            $_POST['bank_account_holder_name'],
            $user_id
        );

        if (!$stmt->execute()) {
            throw new Exception("Failed to update bank info.");
        }

        echo json_encode(['success' => true, 'message' => 'Bank info updated']);
        exit;
    }

    // 3) Upload Cropped Profile Image
    if (isset($_FILES['cropped_image']) && $_FILES['cropped_image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../uploads/profile_images/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileTmpPath = $_FILES['cropped_image']['tmp_name'];
        $fileName = $_FILES['cropped_image']['name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file extension
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        if (!in_array($fileExt, $allowedExtensions)) {
            echo json_encode(['success' => false, 'message' => 'Invalid image format']);
            exit;
        }

        $newFileName = "user_" . $user_id . "_" . time() . "." . $fileExt;
        $destPath = $targetDir . $newFileName;

        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            echo json_encode(['success' => false, 'message' => 'Failed to save uploaded image']);
            exit;
        }

        $relativePath = "uploads/profile_images/" . $newFileName;

        // Update DB
        $stmt = $conn->prepare("UPDATE user_details SET profile_img = ? WHERE general_user_profile_id = ?");
        $stmt->bind_param("si", $relativePath, $user_id);

        if (!$stmt->execute()) {
            // Optionally delete uploaded file on failure
            unlink($destPath);
            echo json_encode(['success' => false, 'message' => 'Failed to update profile image in database']);
            exit;
        }

        // ✅ Set session image to relative path (for consistent frontend usage)
        $_SESSION['user_image'] = $relativePath;

        // Return full URL for frontend preview if needed
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $base = dirname($_SERVER['PHP_SELF'], 2); // goes up 2 levels to get to /safenest_life_system/
        $imageURL = $protocol . "://" . $host . $base . "/" . $relativePath;

        echo json_encode(['success' => true, 'image_url' => $imageURL]);
        exit;
    }

    // If no valid request matched
    echo json_encode(['success' => false, 'message' => 'No valid data received']);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
