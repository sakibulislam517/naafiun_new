<?php
$pg = 'home';

// 1. Try to get 'e' from Query String (Standard Rewrite)
if (isset($_GET['e']) && !empty($_GET['e'])) {
    $pg = $_GET['e'];
} 
// 2. Fallback: Parse URI manually if Rewrite isn't passing $_GET
else {
    $request_uri = $_SERVER['REQUEST_URI'];
    
    // Remove base path and query strings
    $path = parse_url($request_uri, PHP_URL_PATH);
    $path = str_replace('/naafiun/', '', $path); // Adjust if running in subfolder
    $path = trim($path, '/');
    
    // Take the first segment as the page
    $segments = explode('/', $path);
    if (isset($segments[0]) && !empty($segments[0])) {
        $pg = $segments[0];
    }
}

// 3. Validate page exists
if (file_exists('pages/' . $pg . '.php')) {
    $pg = $pg;
} else {
    $pg = 'home';
}

include 'main.php';
include 'pages/header.php';
include 'pages/' . $pg . '.php';
include 'pages/footer.php';
