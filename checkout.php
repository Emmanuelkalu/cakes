<?php if (!isset($_SESSION['user'])) {
  header('location:auth?ref=checkout');
  exit;
}
$user = $_SESSION['user'];

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

  <div class="ps-hero bg--cover" data-background="images/hero/about.jpg">
    <div class="ps-hero__content">
      <h1>Checkout</h1>
      <div class="ps-breadcrumb">
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Checkout</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="ps-checkout pt-40 pb-40">
    <div class="ps-container">
      <style>
        .form-control.bg-white {
          background: transparent !important
        }
      </style>


      <form class="ps-form--checkout" action="https://nouthemes.net/html/bready/do_action" method="post">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
            <div class="ps-checkout__billing">
              <h3>Billing Details</h3>
              <div class="form-group form-group--inline">
                <label>Accpunt Info<span>*</span>
                </label>
                <div class="form-group__content">
                  <div class="row flex" style="justify-content:space-between; padding:20px">
                    <div class="col-6"><b><?php echo $user['full_name']; ?></b></div>
                    <div class="col-6"><?php echo $user['email']; ?></div>
                    <input type="hidden" value="1" name="checkout" />
                  </div>
                </div>
              </div>

              <div class="form-group form-group--inline">
                <label>Phone Number<span>*</span>
                </label>
                <div class="form-group__content">
                  <input name="phone" required value="<?php echo $user['phone_number']; ?>" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group form-group--inline">
                <label>Delivery Address<span>*</span>
                </label>
                <div class="form-group__content">
                  <input name="address" required value="<?php echo $user['address']; ?>" class="form-control" type="text">
                </div>
              </div>
              <div class="form-group">

              </div>
              <h4 class="mt-40"> Addition information</h4>
              <div class="form-group form-group--inline">
                <label>Order Notes</label>
                <div class="form-group__content">
                  <textarea name="notes" class="form-control" rows="7"
                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
            <div class="ps-checkout__order">
              <header>
                <h3>Your Order</h3>
              </header>
              <div class="content">
                <table class="table ps-checkout__products">
                  <?php $cartItems = $_SESSION['cart']; // if using the function
                  ?>

                  <thead>
                    <tr>
                      <th class="text-uppercase">Product</th>
                      <th class="text-uppercase">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $orderTotal = 0;

                    foreach ($cartItems as $item) {
                      $totalPrice = $item['quantity'] * $item['price'];
                      $orderTotal += $totalPrice;
                      echo "<tr>
            <td>{$item['name']} x{$item['quantity']}</td>
            <td>$" . number_format($totalPrice, 2) . "</td>
          </tr>";
                    }
                    ?>
                    <tr>
                      <td><strong>Order Total</strong></td>
                      <td><strong>$<?php echo number_format($orderTotal, 2); ?></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <footer>
                <h3>Payment Method</h3>

                <div class="form-group paypal">
                  <div class="ps-radio ps-radio--small">
                    <input class="form-control" type="radio" checked name="payment" id="rdo02">
                    <label for="rdo02">Card</label>
                  </div>
                  <ul class="ps-payment-method">
                    <li><a href="#"><img src="images/payment/1.png" alt=""></a></li>
                    <li><a href="#"><img src="images/payment/2.png" alt=""></a></li>
                    <li><a href="#"><img src="images/payment/3.png" alt=""></a></li>
                  </ul>
                  <button Type="submit" class="ps-btn ps-btn--fullwidth ps-btn--yellow">ORDER NOW</button>
                </div>
              </footer>
            </div>
            <!-- <div class="ps-shipping">
                <h3>FREE SHIPPING</h3>
                <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="#"> Singup </a> for free shipping on every order, every time.</p>
              </div> -->
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="ps-site-features">
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
  <?php include __DIR__ . '/partials/footer.php'; ?>
  <script src="https://js.stripe.com/v3/"></script>

  <script>
    var stripe = Stripe(
      '<?php echo $stripe_publishable_key; ?>'
    );

    function launchStripe(data) {
      fetch('core/forms/stripe', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: data
        })
        .then(function (response) {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(function (session) {
          if (!session.id) {
            throw new Error('No session ID returned');
          }
          return stripe.redirectToCheckout({
            sessionId: session.id
          });
        })
        .then(function (result) {
          if (result.error) {
            throw new Error(result.error.message);
          }
        })
        .catch(function (error) {
          console.error('Error:', error);
          toast('An error occurred: ' + error.message);
        });
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.querySelector('.ps-form--checkout');

      form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Gather form data
        const formData = new FormData(form);

        // Convert form data to JSON
        const data = {};
        formData.forEach((value, key) => {
          data[key] = value;
        });

        // Send the data via AJAX
        fetch('core/forms/checkout', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
          })
          .then(response => {
            if (!response.ok) {
              toast('Network response was not ok');
            }
            return response.json();
          })
          .then(result => {
            // Handle the response
            console.log('Success:', result);
            toast('redirecting to payments page...');

            var stripe = Stripe(
      '<?php echo $stripe_publishable_key; ?>'
    );

    function launchStripe(data) {
      fetch('core/forms/stripe', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data)
        })
        .then(function (response) {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(function (session) {
          if (!session.id) {
            throw new Error('No session ID returned');
          }
          return stripe.redirectToCheckout({
            sessionId: session.id
          });
        })
        .then(function (result) {
          console.error('Error:', result);
          console.error('Error:', result.error);
          console.error('Error:', result.error.message);

          if (result.error) {
            throw new Error(result.error.message);
          }
        })
        .catch(function (error) {
          console.error('Error:', error);
          toast('An error occurred: ' + error.message);
        });
    }
            launchStripe(result.data)
            // Optionally redirect to a success page or clear the cart
          })
          .catch(error => {
            console.error('Error:', error);
            toast('An error occurred: ' + error.message);
          });
      });
    });
  </script>

</body>

<!-- Mirrored from nouthemes.net/html/bready/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Sep 2024 21:58:27 GMT -->

</html>