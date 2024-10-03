<?php


if (isset($_GET['removeCartItem'])) {
    function removeFromCart($itemId)
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the cart exists in the session
        if (isset($_SESSION['cart'])) {
            // Loop through the cart items
            foreach ($_SESSION['cart'] as $key => $item) {
                // Check if the current item's ID matches the ID to be removed
                if ($item['id'] == $itemId) {
                    // Remove the item from the cart
                    unset($_SESSION['cart'][$key]);
                    // Re-index the array to maintain order
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    // Optionally, break the loop if item IDs are unique
                    break;
                }
            }
        }
    }

    // Example usage
    removeFromCart($_GET['removeCartItem']); // Replace 123 with the actual item ID to be removed
    header('location:../../cart');

}


if (isset($_GET['updateCartItem'])) {
    function updateCartItemQuantity($itemId, $newQuantity)
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the cart exists in the session
        if (isset($_SESSION['cart'])) {
            // Loop through the cart items
            foreach ($_SESSION['cart'] as $key => $item) {
                // Check if the current item's ID matches the ID to be updated
                if ($item['id'] == $itemId) {
                    // Update the quantity of the item
                    $_SESSION['cart'][$key]['quantity'] = $newQuantity;
                    // Optionally, break the loop if item IDs are unique
                    break;
                }
            }
        }

        echo json_encode(['status' => true]);
    }

    // Example usage
    updateCartItemQuantity($_GET['updateCartItem'], $_GET['newQuantity']);
}
