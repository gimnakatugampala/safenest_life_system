<?php
require_once '../vendor/autoload.php';
require_once '../secrets.php';
require_once '../includes/db_connection.php';

$stripe = new \Stripe\StripeClient($stripeSecretKey);
header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents('php://input'), true);
    $policyId = $input['policy_id'] ?? null;

    if (!$policyId) {
        throw new Exception("Missing policy_id");
    }

    // Fetch premium amount and policy name from DB (in LKR)
    $stmt = $conn->prepare("SELECT lp.policy_name, lp.premium_amount FROM life_policy lp 
                            INNER JOIN user_life_policy up ON lp.id = up.life_policy_id
                            WHERE up.id = ?");
    $stmt->bind_param("i", $policyId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) throw new Exception("Policy not found.");

    $policyName = $row['policy_name'];
    $amountLKR = (float)$row['premium_amount'];
    $amountInCents = (int)($amountLKR * 100); // Stripe expects cents

    $paymentIntent = $stripe->paymentIntents->create([
        'amount' => $amountInCents,
        'currency' => 'lkr',
        'automatic_payment_methods' => ['enabled' => true],
        'metadata' => [
            'policy_id' => $policyId,
            'policy_name' => $policyName
        ],
        'description' => "Payment for policy: $policyName"
    ]);

    echo json_encode([
        'clientSecret' => $paymentIntent->client_secret,
        'policyName' => $policyName,
        'amountLKR' => number_format($amountLKR, 2)
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
