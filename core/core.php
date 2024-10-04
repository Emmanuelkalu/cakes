<?php session_start();
// Database connection
// $conn = new mysqli("localhost", "root", "", "buccie_cake");
$conn = new mysqli("localhost", "buccie_cake", "Bitmonster11#", "buccie_cake");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stripeSecretKey = "sk_test_51IkbSnH2j0YsDFbqDTF26kmj01zmNODrsJcHNJvv9IfttQknv7FjJtrkQBSbyXd17OgPWfn7dQ39OfrX2APlRgBA00PWDKN0Ju";
$stripe_publishable_key = "pk_test_51IkbSnH2j0YsDFbqFg6aHScfvgfXh9X1sCEyLDUpGBANCcEgQtmvyDiP4khGxYgKlIULxpF76mDwz08oZwJdLla400ESavFqH9";

// $stripeSecretKey = "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";
// $stripe_publishable_key = "pk_live_51IkbSnH2j0YsDFbqNtkTtrCUQA1m8FtCN1tCI9Z0pT7chzujPLL7qnFFvO39WnGr8xsrg0MKw9rJOJSM3iB98N6f00lgxb7UNr";

// Check if the cart session is not set, and if so, initialize it as an empty array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}



function getTotalCartItems()
{
    // Start the session if it hasn't been started yet
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the cart is set in the session
    if (isset($_SESSION['cart'])) {
        // Calculate the total number of items in the cart
        $totalItems = 0;
        foreach ($_SESSION['cart'] as $item) {
            $totalItems += $item['quantity'];
        }
        return $totalItems;
    } else {
        // If the cart doesn't exist, return 0
        return 0;
    }
}