<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Config/DBConfig.php';

$baseUrl = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl = rtrim($baseUrl, '/');
date_default_timezone_set('Europe/Brussels');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Log alle errors naar Logs/errors.log
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/Logs/errors.log');


// Start de router
$router = new App\Core\Router();
