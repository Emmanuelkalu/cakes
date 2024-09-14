<?php
// Define expected variables
$expected_vars = array('name', 'email', 'phone', 'address', 'image');

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize error array
    $errors = array();

    // Loop through expected variables
    foreach ($expected_vars as $var) {
        // Check if variable is set
        if (!isset($_POST[$var]) && $var != 'image') {
            $errors[] = "Please enter your $var.";
        }
    }

    // Check for image upload
    if (!isset($_FILES['image'])) {
        $errors[] = "Please upload an image.";
    } elseif ($_FILES['image']['error'] != 0) {
        $errors[] = "Error uploading image.";
    }

    // If no errors, process form data
    if (empty($errors)) {
        // Process form data here...
        $name = $_POST['name'];
        $emailAddress = $_POST['emailAddress'];
        $phoneNumber = $_POST['phoneNumber'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $deliverAddress = $_POST['deliverAddress'];
        $typeOfEvent = $_POST['typeOfEvent'];
        $cakeColors = $_POST['cakeColors'];
        $buttercreamFlavors = $_POST['buttercreamFlavors'];
        $cakeFlavors = $_POST['cakeFlavors'];
        $fillingsFlavors = $_POST['fillingsFlavors'];
        $ourFlavorCombination = $_POST['ourFlavorCombination'];
        $numberOfTiers = $_POST['numberOfTiers'];
        $numberOfServings = $_POST['numberOfServings'];
        $whatIsYourBudget = $_POST['whatIsYourBudget'];
        $doughnuts = $_POST['doughnuts'];
        $macarons = $_POST['macarons'];
        $frostedCupcakes = $_POST['frostedCupcakes'];
        $buttercreamCupcakes = $_POST['buttercreamCupcakes'];
        $fondantDecoratedCupcakes = $_POST['fondantDecoratedCupcakes'];
        $otherDetails = $_POST['otherDetails'];
        $subject = $_POST['subject'];
        $enterYourMessage = $_POST['enterYourMessage'];
        $image = $_FILES['image'];

        // Validate file upload
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $fileType = $image['type'];
        $fileExtension = $image['name'];
        $fileExtension = $fileExtension ? strtolower($fileExtension) : '';

        // Check if the file type is allowed
        if (!in_array($fileExtension, $allowedTypes)) {
            $errors[] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }

        // Check if the file size exceeds the maximum allowed size
        if ($image['size'] > 1024 * 1024 * 5) { // 5MB
            $errors[] = "File size exceeds the maximum allowed size.";
        }
        // Make the file name unique
        $imageName = uniqid() . '_' . $image['name'];

        // Save image to server
        $image_path = 'uploads/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $image_path);

        // Assuming a database connection is already established and a table named 'orders' exists with the following schema:
        // orders table schema:
        // id (primary key, auto increment), name, email_address, phone_number, date, time, deliver_address, type_of_event, cake_colors, buttercream_flavors, cake_flavors, fillings_flavors, our_flavor_combination, number_of_tiers, number_of_servings, what_is_your_budget, doughnuts, macarons, frosted_cupcakes, buttercream_cupcakes, fondant_decorated_cupcakes, other_details, subject, enter_your_message, image_path

        // Insert form data into the database
        $query = "INSERT INTO orders (name, email_address, phone_number, date, time, deliver_address, type_of_event, cake_colors, buttercream_flavors, cake_flavors, fillings_flavors, our_flavor_combination, number_of_tiers, number_of_servings, what_is_your_budget, doughnuts, macarons, frosted_cupcakes, buttercream_cupcakes, fondant_decorated_cupcakes, other_details, subject, enter_your_message, image_path) VALUES (:name, :emailAddress, :phoneNumber, :date, :time, :deliverAddress, :typeOfEvent, :cakeColors, :buttercreamFlavors, :cakeFlavors, :fillingsFlavors, :ourFlavorCombination, :numberOfTiers, :numberOfServings, :whatIsYourBudget, :doughnuts, :macarons, :frostedCupcakes, :buttercreamCupcakes, :fondantDecoratedCupcakes, :otherDetails, :subject, :enterYourMessage, :imagePath)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':emailAddress', $emailAddress);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':deliverAddress', $deliverAddress);
        $stmt->bindParam(':typeOfEvent', $typeOfEvent);
        $stmt->bindParam(':cakeColors', $cakeColors);
        $stmt->bindParam(':buttercreamFlavors', $buttercreamFlavors);
        $stmt->bindParam(':cakeFlavors', $cakeFlavors);
        $stmt->bindParam(':fillingsFlavors', $fillingsFlavors);
        $stmt->bindParam(':ourFlavorCombination', $ourFlavorCombination);
        $stmt->bindParam(':numberOfTiers', $numberOfTiers);
        $stmt->bindParam(':numberOfServings', $numberOfServings);
        $stmt->bindParam(':whatIsYourBudget', $whatIsYourBudget);
        $stmt->bindParam(':doughnuts', $doughnuts);
        $stmt->bindParam(':macarons', $macarons);
        $stmt->bindParam(':frostedCupcakes', $frostedCupcakes);
        $stmt->bindParam(':buttercreamCupcakes', $buttercreamCupcakes);
        $stmt->bindParam(':fondantDecoratedCupcakes', $fondantDecoratedCupcakes);
        $stmt->bindParam(':otherDetails', $otherDetails);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':enterYourMessage', $enterYourMessage);
        $stmt->bindParam(':imagePath', $image_path);
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->rowCount() > 0) {
            echo "Order successfully submitted!";
        } else {
            echo "Failed to submit order.";
        }

        // Save form data to database or perform other actions...
    } else {
        // Handle errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>