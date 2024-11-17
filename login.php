<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$database = "brahma_db";

// Create a connection
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Start the session and store user information
            $_SESSION['user_id'] = $id;
            $_SESSION['user_email'] = $email;
            
            echo "<script>
                    alert('Login Successful! Redirecting...');
                    window.location.href = 'index.php'; // Redirect to the index page
                  </script>";
        } else {
            echo "<script>alert('Error: Invalid email or password.');</script>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page - Brahma</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-cover bg-center h-screen flex justify-center items-center" style="background-image: url('bgidn.jpg')">
  <div class="bg-gray-900 bg-opacity-75 p-10 rounded-lg shadow-lg max-w-md w-full text-white">
    <div class="flex justify-center mb-6">
      <img src="logo_brahma.png" alt="Brahma Logo" class="h-16">
    </div>
    <h1 class="text-3xl font-semibold mb-6 text-center">Login - Brahma</h1>
    <form id="login-form" method="POST" action="" class="space-y-4">
      <div>
        <label for="email" class="block text-sm font-medium">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
      </div>
      <div>
        <label for="password" class="block text-sm font-medium">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:outline-none focus:ring focus:ring-indigo-500">
      </div>
      <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 rounded-md text-white font-semibold transition duration-300">Login</button>
    </form>
    <div class="mt-4 text-center">
      <p class="text-sm">Don't have an account? <br><a href="signup.php" class="text-indigo-400 hover:text-indigo-300">Sign up here</a></p>
    </div>
    <div class="success-message mt-4 text-green-500 hidden">Login Successful! Redirecting...</div>
    <div class="error-message mt-4 text-red-500 hidden">Error: Invalid email or password.</div>
  </div>
</body>
</html>
