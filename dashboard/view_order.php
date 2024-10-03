<?php
session_start();
require_once __DIR__ . '/../core/core.php';

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: ./orders');
    exit;
}

// Check if an order ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ./orders');
    exit;
}

$order_id = intval($_GET['id']);

// Fetch the order details
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: ./orders');
    exit;
}

$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order #<?php echo $order_id; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6">Order Details #<?php echo $order_id; ?></h1>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h2 class="text-xl font-semibold mb-2">Customer Information</h2>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email_address']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone_number']); ?></p>
                    <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($order['delivery_address']); ?>
                    </p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-2">Event Details</h2>
                    <p><strong>Event Date:</strong> <?php echo htmlspecialchars($order['event_date']); ?></p>
                    <p><strong>Event Time:</strong> <?php echo htmlspecialchars($order['event_time']); ?></p>
                    <p><strong>Type of Event:</strong> <?php echo htmlspecialchars($order['type_of_event']); ?></p>
                    <p><strong>Number of Servings:</strong>
                        <?php echo htmlspecialchars($order['number_of_servings']); ?></p>
                </div>
            </div>
            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2">Cake Details</h2>
                <p><strong>Cake Colors:</strong> <?php echo htmlspecialchars($order['cake_colors']); ?></p>
                <p><strong>Buttercream Flavors:</strong> <?php echo htmlspecialchars($order['buttercream_flavors']); ?>
                </p>
                <p><strong>Cake Flavors:</strong> <?php echo htmlspecialchars($order['cake_flavors']); ?></p>
                <p><strong>Filling Flavors:</strong> <?php echo htmlspecialchars($order['filling_flavors']); ?></p>
                <p><strong>Flavor Combination:</strong> <?php echo htmlspecialchars($order['flavor_combination']); ?>
                </p>
                <p><strong>Number of Tiers:</strong> <?php echo htmlspecialchars($order['number_of_tiers']); ?></p>
            </div>
            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2">Additional Items</h2>
                <p><strong>Doughnuts:</strong> <?php echo htmlspecialchars($order['doughnuts']); ?></p>
                <p><strong>Macarons:</strong> <?php echo htmlspecialchars($order['macarons']); ?></p>
                <p><strong>Frosted Cupcakes:</strong> <?php echo htmlspecialchars($order['frosted_cupcakes']); ?></p>
                <p><strong>Buttercream Cupcakes:</strong>
                    <?php echo htmlspecialchars($order['buttercream_cupcakes']); ?></p>
                <p><strong>Fondant Cupcakes:</strong> <?php echo htmlspecialchars($order['fondant_cupcakes']); ?></p>
            </div>
            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2">Other Details</h2>
                <p><strong>Budget:</strong> $<?php echo htmlspecialchars($order['budget']); ?></p>
                <p><strong>Other Details:</strong> <?php echo htmlspecialchars($order['other_details']); ?></p>
                <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($order['message'])); ?></p>
            </div>
            <?php if (!empty($order['image_path'])): ?>
                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Uploaded Image</h2>
                    <img style="max-height: 300px;" src="../<?php echo htmlspecialchars($order['image_path']); ?>"
                        alt="Cake Design" class="max-w-full h-auto">
                </div>
            <?php endif; ?>
        </div>
        <div class="mt-6 text-center">
            <a href="./orders" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Back to Orders</a>
        </div>
    </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>