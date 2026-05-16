<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode
if (file_exists($maintenance = __DIR__.'/../actalia/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoload
require __DIR__.'/../actalia/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/../actalia/bootstrap/app.php';

// Run application
$app->handleRequest(Request::capture());