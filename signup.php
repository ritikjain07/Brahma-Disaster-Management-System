<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-Up Page - Brahma</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-cover bg-center h-screen flex justify-center items-center" style="background-image: url('bgidn.jpg')">
  <div class="bg-gray-900 bg-opacity-75 p-10 rounded-lg shadow-lg max-w-4xl w-full text-white">
    <div class="flex justify-center mb-6">
      <img src="logo_brahma.png" alt="Brahma Logo" class="h-16">
    </div>
    <h1 class="text-3xl font-semibold mb-6 text-center">Sign Up - Brahma</h1>
    <form id="signup-form" method="POST" action="" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="first_name" class="block text-sm font-medium">First Name</label>
          <input type="text" name="first_name" id="first_name" placeholder="First Name" required class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
        </div>
        <div>
          <label for="last_name" class="block text-sm font-medium">Last Name</label>
          <input type="text" name="last_name" id="last_name" placeholder="Last Name" required class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
        </div>
        <div>
          <label for="mobile" class="block text-sm font-medium">Mobile</label>
          <input type="text" name="mobile" id="mobile" placeholder="Mobile" required class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
        </div>
        <div>
          <label for="email" class="block text-sm font-medium">Email</label>
          <input type="email" name="email" id="email" placeholder="Email" required class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
        </div>
        <div>
          <label for="address" class="block text-sm font-medium">Address</label>
          <input type="text" name="address" id="address" placeholder="Address" required class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium">Password</label>
          <input type="password" name="password" id="password" placeholder="Password" required class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
        </div>
        <div>
          <label for="emergency_contact" class="block text-sm font-medium">Emergency Contact</label>
          <input type="text" name="emergency_contact" id="emergency_contact" placeholder="Emergency Contact" class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
        </div>
        <div>
          <label for="blood_type" class="block text-sm font-medium">Blood Type</label>
          <input type="text" name="blood_type" id="blood_type" placeholder="Blood Type" class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
        </div>
        <div>
          <label for="medical_conditions" class="block text-sm font-medium">Medical Conditions</label>
          <textarea name="medical_conditions" id="medical_conditions" placeholder="Medical Conditions" class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500"></textarea>
        </div>
      </div>
      <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 rounded-md text-white font-semibold transition duration-300">Submit</button>
    </form>
    <div class="success-message mt-4 text-green-500 hidden">Sign Up Successful! Please verify your OTP.</div>
    <div class="error-message mt-4 text-red-500 hidden">Error: Unable to sign up.</div>
    
    <!-- "Already have an account?" section -->
    <div class="mt-6 text-center">
      <p class="text-sm text-gray-400">Already have an account?</p>
      <a href="login.php" class="text-indigo-400 hover:text-indigo-300">Login here</a>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const email = localStorage.getItem('email');
      if (email) {
        document.querySelector('input[name="email"]').value = email;
      }
    });

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $servername = "localhost";
      $username = "root"; // default username for XAMPP
      $password = ""; // default password for XAMPP
      $dbname = "brahma_db"; // replace with your database name

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        echo 'document.querySelector(".error-message").classList.remove("hidden");';
        die("Connection failed: " . $conn->connect_error);
      }

      // Prepare and bind
      $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, mobile, email, address, password, emergency_contact, blood_type, medical_conditions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssssss", $first_name, $last_name, $mobile, $email, $address, $password_hash, $emergency_contact, $blood_type, $medical_conditions);

      // Set parameters and execute
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $emergency_contact = $_POST['emergency_contact'] ?? null;
      $blood_type = $_POST['blood_type'] ?? null;
      $medical_conditions = $_POST['medical_conditions'] ?? null;

      if ($stmt->execute()) {
        echo 'document.querySelector(".success-message").classList.remove("hidden");';
        echo 'window.location.href = "index.php";';
      } else {
        echo 'document.querySelector(".error-message").classList.remove("hidden");';
      }

      $stmt->close();
      $conn->close();
    }
    ?>
  </script>
</body>
</html>
