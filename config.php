<?php
$servername = "localhost";
$username = "root"; // Change if different
$password = ""; // Change if different
$dbname = "brahma_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

// Additional code can go here, for example, queries to interact with the database

?>
