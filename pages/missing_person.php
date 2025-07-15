<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brahma_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($dbname);
} else {
    die("Error creating database: " . $conn->error);
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS MissingPersons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    age INT,
    dob DATE,
    sex CHAR(1),
    gender VARCHAR(50),
    government_id VARCHAR(100),
    description TEXT,
    image_url VARCHAR(255) NOT NULL,
    reported_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle form submission
$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $age = isset($_POST["age"]) ? sanitize_input($_POST["age"]) : null;
    $dob = sanitize_input($_POST["dob"]);
    $sex = sanitize_input($_POST["sex"]);
    $gender = isset($_POST["gender"]) ? sanitize_input($_POST["gender"]) : null;
    $government_id = sanitize_input($_POST["government_id"]);
    $description = sanitize_input($_POST["description"]);
    
    // Calculate age if DOB is provided
    if (!empty($dob) && empty($age)) {
        $birthdate = new DateTime($dob);
        $today = new DateTime('today');
        $age = $birthdate->diff($today)->y;
    }
    
    // File upload handling
    $target_dir = "uploads/missing_persons/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    // Create a unique filename using timestamp and random number
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $unique_filename = time() . '_' . rand(1000, 9999) . '.' . $imageFileType;
    $target_file = $target_dir . $unique_filename;
    
    $uploadOk = 1;

    // Check if image file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $error_message = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
        $error_message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        if (empty($error_message)) {
            $error_message = "Sorry, your file was not uploaded.";
        }
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = $target_file;
            
            // Prepare statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO MissingPersons (first_name, last_name, age, dob, sex, gender, government_id, description, image_url) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->bind_param("ssissssss", $first_name, $last_name, $age, $dob, $sex, $gender, $government_id, $description, $image_url);
            
            if ($stmt->execute()) {
                $success_message = "Your missing person report has been submitted successfully.";
            } else {
                $error_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Missing Person | Brahma</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .bg-gradient {
      background: linear-gradient(135deg, #4f46e5 0%, #9333ea 100%);
    }
    
    .form-container {
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
    }
    
    .input-field {
      @apply w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200;
    }
    
    .input-label {
      @apply block text-gray-700 font-medium mb-2;
    }
    
    .btn-primary {
      @apply bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50;
    }
    
    .image-preview {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #6366f1;
      padding: 2px;
    }
    
    .file-upload {
      position: relative;
      overflow: hidden;
      display: inline-block;
      width: 100%;
    }
    
    .file-upload input[type=file] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    
    .file-upload-label {
      @apply flex items-center justify-center p-3 border-2 border-dashed border-indigo-300 rounded-lg text-indigo-600 bg-indigo-50 hover:bg-indigo-100 transition duration-300;
    }
    
    body {
      background-image: url('bgidn.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      min-height: 100vh;
    }
    
    .header-text {
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .success-banner {
      background-color: rgba(16, 185, 129, 0.9);
    }
    
    .error-banner {
      background-color: rgba(239, 68, 68, 0.9);
    }
  </style>
</head>
<body class="bg-gray-100">
  
  <!-- Navigation -->
  <nav class="bg-gradient shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <a href="index.php" class="text-white font-bold text-xl">
            <img src="logo.png" alt="Brahma Logo" class="h-8 w-auto inline-block mr-2">
            Brahma
          </a>
        </div>
        <div class="flex space-x-4">
          <a href="index.php" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium">Home</a>
          <a href="mapify.php" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium">Map</a>
          <a href="search.php" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium">Search</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Success/Error Messages -->
  <?php if (!empty($success_message)): ?>
  <div class="success-banner text-white p-4 text-center">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
      <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <?php echo $success_message; ?>
      </div>
      <button onclick="this.parentElement.parentElement.style.display='none'" class="focus:outline-none">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if (!empty($error_message)): ?>
  <div class="error-banner text-white p-4 text-center">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
      <div class="flex items-center">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <?php echo $error_message; ?>
      </div>
      <button onclick="this.parentElement.parentElement.style.display='none'" class="focus:outline-none">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <?php endif; ?>

  <!-- Main Content -->
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="form-container max-w-4xl w-full space-y-8 p-10 rounded-xl shadow-2xl">
      <div class="text-center">
        <h2 class="text-3xl font-extrabold text-indigo-900 header-text mb-2">Report Missing Person</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Please provide as much information as possible to help locate the missing person. Your cooperation can make a significant difference.</p>
        <div class="flex justify-center my-6">
          <div class="w-20 h-1 bg-indigo-600 rounded-full"></div>
        </div>
      </div>

      <!-- Form -->
      <form id="missingPersonForm" action="" method="post" enctype="multipart/form-data" class="mt-8 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Left Column -->
          <div class="space-y-6">
            <div>
              <label for="first_name" class="input-label">First Name <span class="text-red-500">*</span></label>
              <input type="text" id="first_name" name="first_name" class="input-field" required>
            </div>
            
            <div>
              <label for="last_name" class="input-label">Last Name <span class="text-red-500">*</span></label>
              <input type="text" id="last_name" name="last_name" class="input-field" required>
            </div>
            
            <div>
              <label for="dob" class="input-label">Date of Birth</label>
              <input type="date" id="dob" name="dob" class="input-field">
            </div>
            
            <div>
              <label for="sex" class="input-label">Gender</label>
              <select id="sex" name="sex" class="input-field">
                <option value="">Select</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
              </select>
            </div>
            
            <div>
              <label for="government_id" class="input-label">Government ID (if available)</label>
              <input type="text" id="government_id" name="government_id" class="input-field" placeholder="Aadhar, Passport, Driver's License, etc.">
            </div>
          </div>
          
          <!-- Right Column -->
          <div class="space-y-6">
            <div class="flex flex-col items-center justify-center h-48 mb-4">
              <img id="preview" class="image-preview mb-2 hidden" src="#" alt="Image Preview">
              <div class="file-upload w-full">
                <label for="image" class="file-upload-label">
                  <i class="fas fa-cloud-upload-alt mr-2"></i>
                  <span id="file-chosen">Choose a photo</span>
                  <input type="file" id="image" name="image" accept="image/*" class="hidden" required onchange="previewImage()">
                </label>
              </div>
              <p class="text-xs text-gray-500 mt-2">JPG, JPEG, PNG or GIF - Max 5MB</p>
            </div>
            
            <div>
              <label for="description" class="input-label">Description <span class="text-red-500">*</span></label>
              <textarea id="description" name="description" class="input-field" rows="6" required 
                placeholder="Please include details such as:
- Height and weight
- Clothing last seen wearing
- Identifying features (scars, tattoos, etc.)
- Location last seen
- Any medical conditions
- Any other relevant information"></textarea>
            </div>
          </div>
        </div>
        
        <div class="flex justify-end pt-4">
          <button type="submit" class="btn-primary">
            <i class="fas fa-paper-plane mr-2"></i> Submit Report
          </button>
        </div>
      </form>
      
      <div class="text-center mt-8 text-sm text-gray-500">
        <p>By submitting this form, you confirm that all information provided is accurate to the best of your knowledge.</p>
        <p class="mt-2">For urgent situations, please also contact your local law enforcement.</p>
      </div>
    </div>
  </div>
  
  <!-- Footer -->
  <footer class="bg-gradient text-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
          <p>&copy; 2025 Brahma Disaster Management. All rights reserved.</p>
        </div>
        <div class="flex space-x-6">
          <a href="#" class="text-white hover:text-indigo-200">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="text-white hover:text-indigo-200">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-white hover:text-indigo-200">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
  
  <script>
    function previewImage() {
      const preview = document.getElementById('preview');
      const file = document.getElementById('image').files[0];
      const fileChosen = document.getElementById('file-chosen');
      
      if (file) {
        fileChosen.textContent = file.name;
        preview.classList.remove('hidden');
        
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
      } else {
        fileChosen.textContent = 'Choose a photo';
        preview.classList.add('hidden');
      }
    }
  </script>
</body>
</html>