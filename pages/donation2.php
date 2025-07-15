<?php
session_start();

// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if PHPMailer files exist and load them
$phpmailer_available = false;
if (file_exists('../libs/PHPMailer-master/src/Exception.php') && 
    file_exists('../libs/PHPMailer-master/src/PHPMailer.php') && 
    file_exists('../libs/PHPMailer-master/src/SMTP.php')) {
    
    require '../libs/PHPMailer-master/src/Exception.php';
    require '../libs/PHPMailer-master/src/PHPMailer.php';
    require '../libs/PHPMailer-master/src/SMTP.php';
    
    $phpmailer_available = true;
}

// Database connection
require_once('../database/config.php');

// Ensure we have a valid connection
if (!$conn || $conn->connect_error) {
    die("Database connection failed. Please try again later.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure we have a valid connection before processing
    if (!$conn || $conn->connect_error) {
        die("Database connection failed. Please try again later.");
    }

    // Get form data (sanitize input if necessary)
    $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $payment_id = $_POST['payment_id']; // This should be set by Razorpay response

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO donations (name, email, amount, payment_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $email, $amount, $payment_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Send thank you email using PHPMailer (if available)
        if ($phpmailer_available) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'angshumanmahato@gmail.com';               // SMTP username
                $mail->Password   = 'jyqejqbntmadntjl';                  // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption, PHPMailer::ENCRYPTION_SMTPS also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('no-reply@brahma.com', 'Brahma');
                $mail->addAddress($email, $name);                           // Add a recipient

                // Content
                $mail->isHTML(true);                                        // Set email format to HTML
                $mail->Subject = 'Thank you for your donation!';
                $mail->Body    = "Dear $name,<br><br>Thank you for your generous donation of INR $amount to Brahma Disaster Management System. Your support helps us to continue our mission to leverage cutting-edge technology for effective disaster response and relief operations.<br><br>Best regards,<br>Brahma Team";

                $mail->send();
                //echo "<script>alert('Donation saved successfully and email sent');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Donation saved successfully but email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
            }
        } else {
            echo "<script>alert('Donation saved successfully! PHPMailer not available for email confirmation.');</script>";
        }
    } else {
        echo "<script>alert('Error saving donation');</script>";
    }

    $stmt->close();
}

// Fetch recent donors
$recent_donors = [];
if ($conn && !$conn->connect_error) {
    $sql = "SELECT name, amount FROM donations ORDER BY donation_date DESC LIMIT 5";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $recent_donors[] = $row;
        }
    }
} else {
    error_log("Database connection issue when fetching recent donors");
}

// Calculate total donations
$total_amount = 0;
$donor_count = 0;
if ($conn && !$conn->connect_error) {
    $sql = "SELECT SUM(amount) as total, COUNT(*) as count FROM donations";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_amount = $row['total'] ?? 0;
        $donor_count = $row['count'] ?? 0;
    }
} else {
    error_log("Database connection issue when calculating totals");
}

// Close the connection after all database operations are complete
if ($conn && !$conn->connect_error) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Donate to Brahma | Support Disaster Management</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    
    body {
      background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('../assets/images/bgidn.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
    
    .card-glassmorphism {
      background: rgba(15, 23, 42, 0.75);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    
    .hero-gradient {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.9) 0%, rgba(79, 70, 229, 0.8) 100%);
    }
    
    .donate-btn {
      background: linear-gradient(135deg, #f43f5e 0%, #ec4899 100%);
      transition: all 0.3s ease;
    }
    
    .donate-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px -5px rgba(244, 63, 94, 0.5);
    }
    
    .progress-bar {
      height: 10px;
      border-radius: 10px;
      background: linear-gradient(90deg, #f43f5e 0%, #ec4899 100%);
      transition: width 1.5s ease-in-out;
    }
    
    .animate-pulse-slow {
      animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.7; }
    }
    
    .animate-fadeIn {
      animation: fadeIn 1s ease-out forwards;
    }
    
    .animate-slideUp {
      animation: slideUp 0.8s ease-out forwards;
    }
    
    .donor-list li {
      transition: all 0.3s ease;
    }
    
    .donor-list li:hover {
      transform: translateX(5px);
    }
    
    .stat-card {
      transition: all 0.3s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
    }
    
    /* Custom form styling */
    input {
      transition: all 0.3s ease;
      color: white !important;
      background-color: rgba(31, 41, 55, 0.5) !important;
    }
    
    input:focus {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.3);
      background-color: rgba(31, 41, 55, 0.7) !important;
      border-color: rgba(79, 70, 229, 0.7) !important;
    }
    
    input::placeholder {
      color: rgba(209, 213, 219, 0.5);
    }
  </style>
</head>
<body class="text-white">
  <!-- Navbar -->
  <nav class="fixed top-0 w-full z-50 bg-gradient-to-r from-gray-900 to-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg">
    <div class="container mx-auto px-6 py-3">
      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <img src="../assets/images/logo_brahma.png" alt="Brahma Logo" class="h-10 mr-3">
          <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-purple-500">BRAHMA</span>
        </div>
        <div class="hidden md:flex items-center space-x-8">
          <a href="../index.php" class="text-gray-300 hover:text-white transition duration-300">Home</a>
          <a href="../pages/about-page.php" class="text-gray-300 hover:text-white transition duration-300">About Us</a>
          <a href="../pages/service-page.php" class="text-gray-300 hover:text-white transition duration-300">Services</a>
          <a href="../pages/contact-page.php" class="text-gray-300 hover:text-white transition duration-300">Contact</a>
          <a href="../auth/login.php" class="px-4 py-2 rounded-full bg-indigo-600 hover:bg-indigo-700 transition duration-300">Login</a>
        </div>
        <div class="md:hidden">
          <button id="mobile-menu-button" class="text-gray-300 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
          </button>
        </div>
      </div>
      <!-- Mobile menu, toggle classes based on menu state -->
      <div id="mobile-menu" class="md:hidden hidden mt-3">
        <a href="../index.php" class="block py-2 text-gray-300 hover:text-white">Home</a>
        <a href="../pages/about-page.php" class="block py-2 text-gray-300 hover:text-white">About Us</a>
        <a href="../pages/service-page.php" class="block py-2 text-gray-300 hover:text-white">Services</a>
        <a href="../pages/contact-page.php" class="block py-2 text-gray-300 hover:text-white">Contact</a>
        <a href="../auth/login.php" class="block py-2 text-gray-300 hover:text-white">Login</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="pt-32 pb-16 px-6">
    <div class="container mx-auto">
      <div class="max-w-4xl mx-auto text-center animate-fadeIn" style="animation-delay: 0.3s;">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Your Support Can Save Lives</h1>
        <p class="text-xl mb-8 text-gray-300">Join us in our mission to provide immediate relief and recovery to communities affected by disasters through innovative technology solutions.</p>
        <div class="hero-gradient p-6 rounded-2xl shadow-2xl mb-12">
          <p class="text-lg italic mb-4">"In the face of disaster, every contribution, no matter how small, becomes a beacon of hope for those in desperate need. Your generosity today can provide shelter, food, and medical care to survivors tomorrow."</p>
          <p class="text-right font-medium">— Brahma Relief Team</p>
        </div>
      </div>
      
      <!-- Stats Section -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-16 animate-fadeIn" style="animation-delay: 0.6s;">
        <div class="card-glassmorphism rounded-xl p-6 text-center stat-card">
          <div class="text-4xl text-pink-500 mb-2">
            <i class="fas fa-hand-holding-heart"></i>
          </div>
          <h3 class="text-2xl font-bold mb-1"><?php echo number_format($donor_count); ?></h3>
          <p class="text-gray-400">Total Donors</p>
        </div>
        
        <div class="card-glassmorphism rounded-xl p-6 text-center stat-card">
          <div class="text-4xl text-pink-500 mb-2">
            <i class="fas fa-rupee-sign"></i>
          </div>
          <h3 class="text-2xl font-bold mb-1">₹<?php echo number_format($total_amount); ?></h3>
          <p class="text-gray-400">Total Donations</p>
        </div>
        
        <div class="card-glassmorphism rounded-xl p-6 text-center stat-card">
          <div class="text-4xl text-pink-500 mb-2">
            <i class="fas fa-house-damage"></i>
          </div>
          <h3 class="text-2xl font-bold mb-1">12</h3>
          <p class="text-gray-400">Relief Operations</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Main Content -->
  <section class="py-16 px-6 bg-gradient-to-b from-transparent to-gray-900">
    <div class="container mx-auto">
      <div class="flex flex-col md:flex-row gap-8 max-w-6xl mx-auto">
        <!-- Donation Form -->
        <div class="w-full md:w-1/2 animate-slideUp" style="animation-delay: 0.3s;">
          <div class="card-glassmorphism rounded-xl p-8">
            <div class="flex justify-center mb-6">
              <div class="w-16 h-16 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 flex items-center justify-center">
                <i class="fas fa-heart text-2xl"></i>
              </div>
            </div>
            <h2 class="text-3xl font-bold mb-6 text-center bg-clip-text text-transparent bg-gradient-to-r from-pink-400 to-purple-400">Make a Donation</h2>
            <form id="donation-form" method="post" action="" class="space-y-6">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Your Name</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-500"></i>
                  </div>
                  <input type="text" id="name" name="name" placeholder="Enter your full name" required
                         class="w-full p-3 pl-10 bg-gray-800/50 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
              </div>
              
              <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-500"></i>
                  </div>
                  <input type="email" id="email" name="email" placeholder="Enter your email" required
                         class="w-full p-3 pl-10 bg-gray-800/50 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
              </div>
              
              <div>
                <label for="amount" class="block text-sm font-medium text-gray-300 mb-1">Donation Amount (INR)</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-rupee-sign text-gray-500"></i>
                  </div>
                  <input type="number" id="amount" name="amount" placeholder="Enter amount" required
                         class="w-full p-3 pl-10 bg-gray-800/50 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
              </div>
              
              <div class="flex justify-center space-x-6 pt-3">
                <button type="button" class="amount-preset px-3 py-1 rounded-full border border-gray-600 hover:border-pink-500 transition-colors duration-300">₹100</button>
                <button type="button" class="amount-preset px-3 py-1 rounded-full border border-gray-600 hover:border-pink-500 transition-colors duration-300">₹500</button>
                <button type="button" class="amount-preset px-3 py-1 rounded-full border border-gray-600 hover:border-pink-500 transition-colors duration-300">₹1000</button>
                <button type="button" class="amount-preset px-3 py-1 rounded-full border border-gray-600 hover:border-pink-500 transition-colors duration-300">₹5000</button>
              </div>
                            
              <input type="hidden" id="payment_id" name="payment_id">
              
              <div class="text-center pt-4">
                <button type="button" id="donate-button" class="donate-btn w-full py-3 px-6 rounded-xl text-white font-semibold shadow-lg flex items-center justify-center">
                  <i class="fas fa-heart mr-2"></i> Donate Now
                </button>
                <p class="text-xs text-gray-400 mt-3">Your donation is secure and encrypted. You'll receive a receipt via email.</p>
              </div>
            </form>
          </div>
        </div>
        
        <!-- Recent Donors & Impact -->
        <div class="w-full md:w-1/2 space-y-8 animate-slideUp" style="animation-delay: 0.6s;">
          <!-- Recent Donors -->
          <div class="card-glassmorphism rounded-xl p-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
              <i class="fas fa-users text-pink-500 mr-3"></i>
              Recent Supporters
            </h2>
            <?php if (count($recent_donors) > 0): ?>
              <ul class="donor-list space-y-4">
                <?php foreach ($recent_donors as $donor): ?>
                  <li class="flex justify-between items-center p-3 rounded-lg bg-gray-800/50 border border-gray-700">
                    <div class="flex items-center">
                      <div class="h-10 w-10 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 flex items-center justify-center">
                        <span class="font-bold"><?php echo substr(htmlspecialchars($donor['name']), 0, 1); ?></span>
                      </div>
                      <span class="ml-3 font-medium"><?php echo htmlspecialchars($donor['name']); ?></span>
                    </div>
                    <span class="bg-gray-900/50 py-1 px-3 rounded-full text-pink-400">₹<?php echo number_format(htmlspecialchars($donor['amount'])); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="text-center text-gray-400 py-4">Be the first to donate!</p>
            <?php endif; ?>
          </div>
          
          <!-- Impact Section -->
          <div class="card-glassmorphism rounded-xl p-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
              <i class="fas fa-globe text-pink-500 mr-3"></i>
              Your Impact
            </h2>
            <div class="space-y-6">
              <div>
                <div class="flex justify-between mb-2">
                  <span>Emergency Relief</span>
                  <span>75%</span>
                </div>
                <div class="bg-gray-700 rounded-full h-2.5">
                  <div class="progress-bar h-2.5 rounded-full" style="width: 75%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2">Providing immediate support to affected communities</p>
              </div>
              
              <div>
                <div class="flex justify-between mb-2">
                  <span>Technology Development</span>
                  <span>60%</span>
                </div>
                <div class="bg-gray-700 rounded-full h-2.5">
                  <div class="progress-bar h-2.5 rounded-full" style="width: 60%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2">Enhancing our disaster response technology</p>
              </div>
              
              <div>
                <div class="flex justify-between mb-2">
                  <span>Volunteer Training</span>
                  <span>40%</span>
                </div>
                <div class="bg-gray-700 rounded-full h-2.5">
                  <div class="progress-bar h-2.5 rounded-full" style="width: 40%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2">Training local volunteers for effective response</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Testimonials Section -->
  <section class="py-16 px-6">
    <div class="container mx-auto max-w-6xl">
      <h2 class="text-3xl font-bold mb-12 text-center">Voices from the Field</h2>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="card-glassmorphism rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.3s;">
          <div class="flex justify-center mb-4">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Testimonial" class="w-16 h-16 rounded-full border-2 border-pink-500">
          </div>
          <p class="italic text-gray-300 mb-4">"The technology provided by Brahma helped us coordinate our rescue efforts during the floods. It made a world of difference in our response time."</p>
          <p class="font-medium text-right">— Rajesh Kumar, Rescue Worker</p>
        </div>
        
        <div class="card-glassmorphism rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.6s;">
          <div class="flex justify-center mb-4">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Testimonial" class="w-16 h-16 rounded-full border-2 border-pink-500">
          </div>
          <p class="italic text-gray-300 mb-4">"After the earthquake, Brahma's volunteers were the first to reach our village with supplies and medical aid. Their organization was impressive."</p>
          <p class="font-medium text-right">— Priya Singh, Survivor</p>
        </div>
        
        <div class="card-glassmorphism rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.9s;">
          <div class="flex justify-center mb-4">
            <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Testimonial" class="w-16 h-16 rounded-full border-2 border-pink-500">
          </div>
          <p class="italic text-gray-300 mb-4">"As government officials, we rely on Brahma's data to make informed decisions during crises. Their mapping tools have become essential to our emergency operations."</p>
          <p class="font-medium text-right">— Aditya Sharma, Official</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Call to Action -->
  <section class="py-16 px-6 bg-gradient-to-t from-transparent to-gray-900">
    <div class="container mx-auto max-w-4xl text-center">
      <h2 class="text-3xl md:text-4xl font-bold mb-6 animate-pulse-slow">Together, We Can Make a Difference</h2>
      <p class="text-xl mb-8 text-gray-300">Every donation contributes to our mission of providing timely and effective disaster management solutions.</p>
      <button id="scroll-to-donate" class="donate-btn py-3 px-8 rounded-full text-white font-semibold shadow-lg text-lg animate-bounce">
        <i class="fas fa-angle-double-up mr-2"></i> Donate Now
      </button>
    </div>
  </section>
  
  <!-- Footer -->
  <footer class="bg-gray-900 py-12 px-6">
    <div class="container mx-auto max-w-6xl">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center mb-4">
            <img src="../assets/images/logo_brahma.png" alt="Brahma Logo" class="h-10 mr-3">
            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-purple-500">BRAHMA</span>
          </div>
          <p class="text-gray-400 text-sm">Leveraging technology for effective disaster response and relief operations.</p>
        </div>
        
        <div>
          <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
          <ul class="space-y-2 text-gray-400">
            <li><a href="#" class="hover:text-pink-500 transition">About Us</a></li>
            <li><a href="#" class="hover:text-pink-500 transition">Our Mission</a></li>
            <li><a href="#" class="hover:text-pink-500 transition">Services</a></li>
            <li><a href="#" class="hover:text-pink-500 transition">Contact</a></li>
          </ul>
        </div>
        
        <div>
          <h3 class="text-lg font-semibold mb-4">Get Involved</h3>
          <ul class="space-y-2 text-gray-400">
            <li><a href="#" class="hover:text-pink-500 transition">Volunteer</a></li>
            <li><a href="#" class="hover:text-pink-500 transition">Donate</a></li>
            <li><a href="#" class="hover:text-pink-500 transition">Fundraise</a></li>
            <li><a href="#" class="hover:text-pink-500 transition">Partner With Us</a></li>
          </ul>
        </div>
        
        <div>
          <h3 class="text-lg font-semibold mb-4">Connect With Us</h3>
          <div class="flex space-x-4 mb-4">
            <a href="#" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
          <p class="text-gray-400 text-sm">Subscribe to our newsletter for updates on our work and impact.</p>
        </div>
      </div>
      
      <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm">
        <p>&copy; <?php echo date('Y'); ?> Brahma Disaster Management System. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    });
    
    // Amount preset buttons
    document.querySelectorAll('.amount-preset').forEach(button => {
      button.addEventListener('click', function() {
        const amount = this.textContent.replace('₹', '');
        document.getElementById('amount').value = amount;
      });
    });
    
    // Scroll to donate button
    document.getElementById('scroll-to-donate').addEventListener('click', function() {
      document.getElementById('donation-form').scrollIntoView({ behavior: 'smooth' });
    });
    
    // Razorpay integration
    document.getElementById('donate-button').addEventListener('click', function() {
      var name = document.getElementById('name').value;
      var email = document.getElementById('email').value;
      var amount = document.getElementById('amount').value;
      
      // Basic form validation
      if (!name || !email || !amount) {
        alert('Please fill in all fields before proceeding.');
        return;
      }
      
      var options = {
        key: "rzp_test_XxcBi4GZcRiCLQ", 
        amount: amount * 100, 
        currency: "INR",
        name: "Brahma",
        description: "Disaster Management Donation",
        image: "../assets/images/logo_brahma.png", 
        handler: function (response) {
          document.getElementById('payment_id').value = response.razorpay_payment_id;
          document.getElementById('donation-form').submit();
        },
        prefill: {
          name: name,
          email: email
        },
        theme: {
          color: "#f43f5e"
        }
      };

      var rzp1 = new Razorpay(options);
      rzp1.open();
    });
    
    // Animate elements on scroll
    document.addEventListener('DOMContentLoaded', function() {
      const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate-fadeIn:not(.animated), .animate-slideUp:not(.animated)');
        
        elements.forEach(element => {
          if (isElementInViewport(element)) {
            element.classList.add('animated');
          }
        });
      };
      
      const isElementInViewport = function(el) {
        const rect = el.getBoundingClientRect();
        return (
          rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
          rect.bottom >= 0
        );
      };
      
      // Initial check
      animateOnScroll();
      
      // Check on scroll
      window.addEventListener('scroll', animateOnScroll);
    });
  </script>
</body>
</html>