
<?php
// Simple PHP File-Based Router

// Get the request URI and remove any query string
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

//
$basep = "";
// Remove leading and trailing slashes
$request_uri = trim($request_uri, '/');
$request_uri = str_replace($basep, '', $request_uri);




// Set the base directory for your route files
$base_dir = __DIR__ . '/';

// If the request is empty, load the index file
if (empty($request_uri)) {
    $request_uri = 'home';
}

// Create the file path
$file_path = $base_dir . $request_uri . '.php';


// Check if the file exists
if (file_exists($file_path)) {
    // Include the file
    include $file_path;
} else {
    // Handle 404 Not Found
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
}