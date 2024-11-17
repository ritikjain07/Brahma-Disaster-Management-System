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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $age = sanitize_input($_POST["age"]);
    $dob = sanitize_input($_POST["dob"]);
    $sex = sanitize_input($_POST["sex"]);
    $gender = sanitize_input($_POST["gender"]);
    $government_id = sanitize_input($_POST["government_id"]);
    $description = sanitize_input($_POST["description"]);
    
    // File upload handling
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = $target_file;
            $sql = "INSERT INTO MissingPersons (first_name, last_name, age, dob, sex, gender, government_id, description, image_url) 
                    VALUES ('$first_name', '$last_name', '$age', '$dob', '$sex', '$gender', '$government_id', '$description', '$image_url')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Your request has been sent'); window.location.href = 'missing_person.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Missing Person</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .background {
      background-image: url('bgidn.jpg'); /* Path to your background image */
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="background bg-gray-100">
  <div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold text-center mb-4">Report Missing Person</h2>
      <p class="text-gray-700 text-center mb-6">Please fill out the form below to report a missing person. Provide as much detail as possible.</p>

      <!-- Form -->
      <form id="missingPersonForm" action="" method="post" enctype="multipart/form-data" class="space-y-4">
        <div class="mb-4">
          <label for="first_name" class="block text-gray-700 font-bold mb-2">First Name</label>
          <input type="text" id="first_name" name="first_name" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none" required>
        </div>
        <div class="mb-4">
          <label for="last_name" class="block text-gray-700 font-bold mb-2">Last Name</label>
          <input type="text" id="last_name" name="last_name" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none" required>
        </div>
        <!-- <div class="mb-4">
          <label for="age" class="block text-gray-700 font-bold mb-2">Age</label>
          <input type="number" id="age" name="age" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none">
        </div> -->
        <div class="mb-4">
          <label for="dob" class="block text-gray-700 font-bold mb-2">Date of Birth</label>
          <input type="date" id="dob" name="dob" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none">
        </div>
        <div class="mb-4">
          <label for="sex" class="block text-gray-700 font-bold mb-2">Gender</label>
          <select id="sex" name="sex" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none">
            <option value="">Select</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="government_id" class="block text-gray-700 font-bold mb-2">Government ID (if available)</label>
          <input type="text" id="government_id" name="government_id" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none">
        </div>
        <div class="mb-4">
          <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
          <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none" rows="4" required></textarea>
        </div>
        <div class="mb-4">
          <label for="image" class="block text-gray-700 font-bold mb-2">Upload Image</label>
          <input type="file" id="image" name="image" accept="image/*" class="border border-gray-300 p-2 rounded-md focus:outline-none" required>
        </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 focus:outline-none">Submit</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>

