<?php
include '../includes/db_connection.php';


$id = $_POST['id'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE claim SET status_id = ? WHERE id = ?");
$stmt->bind_param("ii", $status, $id);

if ($stmt->execute()) {
    echo $status == 2 ? "✅ Claim Approved." : "❌ Claim Rejected.";
} else {
    echo "❌ Failed to update status.";
}
?>
