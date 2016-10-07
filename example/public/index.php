<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    
    $file = __DIR__ . $url['path'];
    
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../../vendor/autoload.php';

session_start();

$baseDir = __DIR__ . "/../src/intrawarez/slimannotations/example";

$settings = require "$baseDir/settings.php";

// Instantiate the app
$app = new \intrawarez\slimannotations\App($settings);

// Set up dependencies
require "$baseDir/dependencies.php";

// Register middleware
require "$baseDir/middleware.php";

// Register routes
// require "$baseDir/routes.php";

// Run app
$app->run();
