<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disaster Information - Brahma</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: url('../assets/images/bgidn.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }
        
        .info-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="min-h-screen text-white">
    <!-- Navigation Header -->
    <header class="bg-black bg-opacity-50 backdrop-blur-md text-white py-4 px-6 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="../index.php" class="flex items-center space-x-3">
                <img src="../assets/images/logo_brahma.png" alt="Brahma Logo" class="h-10">
                <span class="text-2xl font-bold">Brahma</span>
            </a>
            <nav class="flex space-x-6">
                <a href="../index.php" class="hover:text-gray-300">Home</a>
                <a href="mapify.php" class="hover:text-gray-300">Map</a>
                <a href="helpForm.php" class="hover:text-gray-300">Help</a>
                <a href="survival_tips.php" class="hover:text-gray-300">Survival Tips</a>
                <a href="info.php" class="text-blue-400 font-semibold">Disaster Info</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-16 px-6">
        <div class="container mx-auto">
            <!-- Title Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent">
                    Disaster Information
                </h1>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Stay informed about different types of disasters and how to prepare for them
                </p>
            </div>

            <!-- Disaster Types Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Earthquake -->
                <div class="info-card bg-white bg-opacity-10 backdrop-blur-md rounded-xl p-6 border border-white border-opacity-20">
                    <div class="text-center mb-4">
                        <i class="fas fa-house-damage text-5xl text-red-400 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">Earthquake</h3>
                    </div>
                    <ul class="text-gray-300 space-y-2">
                        <li>• Drop, Cover, and Hold On</li>
                        <li>• Stay away from windows and heavy objects</li>
                        <li>• If outdoors, move to open area</li>
                        <li>• After shaking stops, check for injuries</li>
                        <li>• Be prepared for aftershocks</li>
                    </ul>
                </div>

                <!-- Flood -->
                <div class="info-card bg-white bg-opacity-10 backdrop-blur-md rounded-xl p-6 border border-white border-opacity-20">
                    <div class="text-center mb-4">
                        <i class="fas fa-water text-5xl text-blue-400 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">Flood</h3>
                    </div>
                    <ul class="text-gray-300 space-y-2">
                        <li>• Move to higher ground immediately</li>
                        <li>• Avoid walking in moving water</li>
                        <li>• Turn off utilities if instructed</li>
                        <li>• Don't drive through flooded roads</li>
                        <li>• Listen for evacuation orders</li>
                    </ul>
                </div>

                <!-- Hurricane -->
                <div class="info-card bg-white bg-opacity-10 backdrop-blur-md rounded-xl p-6 border border-white border-opacity-20">
                    <div class="text-center mb-4">
                        <i class="fas fa-hurricane text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">Hurricane</h3>
                    </div>
                    <ul class="text-gray-300 space-y-2">
                        <li>• Board up windows and doors</li>
                        <li>• Stock up on supplies</li>
                        <li>• Stay indoors during the storm</li>
                        <li>• Avoid flooded areas</li>
                        <li>• Listen to weather updates</li>
                    </ul>
                </div>

                <!-- Wildfire -->
                <div class="info-card bg-white bg-opacity-10 backdrop-blur-md rounded-xl p-6 border border-white border-opacity-20">
                    <div class="text-center mb-4">
                        <i class="fas fa-fire text-5xl text-orange-400 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">Wildfire</h3>
                    </div>
                    <ul class="text-gray-300 space-y-2">
                        <li>• Evacuate immediately if ordered</li>
                        <li>• Close all windows and doors</li>
                        <li>• Remove flammable materials</li>
                        <li>• Have evacuation plan ready</li>
                        <li>• Stay informed about fire conditions</li>
                    </ul>
                </div>

                <!-- Tornado -->
                <div class="info-card bg-white bg-opacity-10 backdrop-blur-md rounded-xl p-6 border border-white border-opacity-20">
                    <div class="text-center mb-4">
                        <i class="fas fa-tornado text-5xl text-green-400 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">Tornado</h3>
                    </div>
                    <ul class="text-gray-300 space-y-2">
                        <li>• Go to lowest floor, interior room</li>
                        <li>• Stay away from windows</li>
                        <li>• Crouch down and protect head</li>
                        <li>• Listen for tornado warnings</li>
                        <li>• Have emergency supplies ready</li>
                    </ul>
                </div>

                <!-- Severe Weather -->
                <div class="info-card bg-white bg-opacity-10 backdrop-blur-md rounded-xl p-6 border border-white border-opacity-20">
                    <div class="text-center mb-4">
                        <i class="fas fa-cloud-bolt text-5xl text-yellow-400 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">Severe Weather</h3>
                    </div>
                    <ul class="text-gray-300 space-y-2">
                        <li>• Monitor weather alerts</li>
                        <li>• Secure outdoor items</li>
                        <li>• Avoid electrical equipment</li>
                        <li>• Stay indoors during storms</li>
                        <li>• Have battery-powered radio</li>
                    </ul>
                </div>
            </div>

            <!-- Emergency Contacts Section -->
            <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-xl p-8 border border-white border-opacity-20">
                <h2 class="text-3xl font-bold text-center mb-8">Emergency Contacts</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <i class="fas fa-phone text-3xl text-red-400 mb-2"></i>
                        <h3 class="text-xl font-semibold mb-2">Emergency Services</h3>
                        <p class="text-2xl font-bold text-red-400">911</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-hospital text-3xl text-blue-400 mb-2"></i>
                        <h3 class="text-xl font-semibold mb-2">Medical Emergency</h3>
                        <p class="text-2xl font-bold text-blue-400">911</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-fire-extinguisher text-3xl text-orange-400 mb-2"></i>
                        <h3 class="text-xl font-semibold mb-2">Fire Department</h3>
                        <p class="text-2xl font-bold text-orange-400">911</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-12 text-center">
                <h2 class="text-3xl font-bold mb-6">Quick Actions</h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="helpForm.php" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Report Emergency
                    </a>
                    <a href="mapify.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-map mr-2"></i> View Map
                    </a>
                    <a href="survival_tips.php" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-lightbulb mr-2"></i> Survival Tips
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black bg-opacity-50 backdrop-blur-md text-white py-8 px-6 mt-16">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Brahma Disaster Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
