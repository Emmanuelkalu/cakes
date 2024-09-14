<?php    // Database connection
$conn = new mysqli("localhost", "buccie_cake", "Bitmonster11#", "buccie_cake");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}