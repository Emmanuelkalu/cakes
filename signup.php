<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize user input
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone_number = htmlspecialchars(trim($_POST['phone_number']));
    $address = htmlspecialchars(trim($_POST['address']));

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already registered.";
    } else {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone_number, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $email, $password, $phone_number, $address);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful!";
            $_SESSION['user'] = $result->fetch_assoc();
            isset($_GET['ref']) ? header('Location:' . $_GET['ref']) : header("Location:home"); // Redirect to a dashboard page

            exit();
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <?php include 'partials/meta.php'; ?>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
</head>
<body>

<?php if (isset($_GET['ref'])) {
    $ref = '?ref=' . $_GET['ref'];
} else {
    $ref = '';
} ?>



    <div class="container">
        <div class="row flex center" style="margin-bottom:100px">

        <!-- login form  -->
        <div class="col-md-6 col-lg-5">
            <div class="flex center">
                <img src="images/logo-light.png" height="50" style="margin:100px 0 30px 0" />
            </div>
            <form class="ps-form--login" style="box-shadow:0 4px 25px #b8872b20; border-radius: 10px; padding: 50px 35px !important;" action="signup<?php echo $ref; ?>" method="POST">
            <div>
                <h3>Sign Up</h3>
                <p>Please fill in the form below to create an account.</p>
            </div>
            <?php if (isset($error)): ?>
                                                                                                                                         <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input class="form-control" type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input class="form-control" type="text" id="phone_number" name="phone_number">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address"></textarea>
            </div>
            <button class="ps-btn ps-btn--fullwidth" type="submit">Register</button>
        </form>
              <p style="margin-top:20px" class="py-2">Have an account? <a href="auth<?php echo $ref; ?>">Sign in</a></p>
            </div>
        </div>
        </div>
    </div>
    <?php include 'partials/scripts.php'; ?>
</body>
</html>
