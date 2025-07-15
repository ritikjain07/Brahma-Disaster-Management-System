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

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize variables for form data
$disaster_type = $urgency = $additional_info = $image = "";

// Alert message
$alert_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $disaster_type = sanitize_input($_POST["disaster_type"]);
    $urgency = sanitize_input($_POST["urgency"]);
    $additional_info = sanitize_input($_POST["message"]);

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
            $alert_message = "Sorry, your file is too large.";
        } else {
            // Allow certain file formats
            $allowed_types = ["jpg", "jpeg", "png", "gif"];
            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = $target_file;
                } else {
                    $alert_message = "Sorry, there was an error uploading your file.";
                }
            } else {
                $alert_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }
    }

    if (empty($alert_message)) {
        // SQL query to insert data into HelpRequests table
        $sql = "INSERT INTO HelpRequests (disaster_type, urgency_level, additional_info, image)
                VALUES ('$disaster_type', '$urgency', '$additional_info', '$image')";

        if ($conn->query($sql) === TRUE) {
            $alert_message = "Your request has been sent.";
            // Redirect to mapify.php after 2 seconds
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "mapify.php";
                    }, 2000);
                  </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Help Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#disaster_type').change(function() {
        if ($(this).val() === 'other') {
          $('#other_disaster_type').show().attr('required', true);
        } else {
          $('#other_disaster_type').hide().attr('required', false);
        }
      });
    });
  </script>
</head>
<body class="bg-gray-100 flex flex-col items-center">

  <!-- Header with centered logo and name -->
  <header class="bg-black text-white w-full py-4 shadow-md fixed top-0 z-50">
    <div class="container mx-auto px-4 flex justify-between items-center">
      <div class="flex items-center justify-center w-full">
        <img src="logo.png" alt="Brahma Logo" class="h-12 mr-2">
        <span class="text-2xl font-bold">Brahma</span>
      </div>
      <nav class="flex space-x-4">
        <a href="main.html" class="hover:text-blue-500 mx-2">Home</a>
        <!-- <a href="index.html#about" class="hover:text-blue-500 mx-2">About Us</a>
        <a href="index.html#services" class="hover:text-blue-500 mx-2">Services</a>
        <a href="donation2.html" class="hover:text-blue-500 mx-2">Donation</a>
        <a href="index.html#login" class="hover:text-blue-500 mx-2">Login</a> -->
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <div class="bg-zinc-950 flex flex-col items-center w-screen pt-24 px-4 md:px-0">
    <div class="text-center mt-16 mb-4">
      <h1 class="text-white text-2xl md:text-4xl font-bold">CALM DOWN, YOUR REQUEST HAS BEEN SENT</h1>
    </div>
    <div class="text-center mb-8">
      <p class="text-white text-lg md:text-2xl font-medium">Kindly provide the following information so we can assist you more effectively.</p>
    </div>
    <form id="helpForm" class="bg-white p-6 md:p-8 rounded-lg shadow-lg w-full max-w-lg" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
      <div class="mb-4">
        <label for="disaster_type" class="block text-gray-700 font-bold mb-2">Type of Disaster</label>
        <select id="disaster_type" name="disaster_type" class="w-full p-2 border border-gray-300 rounded-md" required>
          <option value="">Select a disaster</option>
          <option value="earthquake">Earthquake</option>
          <option value="flood">Flood</option>
          <option value="hurricane">Hurricane</option>
          <option value="wildfire">Wildfire</option>
          <option value="other">Other</option>
        </select>
        <input type="text" id="other_disaster_type" name="other_disaster_type" class="w-full p-2 border border-gray-300 rounded-md mt-2" placeholder="Please specify" style="display: none;">
      </div>
      <div class="mb-4">
        <label for="urgency" class="block text-gray-700 font-bold mb-2">Urgency Level</label>
        <select id="urgency" name="urgency" class="w-full p-2 border border-gray-300 rounded-md" required>
          <option value="">Select urgency level</option>
          <option value="immediate">Immediate</option>
          <option value="high">High</option>
          <option value="moderate">Moderate</option>
          <option value="low">Low</option>
        </select>
      </div>
      <div class="mb-4">
        <label for="message" class="block text-gray-700 font-bold mb-2">Additional Information</label>
        <textarea id="message" name="message" class="w-full p-2 border border-gray-300 rounded-md" rows="4"></textarea>
      </div>
      <div class="mb-4">
        <label for="image" class="block text-gray-700 font-bold mb-2">Upload Image</label>
        <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded-md" accept="image/*">
      </div>
      <div class="text-center">
        <button type="submit" name="submit" class="bg-black text-white font-bold py-2 px-4 rounded-md shadow-md hover:bg-gray-800">Submit</button>
      </div>
    </form>
    <div class="mt-4 text-center text-white">
      <p><?php echo $alert_message; ?></p>
    </div>
  </div>
</body>
</html>
