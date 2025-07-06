<?php
include '../includes/db_connection.php';


$id = $_POST['id'];
$stmt = $conn->prepare("SELECT * FROM claim WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "<strong>Claim Code:</strong> {$row['code']}<br>";
    echo "<strong>Amount:</strong> Rs. {$row['req_amount']}<br>";
    echo "<strong>Comment:</strong> {$row['cus_comment']}<br>";
    echo "<strong>Prescription:</strong> <a href='../{$row['Prescriptions_file']}' target='_blank'>View</a><br>";
    echo "<strong>Bills:</strong> <a href='../{$row['Bills_Cash_Receipts_file']}' target='_blank'>View</a><br>";
    echo "<strong>Diagnosis Ticket:</strong> <a href='../{$row['Diagnosetic_Ticket_file']}' target='_blank'>View</a><br>";
    echo "<strong>Other Files:</strong> <a href='../{$row['Other_file']}' target='_blank'>View</a><br>";
} else {
    echo "❌ Claim not found.";
}
?>
