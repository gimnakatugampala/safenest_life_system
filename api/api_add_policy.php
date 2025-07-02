<?php
require_once '../includes/db_connection.php';   //  $conn  (mysqli)

header('Content-Type: application/json');

try {
    // ────────── COLLECT & SANITISE INPUT ──────────
    $name        = trim($_POST['policy_name'] ?? '');
    $termYears   = (int)($_POST['term_years']        ?? 0);
    $premium     = (float)($_POST['premium_amount']  ?? 0);
    $coverage    = (float)($_POST['coverage_amount'] ?? 0);
    $minAge      = (int)($_POST['min_age']           ?? 0);
    $maxAge      = (int)($_POST['max_age']           ?? 0);
    $desc        = trim($_POST['description']        ?? '');
    $benefits    = $_POST['benefits'] ?? [];
    $isActive    = 1;
    $createdAt   = date('Y-m-d H:i:s');

    // ────────── BASIC SERVER‑SIDE VALIDATION ──────────
    if ($name === '' || $termYears <= 0 || $premium <= 0 || $coverage <= 0) {
        throw new Exception('Incomplete or invalid data.');
    }

    // ────────── DUPLICATE POLICY NAME CHECK ──────────
    $chk = $conn->prepare("SELECT id FROM life_policy WHERE policy_name = ?");
    $chk->bind_param('s', $name);
    $chk->execute();
    $chk->store_result();
    if ($chk->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Policy name already exists."]);
        exit;
    }

    // ────────── INSERT INTO life_policy ──────────
    $stmt = $conn->prepare(
        "INSERT INTO life_policy
         (policy_name, term_years, premium_amount, coverage_amount,
          min_age, max_age, description, is_active, created_at)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        'siddiisss',
        $name, $termYears, $premium, $coverage,
        $minAge, $maxAge, $desc, $isActive, $createdAt
    );
    if (!$stmt->execute()) {
        throw new Exception('Failed to save policy.');
    }
    $policyId = $stmt->insert_id;

    // ────────── INSERT BENEFITS (if any) ──────────
    if (!empty($benefits)) {
        $stmtB = $conn->prepare(
            "INSERT INTO benefits_life_policy (benefits, life_policy_id)
             VALUES (?, ?)"
        );
        foreach ($benefits as $b) {
            $benefit = trim($b);
            if ($benefit !== '') {
                $stmtB->bind_param('si', $benefit, $policyId);
                $stmtB->execute();
            }
        }
    }

    // ────────── HANDLE IMAGE UPLOADS ──────────
    $uploadDir = '../uploads/policies/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    if (!empty($_FILES['images']['name'][0])) {
        $stmtP = $conn->prepare(
            "INSERT INTO picture_life_policy (picture, life_policy_id)
             VALUES (?, ?)"
        );
        foreach ($_FILES['images']['name'] as $i => $fileName) {
            if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                $tmp  = $_FILES['images']['tmp_name'][$i];
                $ext  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) continue;

                $new  = uniqid('pol_', true) . '.' . $ext;
                $dest = $uploadDir . $new;

                if (move_uploaded_file($tmp, $dest)) {
                    $relative = 'uploads/policies/' . $new;
                    $stmtP->bind_param('si', $relative, $policyId);
                    $stmtP->execute();
                }
            }
        }
    }

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>
