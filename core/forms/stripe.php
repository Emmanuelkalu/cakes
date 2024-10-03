<?php

ini_set('display_errors', 1);
require_once(__DIR__ . '/../vendor/autoload.php');
$_POST = json_decode(file_get_contents('php://input'), true);


\Stripe\Stripe::setApiKey($stripeSecretKey);

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $base = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/cakes/';
        $input = $_POST;
        $amount = $input['amount'] * 100 ?? null;
        $id = $input['id'] ?? null;
        $currency = 'usd';

        if (!$amount || !$currency) {
            throw new Exception('Amount and currency are required amount=' . $amount . ' curr=' . $currency);
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => 'Nglo cakes',
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => $base . '/handlepay?status=true&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $base . '/handlepay?status=false',
            'customer_email' => $_SESSION['user']['email']
        ]);

        $conn->query("update checkout set trx = '" . $checkout_session->id . "' WHERE id = '" . $id . "'");



        echo json_encode(['id' => $checkout_session->id]);
    } catch (Exception $e) {
        // logError('Stripe error: ' . $e->getMessage());
        http_response_code(500);
        echo 'stripe errpr ' . $e->getMessage();
    }
} else {
    http_response_code(405);
    echo $e->getMessage();
}