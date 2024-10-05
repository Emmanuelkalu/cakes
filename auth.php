<?php
$_SESSION['err'] = '';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['email'];
    $pass = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->query("SELECT * FROM users WHERE email = '" . $user . "'");


    // Check if email exists
    if ($stmt->num_rows > 0) {
        $person = $stmt->fetch_assoc();

        // Verify password
        if (password_verify($pass, $person['password'])) {
            // Password is correct, set session variables
            $_SESSION['user'] = $person;
            isset($_GET['ref']) ? header('Location:' . $_GET['ref']) : header("Location:home"); // Redirect to a dashboard page
            exit;
        } else {
            $_SESSION['err'] = "Invalid password.";
        }
    } else {
        $_SESSION['err'] = "No user found with that email.";
    }

    $stmt->close();
}

$conn->close();

if (isset($_GET['ref'])) {
    $ref = '?ref=' . $_GET['ref'];
} else {
    $ref = '';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once __DIR__ . "/partials/meta.php"; ?>
</head>
<body>
    <div class="container">
        <div class="row flex center">

        <!-- login form  -->
        <div class="col-md-6 col-lg-5">
            <div class="flex center">
                <img src="images/logo-light.png" height="50" style="margin:100px 0 30px 0" />
            </div>
              <form class="ps-form--login" style="box-shadow:0 4px 25px #b8872b20; border-radius: 10px; padding: 50px 35px !important;" action="auth<?php echo $ref; ?>" method="post">
                <div>
                <h3>Sign in</h3>
                <p>Please enter your email address and password to continue </p>
                </div>
                <p style="padding:10px 0" class="text-danger "><?php echo $_SESSION['err']; ?></p>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input class="form-control" type="text" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <button class="ps-btn ps-btn--fullwidth" type="submit">Log In</button>
              </form>
              <p style="margin:20px 0">Don't have an account? <a href="signup<?php echo $ref; ?>">Sign Up</a></p>
            </div>
        </div>
        </div>
    </div>

<?php include_once __DIR__ . "/partials/scripts.php"; ?>
    
</body>
</html>


