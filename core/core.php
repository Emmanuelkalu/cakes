<?php session_start();
// Database connection
// $conn = new mysqli("localhost", "root", "", "buccie_cake");
$conn = new mysqli("localhost", "buccie_cake", "Bitmonster11#", "buccie_cake");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stripeSecretKey = "sk_test_51IkbSnH2j0YsDFbqDTF26kmj01zmNODrsJcHNJvv9IfttQknv7FjJtrkQBSbyXd17OgPWfn7dQ39OfrX2APlRgBA00PWDKN0Ju";
$stripe_publishable_key = "pk_test_51IkbSnH2j0YsDFbqFg6aHScfvgfXh9X1sCEyLDUpGBANCcEgQtmvyDiP4khGxYgKlIULxpF76mDwz08oZwJdLla400ESavFqH9";

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