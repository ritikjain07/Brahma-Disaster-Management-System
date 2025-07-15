<?php
// Simple test file to check for errors
echo "PHP is working!<br>";

// Test database config
try {
    require_once 'database/config.php';
    echo "Database config loaded successfully!<br>";
} catch (Exception $e) {
    echo "Database config error: " . $e->getMessage() . "<br>";
}

// Test functions
try {
    require_once 'includes/functions.php';
    echo "Functions loaded successfully!<br>";
} catch (Exception $e) {
    echo "Functions error: " . $e->getMessage() . "<br>";
}

echo "All tests completed!";
?>
