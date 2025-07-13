<?php
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

// Validate cover ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid cover ID.');
}

$cover_id = (int) $_GET['id'];

// Handle POST (update cover)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cover_code = $conn->real_escape_string($_POST['cover_code']);
    $cover_name = $conn->real_escape_string($_POST['cover_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $premium_amount = floatval($_POST['premium_amount']); // numeric only

    $update_sql = "UPDATE covers SET 
        cover_code = '$cover_code',
        cover_name = '$cover_name',
        description = '$description',
        premium_amount = $premium_amount
        WHERE id = $cover_id";

    if ($conn->query($update_sql)) {
        echo "<script>alert('Cover updated successfully'); window.location.href='all_covers.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating cover: " . addslashes($conn->error) . "');</script>";
    }
}

// Fetch cover details
$sql = "SELECT * FROM covers WHERE id = $cover_id LIMIT 1";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    die('Cover not found.');
}

$cover = $result->fetch_assoc();
?>

<body>
    <?php include_once '../includes/sub_header.php'; ?>
    <?php include_once '../includes/sidebar.php'; ?>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <h4>Edit Cover</h4>
                </div>

                <div class="card-box mb-30 p-4">
                    <form id="editCoverForm" action="" method="POST">
                        <div class="form-group mb-3">
                            <label>Cover Code</label>
                            <input type="text" name="cover_code" class="form-control" required
                                value="<?= htmlspecialchars($cover['cover_code']) ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label>Cover Name</label>
                            <input type="text" name="cover_name" class="form-control" required
                                value="<?= htmlspecialchars($cover['cover_name']) ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control"
                                rows="3"><?= htmlspecialchars($cover['description']) ?></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label>Premium Amount (LKR)</label>
                            <input type="number" name="premium_amount" step="0.01" min="0" class="form-control" required
                                value="<?= htmlspecialchars($cover['premium_amount']) ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Cover</button>
                        <a href="all_covers.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php include_once '../includes/footer.php'; ?>
</body>