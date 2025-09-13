<?php
require_once('database/config.php');

if ($conn) {
    echo "Database connection successful!\n";
    
    // Check if donations table exists
    $result = $conn->query("SHOW TABLES LIKE 'donations'");
    
    if ($result->num_rows > 0) {
        echo "Donations table exists.\n";
        
        // Show table structure
        $result = $conn->query("DESCRIBE donations");
        echo "Table structure:\n";
        while($row = $result->fetch_assoc()) {
            echo $row['Field'] . ' - ' . $row['Type'] . "\n";
        }
    } else {
        echo "Creating donations table...\n";
        
        $sql = "CREATE TABLE IF NOT EXISTS donations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            payment_id VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Donations table created successfully.\n";
        } else {
            echo "Error creating table: " . $conn->error . "\n";
        }
    }
    
    $conn->close();
} else {
    echo "Database connection failed.\n";
}
?>
