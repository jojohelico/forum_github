<?php
session_start(); // Start session

// Load configuration
$config = require '../config/config.php';

// Define base URL globally
define('BASE_URL', $config['base_url']);

// Load database connection
require_once '../core/Database.php';

// Load helper functions
require_once '../core/helpers.php';
?>
