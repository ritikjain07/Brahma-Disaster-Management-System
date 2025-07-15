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
        echo "<script>document.addEventListener('DOMContentLoaded', function() { showError('Please fill in all fields.'); });</script>";
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
                    document.addEventListener('DOMContentLoaded', function() { 
                        showSuccess('Login Successful! Redirecting...'); 
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 1500);
                    });
                  </script>";
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { showError('Invalid email or password.'); });</script>";
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
  <title>Login - Brahma</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
    }
    
    .login-container {
      background: rgba(15, 23, 42, 0.85);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .form-input {
      transition: all 0.3s ease;
      color: white !important;
    }
    
    .form-input:focus {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.5);
    }
    
    .btn-login {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      transition: all 0.3s ease;
    }
    
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.5);
    }
    
    .social-btn {
      transition: all 0.3s ease;
    }
    
    .social-btn:hover {
      transform: translateY(-2px);
    }

    .animated {
      animation-duration: 0.5s;
      animation-fill-mode: both;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fadeIn {
      animation-name: fadeIn;
    }

    .reveal-password {
      cursor: pointer;
    }
    
    /* Custom form styling for better visibility */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    select,
    textarea {
      background-color: rgba(31, 41, 55, 0.5) !important;
      color: white !important;
      border-color: rgba(75, 85, 99, 0.5) !important;
    }
    
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    select:focus,
    textarea:focus {
      border-color: rgba(99, 102, 241, 0.7) !important;
      background-color: rgba(31, 41, 55, 0.7) !important;
    }
    
    /* Fix for input text visibility */
    input::placeholder {
      color: rgba(209, 213, 219, 0.5) !important;
    }
    
    /* Custom checkbox styling */
    input[type="checkbox"] {
      background-color: rgba(31, 41, 55, 0.5);
      border-color: rgba(75, 85, 99, 0.7);
    }
    
    /* Ensure text input remains visible when focused */
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus {
      -webkit-text-fill-color: white;
      transition: background-color 5000s ease-in-out 0s;
      box-shadow: 0 0 0 30px rgba(31, 41, 55, 0.5) inset !important;
    }
  </style>
</head>
<body class="bg-cover bg-center h-screen flex justify-center items-center" style="background-image: url('bgidn.jpg')">
  <div class="login-container p-10 rounded-xl shadow-2xl max-w-md w-full text-white animated fadeIn">
    <div class="flex justify-center mb-8">
      <img src="logo_brahma.png" alt="Brahma Logo" class="h-20 drop-shadow-lg">
    </div>
    
    <h1 class="text-3xl font-bold mb-2 text-center bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Welcome Back</h1>
    <p class="text-gray-400 text-center mb-8">Sign in to continue your journey</p>
    
    <form id="login-form" method="POST" action="" class="space-y-6">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-envelope text-gray-500"></i>
          </div>
          <input type="email" name="email" id="email" placeholder="Enter your email" required 
                 class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
      </div>
      
      <div>
        <div class="flex justify-between mb-1">
          <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
          <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300">Forgot Password?</a>
        </div>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-lock text-gray-500"></i>
          </div>
          <input type="password" name="password" id="password" placeholder="Enter your password" required 
                 class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <i class="fas fa-eye-slash text-gray-500 reveal-password" id="togglePassword"></i>
          </div>
        </div>
      </div>
      
      <div class="flex items-center">
        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-700 rounded bg-gray-800">
        <label for="remember-me" class="ml-2 block text-sm text-gray-300">Remember me</label>
      </div>
      
      <button type="submit" class="btn-login w-full py-3 px-4 rounded-lg text-white font-semibold shadow-lg">
        Sign In
      </button>
    </form>
    
    <div class="relative flex py-5 items-center mt-6">
      <div class="flex-grow border-t border-gray-700"></div>
      <span class="flex-shrink mx-4 text-gray-400 text-sm">or continue with</span>
      <div class="flex-grow border-t border-gray-700"></div>
    </div>
    
    <div class="grid grid-cols-3 gap-4 mt-6">
      <button class="social-btn flex justify-center items-center py-2 px-4 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700">
        <i class="fab fa-google text-red-500"></i>
      </button>
      <button class="social-btn flex justify-center items-center py-2 px-4 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700">
        <i class="fab fa-facebook text-blue-500"></i>
      </button>
      <button class="social-btn flex justify-center items-center py-2 px-4 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700">
        <i class="fab fa-apple text-white"></i>
      </button>
    </div>
    
    <div class="mt-8 text-center">
      <p class="text-gray-400">Don't have an account? <a href="signup.php" class="text-indigo-400 hover:text-indigo-300 font-medium">Sign up</a></p>
    </div>
    
    <div id="success-message" class="mt-4 py-3 px-4 bg-green-500/20 border border-green-500 text-green-400 rounded-lg text-center hidden"></div>
    <div id="error-message" class="mt-4 py-3 px-4 bg-red-500/20 border border-red-500 text-red-400 rounded-lg text-center hidden"></div>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Toggle password visibility
      document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this;
        
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        } else {
          passwordInput.type = 'password';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        }
      });
      
      // Force styling on all form elements to ensure visibility
      const forceInputStyling = () => {
        document.querySelectorAll('input:not([type="checkbox"]):not([type="radio"])').forEach(input => {
          input.style.color = 'white';
          input.style.backgroundColor = 'rgba(31, 41, 55, 0.5)';
          input.style.borderColor = 'rgba(75, 85, 99, 0.5)';
        });
      };
      
      // Apply styling initially
      forceInputStyling();
      
      // Apply styling whenever inputs receive focus or change
      document.querySelectorAll('input').forEach(element => {
        element.addEventListener('focus', forceInputStyling);
        element.addEventListener('change', forceInputStyling);
        element.addEventListener('input', forceInputStyling);
      });
      
      // Remember email if saved in localStorage
      const savedEmail = localStorage.getItem('rememberedEmail');
      if (savedEmail) {
        document.getElementById('email').value = savedEmail;
        document.getElementById('remember-me').checked = true;
      }
      
      // Save email to localStorage if remember-me is checked
      document.getElementById('login-form').addEventListener('submit', function() {
        const email = document.getElementById('email').value;
        const rememberMe = document.getElementById('remember-me').checked;
        
        if (rememberMe) {
          localStorage.setItem('rememberedEmail', email);
        } else {
          localStorage.removeItem('rememberedEmail');
        }
      });
    });
    
    // Function to show success message
    function showSuccess(message) {
      const successDiv = document.getElementById('success-message');
      successDiv.textContent = message;
      successDiv.classList.remove('hidden');
      setTimeout(() => successDiv.classList.add('hidden'), 5000);
    }
    
    // Function to show error message
    function showError(message) {
      const errorDiv = document.getElementById('error-message');
      errorDiv.textContent = message;
      errorDiv.classList.remove('hidden');
      setTimeout(() => errorDiv.classList.add('hidden'), 5000);
    }
  </script>
</body>
</html>
