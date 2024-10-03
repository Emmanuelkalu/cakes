<?php
// Hard-coded credentials
$valid_username = 'admin';
$valid_password = 'pass123'; // Change this to a more secure password

// Check if the user is already logged in
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // User is authenticated, proceed to fetch orders

} else {
    // User is not authenticated, check for login form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Check credentials
        if ($username === $valid_username && $password === $valid_password) {
            $_SESSION['authenticated'] = true; // Set session variable
            header('Location: ./avail'); // Redirect to the same page
            exit;
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"><![endif]-->
<!--[if IE 8]><html class="ie ie8"><![endif]-->
<!--[if IE 9]><html class="ie ie9"><![endif]-->
<html lang="en">
  
<?php include __DIR__ . '/partials/meta.php'; ?>

  <body>
    <div class="ps-search">
      <div class="ps-search__content"><a class="ps-search__close" href="#"><span></span></a>
        <form class="ps-form--search-2" action="" method="post">
          <h3>Enter your keyword</h3>
          <div class="form-group">
            <input class="form-control" type="text" placeholder="">
            <button class="ps-btn active ps-btn--fullwidth">Search</button>
          </div>
        </form>
      </div>
    </div>
    <!-- header-->
    <?php include __DIR__ . '/partials/nav.php'; ?>

 
    <div class="ps-checkout pt-40 pb-40">
      <div class="ps-container">


<div class="">

<?php if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true): ?>
                                                <!-- Login Form -->
                                                <h1 class="text-3xl font-bold text-center mb-6">Login</h1>
        

                                                <div class="row flex center">

                                <!-- login form  -->
                                <div class="col-md-6 col-lg-5">
                                    <div class="flex center">
                                        <img src="images/logo-light.png" height="50" style="margin:100px 0 30px 0" />
                                    </div>
                                      <form class="ps-form--login" style="box-shadow:0 4px 25px #b8872b20; border-radius: 10px; padding: 50px 35px !important;" action="./avail" method="post">
                                        <div>
                                        <h3>Sign in</h3>
                                        <p>Please enter your email address and password to continue </p>
                                        </div>
                                        <?php if (isset($error_message)): ?>
                                                                                            <div class="bg-red-500 text-white p-4 rounded mb-4 text-center">
                                                                                                <?php echo $error_message; ?>
                                                                                            </div>
                                                    <?php endif; ?>
                                        <p style="padding:10px 0" class="text-danger "><?php echo $_SESSION['err'] ?? ''; ?></p>
                                        <div class="form-group">
                                          <label for="email">username:</label>
                                          <input class="form-control" type="text" id="email" name="username" required>
                                        </div>
                                        <div class="form-group">
                                          <label for="password">Password:</label>
                                          <input class="form-control" type="password" id="password" name="password" required>
                                        </div>
                                        <button class="ps-btn ps-btn--fullwidth" type="submit">Log In</button>
                                      </form>
                                      <p style="margin:20px 0">Don't have an account? <a href="auth<?php echo $ref; ?>">Sign Up</a></p>
                                    </div>
                                </div>
        <?php else: ?>

                                    <?php
                                    // Assuming you have a database connection established
// and the user's email is stored in a session variable
                                
                                    // Get the user's email from the session
                                
                                    // Prepare and execute the SQL query
                                    $sql = "SELECT * FROM checkout   order by id desc";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // Check if there are any orders
                                    if ($result->num_rows > 0) {
                                        echo "<h2 style='margin-top:200px'>Your Orders</h2>";
                                        echo "<table class='orders-table'>";
                                        echo "<thead><tr><th>Order ID</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th></tr></thead>";
                                        echo "<tbody>";

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            echo "<td>";
                                            $cartItems = json_decode($row['cart'], true);
                                            if ($cartItems) {
                                                echo "<ul>";
                                                foreach ($cartItems as $item) {
                                                    echo "<li>" . htmlspecialchars($item['name']) . " - Quantity: " . $item['quantity'] . "</li>";
                                                }
                                                echo "</ul>";
                                            } else {
                                                echo "No items";
                                            }
                                            echo "</td>";
                                            echo "<td>$" . number_format($row['total'], 2) . "</td>";
                                            echo "<td><span class='order-status status-" . strtolower($row['status']) . "'>" . $row['status'] . "</span></td>";
                                            echo "</tr>";
                                        }

                                        echo "</tbody></table>";
                                    } else {
                                        echo "<p class='no-orders'>You have no orders.</p>";
                                    }

                                    $stmt->close();
                                    ?>

<?php endif; ?>


</div>



       
      </div>
    </div>
    <div class="ps-site-features" style=>
      <div class="ps-container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
            <div class="ps-block--iconbox"><i class="ba-delivery-truck-2"></i>
              <h4>Free Shipping <span> On Order Over$199</h4>
              <p>Want to track a package? Find tracking information and order details from Your Orders.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
            <div class="ps-block--iconbox"><i class="ba-biscuit-1"></i>
              <h4>Master Chef<span> WITH PASSION</h4>
              <p>Shop zillions of finds, with new arrivals added daily.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
            <div class="ps-block--iconbox"><i class="ba-flour"></i>
              <h4>Natural Materials<span> protect your family</h4>
              <p>We always ensure the safety of all products of store</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
            <div class="ps-block--iconbox"><i class="ba-cake-3"></i>
              <h4>Attractive Flavor <span>ALWAYS LISTEN</span></h4>
              <p>We offer a 24/7 customer hotline so you’re never alone if you have a question.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <div id="back2top"><i class="fa fa-angle-up"></i></div>
    <?php include __DIR__ . '/partials/scripts.php'; ?>
  
</body>

<!-- Mirrored from nouthemes.net/html/bready/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Sep 2024 21:58:27 GMT -->
</html>
<style>
    /* Add this to your existing style.css file */

/* Orders table styles */
.orders-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.orders-table th,
.orders-table td {
    padding: 25px ;
    text-align: left;
   border:none !important;
   
}

.orders-table th {
    background-color: #f8f8f8;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    color: #333;
}

.orders-table tbody tr:hover {
    background-color: #f5f5f5;
}

.orders-table td ul {
    margin: 0;
    padding-left: 20px;
}

.orders-table td ul li {
    margin-bottom: 5px;
}

.order-status {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}

.status-processing {
    background-color: #cce5ff;
    color: #004085;
}

.status-completed {
    background-color: #d4edda;
    color: #155724;
}

.status-cancelled {
    background-color: #f8d7da;
    color: #721c24;
}

.no-orders {
    text-align: center;
    padding: 20px;
    background-color: #f8f8f8;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    font-style: italic;
    color: #666;
}

</style>

<?php
if (isset($_SESSION['message'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            toast('" . htmlspecialchars($_SESSION['message'], ENT_QUOTES) . "');
        });
    </script>";
    unset($_SESSION['message']);
}
?>

