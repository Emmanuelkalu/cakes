<?php
function routeRequest($requestUri, $base)
{
    if (empty($base)) {
        $filePath = $requestUri;
    } else {
        $filePath = str_replace($base, '', $requestUri);
    }
    // echo $filePath;
    if (empty($filePath)) {
        return 'home.php';
    } else {
        $filePath = file_exists(__DIR__ . '/' . $filePath . '.php') ? __DIR__ . '/' . $filePath . '.php' : __DIR__ . '/' . $filePath;
        if (!file_exists($filePath)) {
            return '404-page.html';
        } else {
            return $filePath;
        }
    }
}

function includeFile($filePath)
{
    if ($filePath === '404-page.html') {
        header("HTTP/1.0 404 Not Found");
        echo "404 - Page not found";
    } else {
        include $filePath;
    }
}

$requestUri = $_SERVER['REQUEST_URI'];
$base = '';
$filePath = routeRequest($requestUri, $base);
includeFile($filePath);
?>