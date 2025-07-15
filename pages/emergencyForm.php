<?php
// Start session to access session variables
session_start();

// Include database connection
include 'includes/dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$success_message = '';
$error_message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $emergency_contact_name = mysqli_real_escape_string($conn, $_POST['emergency_contact_name']);
    $relationship = mysqli_real_escape_string($conn, $_POST['relationship']);
    $emergency_phone = mysqli_real_escape_string($conn, $_POST['emergency_phone']);
    $emergency_email = mysqli_real_escape_string($conn, $_POST['emergency_email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $medical_conditions = mysqli_real_escape_string($conn, $_POST['medical_conditions']);
    $allergies = mysqli_real_escape_string($conn, $_POST['allergies']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $userid = $_SESSION['userid'];

    // Check if record already exists
    $check_query = "SELECT * FROM emergency_contacts WHERE userid = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $userid);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing record
        $query = "UPDATE emergency_contacts SET 
                  emergency_contact_name = ?, 
                  relationship = ?, 
                  emergency_phone = ?, 
                  emergency_email = ?, 
                  address = ?, 
                  medical_conditions = ?, 
                  allergies = ?, 
                  blood_group = ? 
                  WHERE userid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssi", $emergency_contact_name, $relationship, $emergency_phone, 
                         $emergency_email, $address, $medical_conditions, $allergies, $blood_group, $userid);
        
        if ($stmt->execute()) {
            $success_message = "Emergency information updated successfully!";
        } else {
            $error_message = "Error updating emergency information: " . $conn->error;
        }
    } else {
        // Insert new record
        $query = "INSERT INTO emergency_contacts (userid, emergency_contact_name, relationship, emergency_phone, 
                 emergency_email, address, medical_conditions, allergies, blood_group) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issssssss", $userid, $emergency_contact_name, $relationship, $emergency_phone, 
                         $emergency_email, $address, $medical_conditions, $allergies, $blood_group);
        
        if ($stmt->execute()) {
            $success_message = "Emergency information saved successfully!";
        } else {
            $error_message = "Error saving emergency information: " . $conn->error;
        }
    }
}

// Fetch existing data if available
$user_id = $_SESSION['userid'];
$query = "SELECT * FROM emergency_contacts WHERE userid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $emergency_data = $result->fetch_assoc();
} else {
    // Initialize empty data
    $emergency_data = [
        'emergency_contact_name' => '',
        'relationship' => '',
        'emergency_phone' => '',
        'emergency_email' => '',
        'address' => '',
        'medical_conditions' => '',
        'allergies' => '',
        'blood_group' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Contact Information - Brahma</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Emergency Contact Information</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="mb-3">
                                <label for="emergency_contact_name" class="form-label">Emergency Contact Name *</label>
                                <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" 
                                       value="<?php echo htmlspecialchars($emergency_data['emergency_contact_name']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="relationship" class="form-label">Relationship *</label>
                                <input type="text" class="form-control" id="relationship" name="relationship" 
                                       value="<?php echo htmlspecialchars($emergency_data['relationship']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="emergency_phone" class="form-label">Emergency Phone Number *</label>
                                <input type="tel" class="form-control" id="emergency_phone" name="emergency_phone" 
                                       value="<?php echo htmlspecialchars($emergency_data['emergency_phone']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="emergency_email" class="form-label">Emergency Email</label>
                                <input type="email" class="form-control" id="emergency_email" name="emergency_email" 
                                       value="<?php echo htmlspecialchars($emergency_data['emergency_email']); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($emergency_data['address']); ?></textarea>
                            </div>
                            
                            <hr class="my-4">
                            <h5>Medical Information</h5>
                            
                            <div class="mb-3">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <select class="form-select" id="blood_group" name="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+" <?php if($emergency_data['blood_group'] == 'A+') echo 'selected'; ?>>A+</option>
                                    <option value="A-" <?php if($emergency_data['blood_group'] == 'A-') echo 'selected'; ?>>A-</option>
                                    <option value="B+" <?php if($emergency_data['blood_group'] == 'B+') echo 'selected'; ?>>B+</option>
                                    <option value="B-" <?php if($emergency_data['blood_group'] == 'B-') echo 'selected'; ?>>B-</option>
                                    <option value="AB+" <?php if($emergency_data['blood_group'] == 'AB+') echo 'selected'; ?>>AB+</option>
                                    <option value="AB-" <?php if($emergency_data['blood_group'] == 'AB-') echo 'selected'; ?>>AB-</option>
                                    <option value="O+" <?php if($emergency_data['blood_group'] == 'O+') echo 'selected'; ?>>O+</option>
                                    <option value="O-" <?php if($emergency_data['blood_group'] == 'O-') echo 'selected'; ?>>O-</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="medical_conditions" class="form-label">Medical Conditions</label>
                                <textarea class="form-control" id="medical_conditions" name="medical_conditions" rows="3"
                                         placeholder="List any medical conditions that emergency personnel should be aware of"><?php echo htmlspecialchars($emergency_data['medical_conditions']); ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="allergies" class="form-label">Allergies</label>
                                <textarea class="form-control" id="allergies" name="allergies" rows="3"
                                         placeholder="List any allergies to medications, food, etc."><?php echo htmlspecialchars($emergency_data['allergies']); ?></textarea>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Save Emergency Information</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>