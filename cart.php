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
        <h1>Cart</h1>
        <div class="ps-breadcrumb">
          <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Cart</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="ps-checkout pt-40 pb-40">
      <div class="ps-container">

<?php


// Check if cart items exist in the session, otherwise initialize an empty array
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Example of how you might add items to the cart in the session
// $_SESSION['cartItems'] = [
//     ['name' => 'Product 1', 'price' => 29.99, 'quantity' => 1],
//     ['name' => 'Product 2', 'price' => 49.99, 'quantity' => 2],
//     // Add more products as needed
// ];


function calculateTotal($cartItems)
{
  $total = 0;
  foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
  }
  return $total;
}
?>

<div class="">
    <form action="update_cart.php" method="post">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th style="width:40px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                              <tr>
                                  <td><?php echo htmlspecialchars($item['name']); ?></td>
                                  <td>$<?php echo number_format($item['price'], 2); ?></td>
                                  <td>
                                      <input data-id="<?php echo $item['id']; ?>" class="form-control" type="number" name="quantity[]" value="<?php echo $item['quantity']; ?>" min="1">
                                  </td>
                                  <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                  <td style="width:40px">
                                      <a href="core/forms/cart?removeCartItem=<?php echo $item['id']; ?>" class="ps-remove"></a>
                                  </td>
                              </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      <div class="flex end" style="margin-top:40px">
      <div class="">
            <h3 id="totaldisplay" style="text-align:right">Total: $<?php echo number_format(calculateTotal($cartItems), 2); ?></h3>
            <a class="ps-btn" href="checkout">Proceed to Checkout</a>
        </div>
      </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('input[name="quantity[]"]');
        const totalDisplay = document.querySelector('#totaldisplay');

        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                const row = this.closest('tr');
                const priceCell = row.querySelector('td:nth-child(2)');
                const totalCell = row.querySelector('td:nth-child(4)');
                
                const price = parseFloat(priceCell.textContent.replace('$', ''));
                const quantity = parseInt(this.value);
                const productId = input.getAttribute('data-id');

                if(quantity < 1 ) return toast('Quantity cannot be less than 1'); 
                
                // Update the total for the respective product
                const newTotal = price * quantity;
                totalCell.textContent = `$${newTotal.toFixed(2)}`;

                // Recalculate the gross total
                let grossTotal = 0;
                document.querySelectorAll('tbody tr').forEach(tr => {
                    const total = parseFloat(tr.querySelector('td:nth-child(4)').textContent.replace('$', ''));
                    grossTotal += total;
                });

                totalDisplay.textContent = `Total: $${grossTotal.toFixed(2)}`;


                fetch(`core/forms/cart?updateCartItem=${productId}&newQuantity=${quantity}`)
            .then(response => response.json())
            .then(data => {
                toast('cart item updated');
            })
            .catch(error => {
                console.error('Error:', error);
            });

                // Update the gross total display
            });
        });
        
    });
</script>


       
      </div>
    </div>
    <div class="ps-site-features">
      <div class="ps-container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
            <div class="ps-block--iconbox"><i class="ba-delivery-truck-2"></i>
              <h4>Fast Shipping <span> On all Orders</h4>
              <p>Want to track a package? Find tracking information and order details from Your Orders.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
            <div class="ps-block--iconbox"><i class="ba-biscuit-1"></i>
              <h4>Master Chef<span> WITH PASSION</h4>
              <p>Varieties of Cakes and bread, with new arrivals added daily.</p>
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
  
</body>

<!-- Mirrored from nouthemes.net/html/bready/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Sep 2024 21:58:27 GMT -->
</html>