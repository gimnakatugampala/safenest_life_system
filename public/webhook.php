<?php
require_once '../vendor/autoload.php';
require_once '../secrets.php';
require_once '../includes/db_connection.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);

// Read Stripe webhook payload
$payload = @file_get_contents("php://input");
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$endpoint_secret = $_ENV['STRIPE_SECRET_KEY'];

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch (\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit('Invalid payload');
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit('Invalid signature');
}

// Handle payment_intent.succeeded
if ($event->type === 'payment_intent.succeeded') {
    $paymentIntent = $event->data->object;

    $policyId = $paymentIntent->metadata->policy_id ?? null;

    if ($policyId) {
        $stmt = $conn->prepare("UPDATE user_life_policy SET is_paid = 1 WHERE id = ?");
        $stmt->bind_param("i", $policyId);
        if ($stmt->execute()) {
            error_log("Payment recorded successfully for policy ID $policyId.");
        } else {
            error_log("Failed to update is_paid for policy ID $policyId.");
        }
    } else {
        error_log("No policy_id found in payment intent metadata.");
    }
}

http_response_code(200);
echo json_encode(['status' => 'ok']);
?>
