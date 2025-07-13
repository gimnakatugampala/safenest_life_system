<?php
include_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['cover_code'];
    $name = $_POST['cover_name'];
    $desc = $_POST['description'];
    $premium = $_POST['premium'];

    $stmt = $conn->prepare("INSERT INTO covers (cover_code, cover_name, description, premium_amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $code, $name, $desc, $premium);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Cover added successfully'); window.location.href='add_cover.php';</script>";
    } else {
        echo "❌ Failed to add cover: " . $stmt->error;
    }
    $stmt->close();
}
?>
