<?php
$requestUri = $_SERVER['REQUEST_URI'];
$filePath = ltrim($requestUri, '/kek');

if (empty($filePath)) {
    include 'home.php';
} else {
// server side comment

    if (file_exists($filePath) || file_exists($filePath . '.php')) {
        file_exists($filePath . '.php') ? $filePath = $filePath . '.php' : null;
        include $filePath;
    } else {
        // Handle the case when the file doesn't exist or is not a PHP file
        // You might want to show a 404 error or redirect to a default page smaple conmnent
        include '404-page.html';
        header("HTTP/1.0 404 Not Found");
        echo "404 - Page not found";
    }
}
?>