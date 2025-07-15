<?php
/**
 * Database Configuration for Brahma Disaster Management System
 * 
 * @author Ritik Jain
 * @version 1.0
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'brahma_db');

// Initialize connection variable
$conn = null;
$db_connection_error = null;

// Try to create connection
try {
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        $db_connection_error = "Connection failed: " . $conn->connect_error;
        $conn = null;
    } else {
        // Set charset to utf8
        $conn->set_charset("utf8");
    }
} catch (Exception $e) {
    $db_connection_error = "Database connection error: " . $e->getMessage();
    $conn = null;
}

/**
 * Function to get database connection
 * @return mysqli|null Database connection object or null if not connected
 */
function getConnection() {
    global $conn;
    return $conn;
}

/**
 * Function to close database connection
 */
function closeConnection() {
    global $conn;
    if ($conn) {
        $conn->close();
    }
}
?>
