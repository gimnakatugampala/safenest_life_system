<?php
include '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $policyId = $_POST['policy_id'];
    $amount = $_POST['amount'];
    $comment = $_POST['comment'];

    // Upload files
    function uploadFile($name) {
        if (!empty($_FILES[$name]['name'])) {
            $targetDir = "../uploads/claims/";
            if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
            $filename = uniqid() . "_" . basename($_FILES[$name]["name"]);
            $targetFile = $targetDir . $filename;
            move_uploaded_file($_FILES[$name]["tmp_name"], $targetFile);
            return "uploads/claims/" . $filename;
        }
        return null;
    }

    $prescription = uploadFile('prescription');
    $bills = uploadFile('bills');
    $diagnosis = uploadFile('diagnosis');
    $other = uploadFile('other');

    // Insert claim
    $code = "CLM" . rand(100000, 999999);
    $status_id = 1;

    // Get policy_application_form_id
    $stmt = $conn->prepare("SELECT id FROM policy_application_form WHERE user_life_policy_life_policy_id = ?");
    $stmt->bind_param("i", $policyId);
    $stmt->execute();
    $res = $stmt->get_result();
    $appRow = $res->fetch_assoc();
    $policyAppId = $appRow['id'] ?? null;

    if (!$policyAppId) {
        die("❌ No application found for this policy.");
    }

    $stmt = $conn->prepare("INSERT INTO claim (code, cus_comment, status_id, policy_application_form_id, policy_application_form_user_life_policy_life_policy_id, req_amount, Prescriptions_file, Bills_Cash_Receipts_file, Diagnosetic_Ticket_file, Other_file)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiissssss", $code, $comment, $status_id, $policyAppId, $policyId, $amount, $prescription, $bills, $diagnosis, $other);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Claim submitted successfully.'); window.location.href = '../claims/pending-claim-requests.php';</script>";
    } else {
        echo "❌ Failed to submit claim.";
    }
}
?>
