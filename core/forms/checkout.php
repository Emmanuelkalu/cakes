<?php

$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST["checkout"])) {
    $user = $_SESSION['user'];
    $name = $user['full_name'];
    $email = $user['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $notes = $_POST['notes'];
    $cart = json_encode($_SESSION['cart']);

    // Assuming you have a session variable for cart items
    $cartItems = $_SESSION['cart'];
    $total = 0;

    // Calculate the total
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Now you have $cartItems and $total to use as needed


    $stmt = $conn->prepare("INSERT INTO checkout (name, email, phone, address, notes, cart, total) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters to the SQL statement
    $stmt->bind_param("ssssssd", $name, $email, $phone, $address, $notes, $cart, $total);


    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode([
            'status' => true,
            'data' => [
                'amount' => $total,
                'id' => $stmt->insert_id,
            ]

        ]);
    } else {
        echo json_encode([
            'status' => false,
            'msg' => $stmt->error
        ]);
    }

    // Close the statement
    $stmt->close();

}

