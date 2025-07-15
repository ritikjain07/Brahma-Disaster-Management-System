<?php
/**
 * Brahma Disaster Management System - Home Page (Simple Version)
 * 
 * @author Ritik Jain
 * @version 1.0
 */

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set up paths
$basePath = './';
$pageTitle = 'Home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brahma - Disaster Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: url("assets/images/bgidn.jpg") no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }
        
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
        
        .hero {
            background: rgba(0, 0, 0, 0.7);
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
            max-width: 800px;
            width: 100%;
        }
        
        .sos-button {
            background: radial-gradient(circle, hsla(10, 74%, 63%, 1) 0%, hsla(0, 73%, 42%, 1) 100%);
            transition: transform 0.3s ease-in-out;
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
        }
        
        .sos-button:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body class="pt-16">
    <div class="overlay"></div>
    
    <!-- Navigation -->
    <nav class="bg-blue-900 text-white p-4 fixed top-0 left-0 right-0 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="assets/images/logo_brahma.png" alt="Brahma Logo" class="h-8 w-8">
                <span class="text-xl font-bold">Brahma</span>
            </div>
            
            <div class="hidden md:flex space-x-6">
                <a href="index.php" class="hover:text-blue-300 transition-colors">Home</a>
                <a href="pages/about-page.php" class="hover:text-blue-300 transition-colors">About</a>
                <a href="pages/service-page.php" class="hover:text-blue-300 transition-colors">Services</a>
                <a href="pages/contact-page.php" class="hover:text-blue-300 transition-colors">Contact</a>
                <a href="auth/login.php" class="hover:text-blue-300 transition-colors">Login</a>
                <a href="auth/signup.php" class="hover:text-blue-300 transition-colors">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center px-4">
        <div class="hero text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Welcome to <span class="text-blue-400">Brahma</span>
            </h1>
            <p class="text-lg md:text-xl mb-8">
                Advanced Disaster Management System for Emergency Response
            </p>
            <p class="text-base md:text-lg mb-8">
                Leveraging cutting-edge technology including drones and quadrupedal robots to support disaster relief efforts.
            </p>
            
            <!-- Emergency SOS Button -->
            <div class="mb-8">
                <button class="sos-button rounded-full text-white font-bold shadow-lg hover:shadow-xl mx-auto flex items-center justify-center" onclick="emergencyAlert()">
                    SOS
                </button>
                <p class="text-sm mt-2 text-gray-300">Emergency Button</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="pages/emergencyForm.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Report Emergency
                </a>
                <a href="pages/weather.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                    <i class="fas fa-cloud-sun mr-2"></i>
                    Weather Forecast
                </a>
                <a href="pages/medical_aid.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                    <i class="fas fa-heartbeat mr-2"></i>
                    Medical Aid
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Our Features</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl text-red-500 mb-4">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Disaster Reporting</h3>
                    <p class="text-gray-600">Report disasters and upload relevant details.</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl text-blue-500 mb-4">
                        <i class="fas fa-cloud-sun"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Weather Forecasts</h3>
                    <p class="text-gray-600">Real-time weather updates for disaster preparedness.</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl text-green-500 mb-4">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Medical Aid</h3>
                    <p class="text-gray-600">Find nearest hospitals and medical assistance.</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function emergencyAlert() {
            if (confirm('Are you in immediate danger? This will alert emergency services.')) {
                alert('Emergency alert sent! Help is on the way.');
                window.location.href = 'pages/emergencyForm.php';
            }
        }
    </script>
</body>
</html>
