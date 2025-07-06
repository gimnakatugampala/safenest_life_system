<?php
include '../includes/db_connection.php';

$id = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;
$admin_comment = trim($_POST['admin_comment'] ?? '');

if (!$id || !$status) {
    echo "❌ Invalid request.";
    exit;
}

if ($status == 3 && empty($admin_comment)) {
    echo "❌ Rejection reason is required.";
    exit;
}

if ($status == 3) {
    // Reject with admin comment
    $stmt = $conn->prepare("UPDATE claim SET status_id = ?, admin_comment = ? WHERE id = ?");
    $stmt->bind_param("isi", $status, $admin_comment, $id);
} else {
    // Approve (no comment needed)
    $stmt = $conn->prepare("UPDATE claim SET status_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $id);
}

if ($stmt->execute()) {
    echo $status == 2 ? "✅ Claim Approved." : "❌ Claim Rejected.";
} else {
    echo "❌ Failed to update claim status.";
}
?>