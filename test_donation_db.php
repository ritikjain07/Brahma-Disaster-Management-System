<?php
// Test donation insert
require_once('database/config.php');

if ($conn) {
    echo "Testing donation insert...\n";
    
    // Test data
    $name = "Test User";
    $email = "test@example.com";
    $amount = 100.00;
    $payment_id = "test_payment_123";
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO donations (name, email, amount, payment_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $email, $amount, $payment_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Donation inserted successfully!\n";
        echo "Donation ID: " . $stmt->insert_id . "\n";
        
        // Now test fetching recent donors
        echo "\nTesting recent donors fetch...\n";
        $sql = "SELECT name, amount FROM donations ORDER BY donation_date DESC LIMIT 5";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            echo "Recent donors found:\n";
            while($row = $result->fetch_assoc()) {
                echo "- " . $row['name'] . ": $" . $row['amount'] . "\n";
            }
        } else {
            echo "No recent donors found.\n";
        }
        
        // Test total calculations
        echo "\nTesting total calculations...\n";
        $sql = "SELECT SUM(amount) as total, COUNT(*) as count FROM donations";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "Total amount: $" . ($row['total'] ?? 0) . "\n";
            echo "Total donors: " . ($row['count'] ?? 0) . "\n";
        } else {
            echo "No totals calculated.\n";
        }
        
    } else {
        echo "Error inserting donation: " . $stmt->error . "\n";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Database connection failed.\n";
}
?>
