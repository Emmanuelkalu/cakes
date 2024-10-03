<?php
// Database connection
require_once __DIR__ . '/../core/core.php';


// Fetch cakes from the database
$sql = "SELECT * FROM cakes";
$result = $conn->query($sql);

$cakes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cakes[] = $row;
    }
}

$conn->close();

// Return cakes as JSON
header('Content-Type: application/json');
echo json_encode($cakes);
