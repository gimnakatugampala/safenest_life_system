<?php
include_once '../includes/db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

try {
    // Required fields check
    $required_fields = ['policy_name', 'term_years', 'premium_amount', 'coverage_amount', 'min_age', 'max_age', 'description'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Field $field is required.");
        }
    }

    // Sanitize inputs
    $policy_name = $conn->real_escape_string($_POST['policy_name']);
    $term_years = (int) $_POST['term_years'];
    $premium_amount = (float) $_POST['premium_amount'];
    $coverage_amount = (float) $_POST['coverage_amount'];
    $min_age = (int) $_POST['min_age'];
    $max_age = (int) $_POST['max_age'];
    $description = $conn->real_escape_string($_POST['description']);

    $conn->begin_transaction();

    // Insert into life_policy
    $sql = "INSERT INTO life_policy 
            (policy_name, term_years, premium_amount, coverage_amount, min_age, max_age, description, is_active, created_at)
            VALUES ('$policy_name', $term_years, $premium_amount, $coverage_amount, $min_age, $max_age, '$description', 1, NOW())";

    if (!$conn->query($sql)) {
        throw new Exception("Error inserting policy: " . $conn->error);
    }

    $policy_id = $conn->insert_id;

    // Images upload
    if (!empty($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $uploadDir = '../uploads/policy_images/';
        if (!is_dir($uploadDir))
            mkdir($uploadDir, 0755, true);

        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $tmpName = $_FILES['images']['tmp_name'][$i];
            $fileName = basename($_FILES['images']['name'][$i]);

            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('policy_' . $policy_id . '_') . '.' . $ext;
            $targetPath = $uploadDir . $newFileName;

            if (move_uploaded_file($tmpName, $targetPath)) {
                $filePathDB = $conn->real_escape_string('uploads/policy_images/' . $newFileName);
                $sqlImg = "INSERT INTO picture_life_policy (picture, life_policy_id) VALUES ('$filePathDB', $policy_id)";
                if (!$conn->query($sqlImg)) {
                    throw new Exception("Error saving image info: " . $conn->error);
                }
            } else {
                throw new Exception("Failed to upload image: $fileName");
            }
        }
    }

    // Insert covers into life_policy_covers
    if (!empty($_POST['covers']) && is_array($_POST['covers'])) {
        $stmtCover = $conn->prepare("INSERT INTO life_policy_covers (life_policy_id, cover_id) VALUES (?, ?)");
        if (!$stmtCover)
            throw new Exception("Prepare failed: " . $conn->error);

        foreach ($_POST['covers'] as $coverId) {
            $coverId = (int) $coverId;
            $stmtCover->bind_param("ii", $policy_id, $coverId);
            if (!$stmtCover->execute()) {
                throw new Exception("Error inserting cover: " . $stmtCover->error);
            }
        }
        $stmtCover->close();
    }

    // Insert benefits into life_policy_benefits
    if (!empty($_POST['benefits']) && is_array($_POST['benefits'])) {
        $stmtBenefit = $conn->prepare("INSERT INTO life_policy_benefits (life_policy_id, benefit_text) VALUES (?, ?)");
        if (!$stmtBenefit)
            throw new Exception("Prepare failed: " . $conn->error);

        foreach ($_POST['benefits'] as $benefit) {
            $benefit = trim($benefit);
            if ($benefit === '')
                continue;
            $stmtBenefit->bind_param("is", $policy_id, $benefit);
            if (!$stmtBenefit->execute()) {
                throw new Exception("Error inserting benefit: " . $stmtBenefit->error);
            }
        }
        $stmtBenefit->close();
    }

    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Policy added successfully.']);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
