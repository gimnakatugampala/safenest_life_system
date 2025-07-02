<?php
require_once '../includes/db_connection.php';   // mysqli $conn
header('Content-Type: application/json');

try {
    /* grab policy + first image (if any) */
    $sql = "
      SELECT  lp.id,
              lp.policy_name,
              lp.term_years,
              lp.premium_amount,
              lp.coverage_amount,
              lp.min_age,
              lp.max_age,
              lp.description,
              COALESCE(pic.picture,'uploads/no-image.png') AS image
      FROM    life_policy lp
      LEFT JOIN (
          SELECT  picture, life_policy_id
          FROM    picture_life_policy
          GROUP BY life_policy_id
      ) pic ON pic.life_policy_id = lp.id
      WHERE lp.is_active = 1
      ORDER BY lp.created_at DESC
    ";

    $policies = [];
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $row['benefits'] = [];

        /* grab benefits */
        $bRes = $conn->prepare(
            "SELECT benefits FROM benefits_life_policy WHERE life_policy_id = ?"
        );
        $bRes->bind_param('i', $row['id']);
        $bRes->execute();
        $bRes->bind_result($benefitText);
        while ($bRes->fetch()) {
            $row['benefits'][] = $benefitText;
        }
        $bRes->close();

        $policies[] = $row;
    }

    echo json_encode(["success" => true, "data" => $policies]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
