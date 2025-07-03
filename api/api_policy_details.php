<?php
require_once '../includes/db_connection.php';    //  mysqli $conn
header('Content-Type: application/json');

$id = intval($_GET['id'] ?? 0);
if (!$id) { echo json_encode(["success"=>false,"message"=>"No policy id"]); exit; }

try {
    /* main policy */
    $stmt = $conn->prepare(
        "SELECT policy_name, term_years, premium_amount, coverage_amount,
                min_age, max_age, description
         FROM life_policy
         WHERE id = ? AND is_active = 1"
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $policy = $stmt->get_result()->fetch_assoc();
    if (!$policy) throw new Exception("Policy not found");

    /* pictures */
    $pics = [];
    $r = $conn->query("SELECT picture FROM picture_life_policy WHERE life_policy_id = $id");
    while ($row = $r->fetch_assoc()) $pics[] = $row['picture'];
    if (!$pics) $pics[] = 'uploads/no-image.png';

    /* benefits */
    $benefits = [];
    $r = $conn->query("SELECT benefits FROM benefits_life_policy WHERE life_policy_id = $id");
    while ($row = $r->fetch_assoc()) $benefits[] = $row['benefits'];

    echo json_encode([
        "success"  => true,
        "policy"   => $policy,
        "pictures" => $pics,
        "benefits" => $benefits
    ]);
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(["success"=>false,"message"=>$e->getMessage()]);
}
