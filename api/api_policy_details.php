<?php
require_once '../includes/db_connection.php';   //  mysqli $conn
header('Content-Type: application/json');

$id = intval($_GET['id'] ?? 0);
if (!$id) { echo json_encode(["success"=>false,"message"=>"No policy id"]); exit; }

try {
    /* ─────────────────────────────────────────
       1.  MAIN POLICY
    ───────────────────────────────────────── */
    $stmt = $conn->prepare(
        "SELECT id, policy_name, term_years, premium_amount, coverage_amount,
                min_age, max_age, description
         FROM life_policy
         WHERE id = ? AND is_active = 1"
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $policy = $stmt->get_result()->fetch_assoc();
    if (!$policy) throw new Exception("Policy not found");

    /* ─────────────────────────────────────────
       2.  PICTURES
    ───────────────────────────────────────── */
    $pics = [];
    $sql = "SELECT picture FROM picture_life_policy WHERE life_policy_id = $id";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) $pics[] = $row['picture'];
    if (!$pics) $pics[] = 'uploads/no-image.png';

    /* ─────────────────────────────────────────
       3.  BENEFITS
    ───────────────────────────────────────── */
    $benefits = [];
    $sql = "SELECT benefits FROM benefits_life_policy WHERE life_policy_id = $id";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) $benefits[] = $row['benefits'];

    /* ─────────────────────────────────────────
       4.  RECENT PRODUCTS  (max 3, exclude current)
    ───────────────────────────────────────── */
    $recent = [];
    $sqlRecent = "
        SELECT id, policy_name, term_years, premium_amount
        FROM life_policy
        WHERE is_active = 1 AND id <> $id
        ORDER BY created_at DESC
        LIMIT 3";
    $recRes = $conn->query($sqlRecent);

    while ($row = $recRes->fetch_assoc()) {

        /* first (cover) picture */
        $picRes = $conn->query(
            "SELECT picture FROM picture_life_policy
             WHERE life_policy_id = {$row['id']} LIMIT 1"
        );
        $picRow = $picRes->fetch_assoc();
        $row['image'] = $picRow ? $picRow['picture'] : 'uploads/no-image.png';

        /* up to 7 short benefits */
        $bRes = $conn->query(
            "SELECT benefits FROM benefits_life_policy
             WHERE life_policy_id = {$row['id']} LIMIT 7"
        );
        $row['benefits'] = [];
        while ($b = $bRes->fetch_assoc()) $row['benefits'][] = $b['benefits'];

        $recent[] = $row;
    }

    /* ─────────────────────────────────────────
       5.  OUTPUT
    ───────────────────────────────────────── */
    echo json_encode([
        "success"   => true,
        "policy"    => $policy,
        "pictures"  => $pics,
        "benefits"  => $benefits,
        "recent"    => $recent        // ← NEW!
    ]);
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(["success"=>false,"message"=>$e->getMessage()]);
}
