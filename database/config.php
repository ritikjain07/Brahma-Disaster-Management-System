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

// Create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");

/**
 * Function to get database connection
 * @return mysqli Database connection object
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
