<?php
include '../includes/db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $policyId = intval($_POST['policy_id'] ?? 0);
    $amount = trim($_POST['amount'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if ($policyId <= 0 || $amount === '' || !is_numeric($amount)) {
        die("❌ Invalid input.");
    }

    // Upload helper
    function uploadFile($field)
    {
        if (!empty($_FILES[$field]['name'])) {
            $targetDir = "../uploads/claims/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $fileName = uniqid() . "_" . basename($_FILES[$field]['name']);
            $targetPath = $targetDir . $fileName;
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $targetPath)) {
                return "uploads/claims/" . $fileName;
            }
        }
        return null;
    }

    // Upload files
    $prescription = uploadFile('prescription');
    $bills = uploadFile('bills');
    $diagnosis = uploadFile('diagnosis');
    $other = uploadFile('other');

    // Generate claim code
    $claimCode = "CLM" . rand(100000, 999999);
    $statusId = 1; // Pending

    // Get policy application form ID based on user_life_policy ID
    $stmt = $conn->prepare("SELECT id FROM policy_application_form WHERE user_life_policy_life_policy_id = ?");
    $stmt->bind_param("i", $policyId);
    $stmt->execute();
    $res = $stmt->get_result();
    $app = $res->fetch_assoc();
    $applicationId = $app['id'] ?? null;
    $stmt->close();

    if (!$applicationId) {
        die("❌ No policy application form found for selected policy.");
    }

    // Insert claim
    $stmt = $conn->prepare("INSERT INTO claim (
        code,
        cus_comment,
        status_id,
        policy_application_form_id,
        policy_application_form_user_life_policy_life_policy_id,
        req_amount,
        Prescriptions_file,
        Bills_Cash_Receipts_file,
        Diagnosetic_Ticket_file,
        Other_file
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssiissssss",
        $claimCode,
        $comment,
        $statusId,
        $applicationId,
        $policyId,
        $amount,
        $prescription,
        $bills,
        $diagnosis,
        $other
    );

    if ($stmt->execute()) {
        echo "<script>alert('✅ Claim submitted successfully.'); window.location.href = '../claims/pending-claim-requests.php';</script>";
    } else {
        echo "❌ Failed to submit claim: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>