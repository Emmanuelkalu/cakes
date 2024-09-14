<?php
ini_set("display_erros", 0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "vendor/autoload.php";
include 'core/core.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        //code...

    // Collecting form data
    $name = $_POST['name'];
    $email = $_POST['emailAddress'];
    $date = $_POST['date'];
    $deliveryAddress = $_POST['deliveryAddress'];
    $phoneNumber = $_POST['phoneNumber'];
    $typeOfEvent = $_POST['typeOfEvent'];
    $cakeColors = $_POST['cakeColors'];
    $numberOfServings = $_POST['numberOfServings'];
    $yourBudget = $_POST['yourBudget'];
    $notes = $_POST['enterMessage'];

    // File upload handling
    $targetDir = ""; // Directory to save uploaded files
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES["file"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            // Insert into database
            $sql = "INSERT INTO orders (name, email, date, deliveryAddress, phoneNumber, typeOfEvent, cakeColors, numberOfServings, yourBudget, notes, filePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssss", $name, $email, $date, $deliveryAddress, $phoneNumber, $typeOfEvent, $cakeColors, $numberOfServings, $yourBudget, $notes, $targetFile);
            $stmt->execute();







            $mail = new PHPMailer();
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();
            //Enable SMTP debugging
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
            //Set the hostname of the mail server
            $mail->Host = 'nglocakes.com';
            //Set the SMTP port number - likely to be 25, 465 or 587
            $mail->Port = 587;
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            //Username to use for SMTP authentication
            $mail->Username = 'orders@nglocakes.com';
            //Password to use for SMTP authentication
            $mail->Password = 'Bitmonster11#';



            // Email content
            $mail->setFrom('orders@nglocakes.com', 'Order Notification');
            $mail->addAddress('chida.codes@gmail.com');
                $mail->addAddress('ihenschly@gmail.com');
                $mail->Subject = 'New Order ';
                $mail->Body = "New order for NGLO, $name. Here are the details:\n\n" .
                "Event Date: $date\n" .
                "Delivery Address: $deliveryAddress\n" .
                "Phone Number: $phoneNumber\n" .
                "Type of Event: $typeOfEvent\n" .
                "Cake Colors: $cakeColors\n" .
                "Number of Servings: $numberOfServings\n" .
                "Your Budget: $yourBudget\n" .
                "Notes: $notes\n" .
                "Uploaded File: $targetFile";

            // Send email
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                    header('Location: /home?success=Order%20placed%20successfully.');
                    exit;
            }
        } else {
                header('Location: /home?error=Order%20not%20placed.%20Please%20try%20again.');
        }
    }

    $stmt->close();
    $conn->close();
    } catch (\Throwable $th) {
        error_log($th->getMessage());
        header('Location: /home?error=An%20error%20occurred.%20Please%20try%20again.');
    }

}
?>
