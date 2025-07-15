<?php
/**
 * Simple Database Configuration for Brahma Disaster Management System
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

// Only try to connect if MySQL is available
if (extension_loaded('mysqli')) {
    try {
        $conn = @new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if ($conn->connect_error) {
            // Try to create database if it doesn't exist
            $temp_conn = @new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
            if (!$temp_conn->connect_error) {
                $temp_conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
                $temp_conn->close();
                
                // Try connecting again
                $conn = @new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                if ($conn->connect_error) {
                    $conn = null;
                }
            } else {
                $conn = null;
            }
        }
        
        if ($conn) {
            $conn->set_charset("utf8");
        }
    } catch (Exception $e) {
        $conn = null;
    }
}

/**
 * Function to get database connection
 * @return mysqli|null Database connection object or null if not connected
 */
function getConnection() {
    global $conn;
    return $conn;
}
?>
