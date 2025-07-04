<?php
require_once '../vendor/autoload.php';
require_once '../secrets.php';

$stripe = new \Stripe\StripeClient($stripeSecretKey);

function calculateOrderAmount(array $items): int {
    $total = 0;
    foreach ($items as $item) {
        $total += $item->amount;
    }
    return $total;
}

header('Content-Type: application/json');

try {
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);

    $paymentIntent = $stripe->paymentIntents->create([
        'amount' => calculateOrderAmount($jsonObj->items),
        'currency' => 'usd',
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
    ]);

    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
