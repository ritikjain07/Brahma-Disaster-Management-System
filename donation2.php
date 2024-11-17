<?php
// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Database connection details
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "brahma_db"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
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
        // Send thank you email using PHPMailer
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
        echo "<script>alert('Error saving donation');</script>";
    }

    $stmt->close();
    $conn->close();
}

// Fetch recent donors
$recent_donors = [];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT name, amount FROM donations ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $recent_donors[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Donate to Brahma</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    body {
      background-image: url('bgidn.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      font-family: 'Arial', sans-serif;
    }
  </style>
</head>
<body class="bg-white-100 flex flex-col items-center justify-center min-h-screen p-4">
<header class="bg-black bg-opacity-75 w-full py-4 shadow-md">
  <div class="container mx-auto px-4 flex justify-between items-center">
    <div class="flex items-center justify-center w-full">
      <img src="logo.png" alt="Brahma Logo" class="h-12 mr-2">
      <span class="text-2xl font-bold text-white-800">Brahma</span>
    </div>
    <nav class="flex space-x-4">
      <a href="index.php" class="text-gray-800 hover:text-blue-500 mx-2">Home</a>
      <a href="contact-page.php" class="text-gray-800 hover:text-blue-500 mx-2">Contact</a>
    </nav>
  </div>
</header>


  <div class="hero text-center text-white mb-8 animate-fadeIn bg-gray-900 bg-opacity-50 p-8 rounded-lg">
    <h1 class="text-4xl font-bold mb-4">Support Brahma Disaster Management System</h1>
    <p class="text-xl mb-8">Your donation empowers us to leverage cutting-edge technology for effective disaster response and relief operations.</p>
    <p class="text-lg mb-4">"Your support can make a real difference in the lives of those affected by disasters. Join us in our mission to provide timely and effective disaster management solutions."</p>
    <p class="text-lg italic">"Together, we can build a safer future."</p>
  </div>

  <div class="form-container bg-white bg-opacity-90 p-8 rounded-lg shadow-lg max-w-md w-full mb-8 animate-slideIn">
    <h2 class="text-3xl font-bold mb-6 text-center">Make a Donation</h2>
    <form id="donation-form" method="post" action="">
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded" required>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
        <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded" required>
      </div>
      <div class="mb-4">
        <label for="amount" class="block text-gray-700 font-bold mb-2">Donation Amount (INR)</label>
        <input type="number" id="amount" name="amount" class="w-full p-3 border border-gray-300 rounded" required>
      </div>
      <input type="hidden" id="payment_id" name="payment_id">
      <div class="text-center">
        <button type="button" id="donate-button" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white py-2 px-4 rounded-full hover:from-blue-600 hover:to-indigo-600 transform hover:scale-105 transition-all duration-300">Donate</button>
      </div>
    </form>
  </div>

  <div class="recent-donors bg-white bg-opacity-90 p-8 rounded-lg shadow-lg max-w-md w-full text-center animate-fadeIn">
    <h2 class="text-2xl font-bold mb-4">Recent Donors</h2>
    <ul class="list-disc list-inside text-left">
      <?php foreach ($recent_donors as $donor): ?>
        <li><?php echo htmlspecialchars($donor['name']) . ' - INR ' . htmlspecialchars($donor['amount']); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <script>
    document.getElementById('donate-button').addEventListener('click', function() {
      var name = document.getElementById('name').value;
      var email = document.getElementById('email').value;
      var amount = document.getElementById('amount').value;

      var options = {
        key: "rzp_test_XxcBi4GZcRiCLQ", 
        amount: amount * 100, 
        currency: "INR",
        name: "Brahma",
        description: "Disaster Management Donation",
        image: "logo_brahma.png", 
        handler: function (response) {
          document.getElementById('payment_id').value = response.razorpay_payment_id;
          document.getElementById('donation-form').submit();
        },
        prefill: {
          name: name,
          email: email
        },
        theme: {
          color: "#000"
        }
      };

      var rzp1 = new Razorpay(options);
      rzp1.open();
    });
  </script>

  <style>
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes slideIn {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    .animate-fadeIn {
      animation: fadeIn 1s ease-in-out;
    }
    .animate-slideIn {
      animation: slideIn 1s ease-in-out;
    }
  </style>
</body>
</html>
