<?php
require_once __DIR__ . '/../core/core.php';


// Fetch orders from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6">Submitted Orders</h1>
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Event Date</th>
                        <th class="py-3 px-6 text-left">Delivery Address</th>
                        <th class="py-3 px-6 text-left">Phone Number</th>
                        <th class="py-3 px-6 text-left">Type of Event</th>
                        <th class="py-3 px-6 text-left">Number of Servings</th>
                        <!-- <th class="py-3 px-6 text-left">Actions</th> -->
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-6"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($row['date']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($row['deliveryAddress']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($row['phoneNumber']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($row['typeOfEvent']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($row['numberOfServings']); ?></td>
                                <!-- <td class="py-3 px-6">
                                    <a href="view_order.php?id=<?php echo $row['id']; ?>"
                                        class="text-blue-500 hover:underline">View</a>
                                </td> -->
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="py-3 px-6 text-center">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<style>

</style>

<?php
$conn->close();
?>