<?php
include_once '../includes/header.php';
include_once '../includes/db_connection.php';

// Auto-generate unique cover code
function generateCoverCode($conn)
{
    do {
        $code = "COV" . rand(100000, 999999);
        $check = $conn->query("SELECT id FROM covers WHERE cover_code = '$code'");
    } while ($check->num_rows > 0);
    return $code;
}

$coverCode = generateCoverCode($conn);
?>

<body>
    <?php include_once '../includes/sub_header.php'; ?>
    <?php include_once '../includes/sidebar.php'; ?>
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box p-4">
                <h4 class="text-blue h4 mb-3">Add New Cover</h4>
                <form action="../ajax/submit_cover.php" method="POST">
                    <div class="form-group">
                        <label>Cover Code</label>
                        <input class="form-control" name="cover_code" value="<?= htmlspecialchars($coverCode) ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Cover Name</label>
                        <input class="form-control" name="cover_name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Premium Amount</label>
                        <input class="form-control" type="number" name="premium" step="0.01" min="0" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Add Cover</button>
                </form>
            </div>
        </div>
    </div>
</body>

<?php include_once '../includes/footer.php'; ?>