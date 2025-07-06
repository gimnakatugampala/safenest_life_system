<?php
include '../includes/db_connection.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    echo "<p class='text-danger'>❌ Invalid claim ID.</p>";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM claim WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "<div class='mb-2'><strong>Claim Code:</strong> " . htmlspecialchars($row['code']) . "</div>";
    echo "<div class='mb-2'><strong>Amount:</strong> Rs. " . number_format((float) $row['req_amount'], 2) . "</div>";
    echo "<div class='mb-2'><strong>Comment:</strong> " . nl2br(htmlspecialchars($row['cus_comment'])) . "</div>";

    // Optional admin comment
    if (!empty($row['admin_comment'])) {
        echo "<div class='mb-2 text-danger'><strong>Admin Comment:</strong> " . nl2br(htmlspecialchars($row['admin_comment'])) . "</div>";
    }

    // Files
    if (!empty($row['Prescriptions_file'])) {
        echo "<div class='mb-1'><strong>Prescription:</strong> <a href='../" . htmlspecialchars($row['Prescriptions_file']) . "' target='_blank'>View</a></div>";
    }
    if (!empty($row['Bills_Cash_Receipts_file'])) {
        echo "<div class='mb-1'><strong>Bills & Receipts:</strong> <a href='../" . htmlspecialchars($row['Bills_Cash_Receipts_file']) . "' target='_blank'>View</a></div>";
    }
    if (!empty($row['Diagnosetic_Ticket_file'])) {
        echo "<div class='mb-1'><strong>Diagnosis Ticket:</strong> <a href='../" . htmlspecialchars($row['Diagnosetic_Ticket_file']) . "' target='_blank'>View</a></div>";
    }
    if (!empty($row['Other_file'])) {
        echo "<div class='mb-1'><strong>Other Files:</strong> <a href='../" . htmlspecialchars($row['Other_file']) . "' target='_blank'>View</a></div>";
    }
} else {
    echo "<p class='text-danger'>❌ Claim not found.</p>";
}
?>