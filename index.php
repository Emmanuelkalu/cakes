<?php
$requestUri = $_SERVER['REQUEST_URI'];
$filePath = str_replace('', '', $requestUri);
if (empty($filePath)) {
    include 'home.php';
} else {
    $filePath = file_exists($filePath . '.php') ? $filePath . '.php' : $filePath;
    if (!file_exists($filePath)) {
        // Handle the case when the file doesn't exist or is not a PHP file
        include '404-page.html';
        header("HTTP/1.0 404 Not Found");
        echo "404 - Page not found";
    } else {
        include $filePath;
    }
}
?>