<?php
require_once(__DIR__ . '/core/vendor/autoload.php');

if (!isset($_GET['status']) && !isset($_GET['session_id'])) {
    $_SESSION['message'] = 'Missing payment parameters';
    $_SESSION['status'] = 'false';
    return header("location:ny-orders?handlepay=false");
}


\Stripe\Stripe::setApiKey($stripeSecretKey);

function getPaymentStatus($session_id)
{
    global $conn;
    try {
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        $payment_intent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        $status = $payment_intent->status;
        $amount = $payment_intent->amount / 100; // Convert from cents to dollars
        $currency = strtoupper($payment_intent->currency);

        switch ($status) {
            case 'succeeded':
                $conn->query("update checkout set status = 'completed' WHERE trx = '" . $session_id . "'");
                return "Payment of $amount $currency was successful.";
            case 'processing':
                return "Payment of $amount $currency is still processing.";
            case 'requires_payment_method':
                return "Payment of $amount $currency failed. Please try another payment method.";
            default:
                return "Payment status: $status";
        }
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

// Usage on your success page
$session_id = $_GET['session_id'] ?? null;

if ($session_id) {
    // Clear the cart session
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }


    $status_message = getPaymentStatus($session_id);
    $_SESSION['message'] = $status_message;
    $_SESSION['status'] = 'true';
} else {
    $_SESSION['message'] = "No session ID provided";
    $_SESSION['status'] = 'false';
}

return header("location:my-orders?handlepay=true");
