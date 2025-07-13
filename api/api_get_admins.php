<?php
header('Content-Type: application/json');
include_once '../includes/db_connection.php';

$sql = "SELECT id,first_name, email, last_name,user_status_id 
        FROM general_user_profile 
        WHERE gup_type_id = 2 ";

$result = mysqli_query($conn, $sql);

$admins = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $admins[] = $row;
    }
    echo json_encode(['status' => 'success', 'data' => $admins]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Query failed', 'error' => mysqli_error($conn)]);
}
?>
