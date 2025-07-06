<?php
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header('Content-Type: application/json');
echo json_encode([
  'publishableKey' => $_ENV['STRIPE_PUBLISHABLE_KEY']
]);
