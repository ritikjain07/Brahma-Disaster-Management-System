<?php
/**
 * Database Schema Export for Render Deployment
 * 
 * This script will export your database schema for setting up the database
 * on Render. Run it locally to generate the schema.sql file.
 */

// Load the database configuration
require_once(__DIR__ . '/database/config.php');

// Check if connection is available
if (!$conn) {
    die("Database connection failed. Please check your configuration.");
}

// Set output file
$output_file = __DIR__ . '/database/schema.sql';

// Create output directory if it doesn't exist
if (!file_exists(dirname($output_file))) {
    mkdir(dirname($output_file), 0755, true);
}

// Get all tables
$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Start output buffer
ob_start();

// Export schema for each table
foreach ($tables as $table) {
    // Get create table statement
    $create_table_result = $conn->query("SHOW CREATE TABLE `{$table}`");
    $create_table_row = $create_table_result->fetch_row();
    $create_table_sql = $create_table_row[1];
    
    // Write to output
    echo "-- Table structure for table `{$table}`\n\n";
    echo "DROP TABLE IF EXISTS `{$table}`;\n\n";
    echo $create_table_sql . ";\n\n";
    
    // Optional: Add sample data for reference tables
    // This is commented out by default to avoid exporting sensitive data
    /*
    if (in_array($table, ['settings', 'disaster_types', 'status_codes'])) {
        $data_result = $conn->query("SELECT * FROM `{$table}`");
        if ($data_result->num_rows > 0) {
            echo "-- Dumping data for table `{$table}`\n\n";
            echo "INSERT INTO `{$table}` VALUES ";
            
            $first = true;
            while ($row = $data_result->fetch_assoc()) {
                if (!$first) echo ",";
                $first = false;
                
                echo "\n(";
                $values = array_map(function($value) use ($conn) {
                    return $value === null ? 'NULL' : "'" . $conn->real_escape_string($value) . "'";
                }, array_values($row));
                echo implode(',', $values);
                echo ")";
            }
            echo ";\n\n";
        }
    }
    */
}

// Get the buffer content
$sql = ob_get_clean();

// Save to file
file_put_contents($output_file, $sql);

echo "Schema exported to {$output_file}\n";

// Close the connection
$conn->close();
