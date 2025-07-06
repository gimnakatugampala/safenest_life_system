<?php
header('Content-Type: application/json');
include_once '../includes/db_connection.php';  // your DB connection file

$sql = "SELECT 
            ud.full_name AS customer_name,
            paf.dob,
            paf.full_name_nominee AS nominee,
            lp.policy_name,
            ud.phone_number AS contact_number,
            gup.email
        FROM policy_application_form paf
        INNER JOIN user_life_policy ulp ON paf.user_life_policy_life_policy_id = ulp.id
        INNER JOIN life_policy lp ON ulp.life_policy_id = lp.id
        INNER JOIN general_user_profile gup ON ulp.gup_id = gup.id
        INNER JOIN user_details ud ON ud.general_user_profile_id = gup.id";

$result = mysqli_query($conn, $sql);

$customers = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
    echo json_encode(['status' => 'success', 'data' => $customers]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Query failed', 'error' => mysqli_error($conn)]);
}
?>
