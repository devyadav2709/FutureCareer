<?php
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'career_prediction');

// Admin credentials (in production, use hashed passwords in database)
define('ADMIN_USERNAME', 'yadavdev');
define('ADMIN_PASSWORD', 'dev@1237');

// Create database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect to login if not authenticated
function requireAuth()
{
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: index.php");
        exit();
    }
}
?>