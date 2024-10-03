<?php
require_once 'core.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'] ?? '';
    $emailAddress = $_POST['emailAddress'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $deliveryAddress = $_POST['deliveryAddress'] ?? '';
    $typeOfEvent = $_POST['typeOfEvent'] ?? '';
    $cakeColors = $_POST['cakeColors'] ?? '';
    $butterCreamFlavors = $_POST['butterCreamFlavors'] ?? '';
    $cakeFlavors = $_POST['cakeFlavors'] ?? '';
    $fillingFlavors = $_POST['fillingFlavors'] ?? '';
    $flavorCombination = $_POST['flavorCombination'] ?? '';
    $numberOfTiers = $_POST['numberOfTiers'] ?? '';
    $numberOfServings = $_POST['numberOfServings'] ?? '';
    $yourBudget = $_POST['yourBudget'] ?? '';
    $doughnuts = $_POST['doughnuts'] ?? '';
    $macarons = $_POST['macarons'] ?? '';
    $frostedCupcakes = $_POST['frostedCupcakes'] ?? '';
    $buttercreamCupcakes = $_POST['buttercreamCupcakes'] ?? '';
    $fondantCupcakes = $_POST['fondantCupcakes'] ?? '';
    $otherDetails = $_POST['otherDetails'] ?? '';
    $enterMessage = $_POST['enterMessage'] ?? '';

    // Handle file upload
    $imagePath = '';
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO orders (name, email_address, phone_number, event_date, event_time, delivery_address, 
            type_of_event, cake_colors, buttercream_flavors, cake_flavors, filling_flavors, flavor_combination, 
            number_of_tiers, number_of_servings, budget, doughnuts, macarons, frosted_cupcakes, 
            buttercream_cupcakes, fondant_cupcakes, other_details, image_path, message) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssssssssssss",
        $name,
        $emailAddress,
        $phoneNumber,
        $date,
        $time,
        $deliveryAddress,
        $typeOfEvent,
        $cakeColors,
        $butterCreamFlavors,
        $cakeFlavors,
        $fillingFlavors,
        $flavorCombination,
        $numberOfTiers,
        $numberOfServings,
        $yourBudget,
        $doughnuts,
        $macarons,
        $frostedCupcakes,
        $buttercreamCupcakes,
        $fondantCupcakes,
        $otherDetails,
        $imagePath,
        $enterMessage
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Order placed successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error placing order: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
