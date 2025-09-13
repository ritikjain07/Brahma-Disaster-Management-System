<?php
/**
 * MySQL to PostgreSQL Schema Export
 * 
 * This script exports your MySQL database schema in a PostgreSQL-compatible format.
 * It should be run locally to generate SQL that can be imported into your Render PostgreSQL database.
 */

// Load configuration
require_once(__DIR__ . '/../config/env.php');

// Check if config file exists
if (!defined('DB_HOST') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
    die("Database configuration not found. Make sure config.php is properly set up.");
}

// Connect to MySQL
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to convert MySQL data type to PostgreSQL
function convertDataType($mysql_type) {
    // Convert common MySQL types to PostgreSQL
    if (preg_match('/int\(\d+\)/', $mysql_type)) {
        return 'INTEGER';
    } elseif (preg_match('/varchar\((\d+)\)/', $mysql_type, $matches)) {
        return "VARCHAR({$matches[1]})";
    } elseif (preg_match('/text/', $mysql_type)) {
        return 'TEXT';
    } elseif (preg_match('/datetime/', $mysql_type)) {
        return 'TIMESTAMP';
    } elseif (preg_match('/timestamp/', $mysql_type)) {
        return 'TIMESTAMP';
    } elseif (preg_match('/date/', $mysql_type)) {
        return 'DATE';
    } elseif (preg_match('/decimal\((\d+),(\d+)\)/', $mysql_type, $matches)) {
        return "DECIMAL({$matches[1]},{$matches[2]})";
    } elseif (preg_match('/float/', $mysql_type)) {
        return 'FLOAT';
    } elseif (preg_match('/double/', $mysql_type)) {
        return 'DOUBLE PRECISION';
    } elseif (preg_match('/enum\((.*)\)/', $mysql_type, $matches)) {
        // Convert ENUM to VARCHAR
        return 'VARCHAR(255)';
    } elseif (preg_match('/blob/', $mysql_type)) {
        return 'BYTEA';
    } else {
        return $mysql_type;
    }
}

// Get all tables
$tables = array();
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Output file
$output_file = __DIR__ . '/postgresql_schema.sql';
$output = fopen($output_file, 'w');

// Create sequence for auto-increments
fwrite($output, "-- PostgreSQL schema for Brahma Disaster Management System\n");
fwrite($output, "-- Generated on " . date('Y-m-d H:i:s') . "\n\n");

// Process each table
foreach ($tables as $table) {
    // Get table creation info
    $create_table = $conn->query("SHOW CREATE TABLE `$table`")->fetch_assoc();
    $create_sql = $create_table['Create Table'];
    
    // Extract column definitions
    preg_match('/\((.*)\)(?:\s+ENGINE|\s*$)/s', $create_sql, $matches);
    $columns_sql = $matches[1];
    
    // Split into individual column definitions
    $columns = array();
    $current = '';
    $depth = 0;
    
    for ($i = 0; $i < strlen($columns_sql); $i++) {
        $char = $columns_sql[$i];
        
        if ($char == '(' || $char == '[') {
            $depth++;
        } elseif ($char == ')' || $char == ']') {
            $depth--;
        }
        
        if ($char == ',' && $depth == 0) {
            $columns[] = trim($current);
            $current = '';
        } else {
            $current .= $char;
        }
    }
    
    if (!empty($current)) {
        $columns[] = trim($current);
    }
    
    // Start PostgreSQL table creation
    fwrite($output, "-- Table structure for table $table\n");
    fwrite($output, "DROP TABLE IF EXISTS \"$table\" CASCADE;\n");
    fwrite($output, "CREATE TABLE \"$table\" (\n");
    
    $pg_columns = array();
    $has_auto_increment = false;
    $auto_increment_col = '';
    $primary_keys = array();
    
    // Process each column
    foreach ($columns as $column_def) {
        if (preg_match('/^PRIMARY KEY\s+\((.*)\)/', $column_def, $pk_matches)) {
            // Extract primary keys
            $keys = explode(',', $pk_matches[1]);
            foreach ($keys as $key) {
                $primary_keys[] = trim($key, '` ');
            }
            continue;
        } elseif (preg_match('/^KEY|^UNIQUE KEY|^CONSTRAINT|FOREIGN KEY/', $column_def)) {
            // Skip indexes and constraints for now
            continue;
        }
        
        // Regular column definition
        preg_match('/^`([^`]+)`\s+([^\s]+)(.*)$/', $column_def, $col_matches);
        
        if (!isset($col_matches[1])) {
            // Skip if not a regular column definition
            continue;
        }
        
        $column_name = $col_matches[1];
        $column_type = $col_matches[2];
        $column_extra = isset($col_matches[3]) ? $col_matches[3] : '';
        
        // Convert to PostgreSQL data type
        $pg_type = convertDataType($column_type);
        
        // Handle AUTO_INCREMENT
        if (strpos($column_extra, 'AUTO_INCREMENT') !== false) {
            $has_auto_increment = true;
            $auto_increment_col = $column_name;
            
            // Use SERIAL for auto_increment
            $pg_type = 'SERIAL';
            
            // Remove AUTO_INCREMENT from the extra part
            $column_extra = str_replace('AUTO_INCREMENT', '', $column_extra);
        }
        
        // Handle NOT NULL
        $is_not_null = strpos($column_extra, 'NOT NULL') !== false;
        
        // Handle DEFAULT values
        $default_value = '';
        if (preg_match('/DEFAULT\s+([^ ]+)/', $column_extra, $default_matches)) {
            $default_val = $default_matches[1];
            
            // Handle special defaults
            if ($default_val === 'NULL') {
                $default_value = 'DEFAULT NULL';
            } elseif ($default_val === 'CURRENT_TIMESTAMP') {
                $default_value = 'DEFAULT CURRENT_TIMESTAMP';
            } elseif (is_numeric($default_val)) {
                $default_value = "DEFAULT $default_val";
            } else {
                $default_value = "DEFAULT '$default_val'";
            }
        }
        
        $pg_column = "  \"$column_name\" $pg_type";
        if ($is_not_null) {
            $pg_column .= " NOT NULL";
        }
        if (!empty($default_value)) {
            $pg_column .= " $default_value";
        }
        
        $pg_columns[] = $pg_column;
    }
    
    // Add primary key constraint
    if (!empty($primary_keys)) {
        $pk_list = implode(', ', array_map(function($pk) { return "\"$pk\""; }, $primary_keys));
        $pg_columns[] = "  PRIMARY KEY ($pk_list)";
    }
    
    // Write column definitions
    fwrite($output, implode(",\n", $pg_columns) . "\n);\n\n");
    
    // Add sequence if needed (for auto_increment)
    if ($has_auto_increment && !empty($auto_increment_col)) {
        fwrite($output, "-- Create sequence for $auto_increment_col in $table\n");
        fwrite($output, "CREATE SEQUENCE IF NOT EXISTS \"{$table}_{$auto_increment_col}_seq\";\n");
        fwrite($output, "ALTER TABLE \"$table\" ALTER COLUMN \"$auto_increment_col\" SET DEFAULT nextval('{$table}_{$auto_increment_col}_seq');\n\n");
    }
}

// Close file and connection
fclose($output);
$conn->close();

echo "PostgreSQL schema exported to $output_file\n";
?>
