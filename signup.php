<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Brahma</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
    }
    
    .signup-container {
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
    
    .btn-signup {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      transition: all 0.3s ease;
    }
    
    .btn-signup:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.5);
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
    
    .form-section {
      transition: all 0.4s ease;
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
    
    /* Fix for the dropdown menu */
    select {
      color: white !important;
      background-color: rgba(31, 41, 55, 0.5) !important;
      padding-right: 2.5rem;
    }
    
    select option {
      background-color: #1f2937 !important;
      color: white !important;
      padding: 10px !important;
    }
    
    /* Fix for input text visibility */
    input::placeholder {
      color: rgba(209, 213, 219, 0.5) !important;
    }
    
    /* Force custom select styling for all browsers */
    select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.5rem center;
      background-size: 1.5em 1.5em;
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
<body class="bg-cover bg-center min-h-screen flex justify-center items-center py-10" style="background-image: url('bgidn.jpg')">
  <div class="signup-container p-8 md:p-10 rounded-xl shadow-2xl max-w-4xl w-full text-white animated fadeIn">
    <div class="flex justify-center mb-6">
      <img src="logo_brahma.png" alt="Brahma Logo" class="h-16 drop-shadow-lg">
    </div>
    
    <h1 class="text-3xl font-bold mb-2 text-center bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Create Your Account</h1>
    <p class="text-gray-400 text-center mb-8">Join Brahma and start your journey</p>
    
    <form id="signup-form" method="POST" action="" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="space-y-4">
          <h3 class="text-lg font-semibold text-indigo-300 mb-3 flex items-center">
            <i class="fas fa-user-circle mr-2"></i> Personal Information
          </h3>
          
          <div>
            <label for="first_name" class="block text-sm font-medium text-gray-300 mb-1">First Name</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-gray-500"></i>
              </div>
              <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" required 
                     class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
          </div>
          
          <div>
            <label for="last_name" class="block text-sm font-medium text-gray-300 mb-1">Last Name</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-gray-500"></i>
              </div>
              <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" required 
                     class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
          </div>
          
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
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-500"></i>
              </div>
              <input type="password" name="password" id="password" placeholder="Create a password" required 
                     class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <i class="fas fa-eye-slash text-gray-500 reveal-password" id="togglePassword"></i>
              </div>
            </div>
            <p class="text-xs text-gray-400 mt-1">Password must be at least 8 characters long</p>
          </div>
        </div>
        
        <!-- Contact Details -->
        <div class="space-y-4">
          <h3 class="text-lg font-semibold text-indigo-300 mb-3 flex items-center">
            <i class="fas fa-address-card mr-2"></i> Contact Details
          </h3>
          
          <div>
            <label for="mobile" class="block text-sm font-medium text-gray-300 mb-1">Mobile Number</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-mobile-alt text-gray-500"></i>
              </div>
              <input type="text" name="mobile" id="mobile" placeholder="Enter your mobile number" required 
                     class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
          </div>
          
          <div>
            <label for="address" class="block text-sm font-medium text-gray-300 mb-1">Address</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-home text-gray-500"></i>
              </div>
              <input type="text" name="address" id="address" placeholder="Enter your address" required 
                     class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
          </div>
          
          <div>
            <label for="emergency_contact" class="block text-sm font-medium text-gray-300 mb-1">Emergency Contact</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-phone-alt text-gray-500"></i>
              </div>
              <input type="text" name="emergency_contact" id="emergency_contact" placeholder="Emergency contact number" 
                     class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
          </div>
          
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="blood_type" class="block text-sm font-medium text-indigo-300 mb-1">Blood Type</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-tint text-red-500"></i>
                </div>
                <select name="blood_type" id="blood_type" 
                       class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                  <option value="">Select</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                </select>
              </div>
            </div>
            
            <div>
              <label for="medical_conditions" class="block text-sm font-medium text-gray-300 mb-1">Medical Notes</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-notes-medical text-gray-500"></i>
                </div>
                <input type="text" name="medical_conditions" id="medical_conditions" placeholder="Any conditions" 
                       class="form-input pl-10 block w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="flex items-center mt-4">
        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-700 rounded bg-gray-800">
        <label for="terms" class="ml-2 block text-sm text-gray-300">I agree to the <a href="#" class="text-indigo-400 hover:text-indigo-300">Terms of Service</a> and <a href="#" class="text-indigo-400 hover:text-indigo-300">Privacy Policy</a></label>
      </div>
      
      <button type="submit" class="btn-signup w-full py-3 px-4 rounded-lg text-white font-semibold shadow-lg flex items-center justify-center">
        <i class="fas fa-user-plus mr-2"></i> Create Account
      </button>
    </form>
    
    <div id="success-message" class="mt-4 py-3 px-4 bg-green-500/20 border border-green-500 text-green-400 rounded-lg text-center hidden">
      <i class="fas fa-check-circle mr-2"></i> Sign up successful! Please wait while we redirect you.
    </div>
    <div id="error-message" class="mt-4 py-3 px-4 bg-red-500/20 border border-red-500 text-red-400 rounded-lg text-center hidden">
      <i class="fas fa-exclamation-circle mr-2"></i> Error: Unable to sign up. Please try again.
    </div>
    
    <div class="mt-8 text-center">
      <p class="text-gray-400">Already have an account? <a href="login.php" class="text-indigo-400 hover:text-indigo-300 font-medium">Sign in</a></p>
    </div>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const email = localStorage.getItem('email');
      if (email) {
        document.querySelector('input[name="email"]').value = email;
      }
      
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
        
        document.querySelectorAll('select').forEach(select => {
          select.style.color = 'white';
          select.style.backgroundColor = 'rgba(31, 41, 55, 0.5)';
          select.style.borderColor = 'rgba(75, 85, 99, 0.5)';
        });
      };
      
      // Apply styling initially
      forceInputStyling();
      
      // Apply styling whenever inputs receive focus or change
      document.querySelectorAll('input, select').forEach(element => {
        element.addEventListener('focus', forceInputStyling);
        element.addEventListener('change', forceInputStyling);
        element.addEventListener('input', forceInputStyling);
      });
      
      // Handle select dropdown styling for options
      document.querySelectorAll('select').forEach(select => {
        // Force correct styling on the select element
        select.addEventListener('mousedown', function() {
          setTimeout(() => {
            document.querySelectorAll('option').forEach(option => {
              option.style.backgroundColor = '#1f2937';
              option.style.color = 'white';
              option.style.padding = '10px';
            });
          }, 0);
        });
      });
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
        echo 'document.getElementById("error-message").classList.remove("hidden");';
        echo 'document.getElementById("error-message").textContent = "Connection failed: Database error.";';
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
        echo 'document.getElementById("success-message").classList.remove("hidden");';
        echo 'setTimeout(function() { window.location.href = "index.php"; }, 2000);';
      } else {
        echo 'document.getElementById("error-message").classList.remove("hidden");';
        echo 'document.getElementById("error-message").textContent = "Error: ' . $stmt->error . '";';
      }

      $stmt->close();
      $conn->close();
    }
    ?>
  </script>
</body>
</html>