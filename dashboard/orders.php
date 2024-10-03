<?php
session_start(); // Start the session
require_once __DIR__ . '/../core/core.php';

// Hard-coded credentials
$valid_username = 'admin';
$valid_password = 'pass123'; // Change this to a more secure password

// Check if the user is already logged in
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // User is authenticated, proceed to fetch orders

    // Fetch orders from the database
    $sql = "SELECT * FROM orders ORDER BY created_at DESC";
    $result = $conn->query($sql);
} else {
    // User is not authenticated, check for login form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Check credentials
        if ($username === $valid_username && $password === $valid_password) {
            $_SESSION['authenticated'] = true; // Set session variable
            header('Location: ./orders'); // Redirect to the same page
            exit;
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}
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
        <?php if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true): ?>
            <!-- Login Form -->
            <h1 class="text-3xl font-bold text-center mb-6">Login</h1>
        
            <form method="POST" action="./orders" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
                <?php if (isset($error_message)): ?>
                    <div class="bg-red-500 text-white p-4 rounded mb-4 text-center">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" name="username" id="username" class="border rounded w-full py-2 px-3" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="border rounded w-full py-2 px-3" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Login</button>
            </form>
        <?php else: ?>
        <!-- Authenticated User View -->
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
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300">
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($row['email_address']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($row['event_date']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($row['delivery_address']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($row['type_of_event']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($row['number_of_servings']); ?></td>
                                    <td class="py-3 px-6">
                                        <a href="view_order?id=<?php echo $row['id']; ?>"
                                            class="text-white bg-blue-500 p-2 px-6 my-2 rounded-lg hover:underline">View</a>
                                        <!-- Add more actions as needed -->
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                                <?php else: ?>
                                <tr>
                                <td colspan="8" class="py-3 px-6 text-center">No orders found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    </table>
                    </div>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
$conn->close();
?>
