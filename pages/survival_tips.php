<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survival Tips | Brahma</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #9333ea 100%);
            --card-hover-transform: translateY(-8px);
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            --card-hover-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: url('../assets/images/bgidn.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            position: relative;
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
        
        .navbar {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
        }
        
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .logo {
            max-width: 150px;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
        }
        
        .page-title {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }
        
        .tip-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            text-decoration: none;
            color: white;
            text-align: center;
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
            position: relative;
            overflow: hidden;
            height: 200px;
        }
        
        .tip-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(-100%) skewX(-15deg);
            transition: transform 0.7s ease;
        }
        
        .tip-card:hover {
            transform: var(--card-hover-transform);
            box-shadow: var(--card-hover-shadow);
        }
        
        .tip-card:hover::before {
            transform: translateX(100%) skewX(-15deg);
        }
        
        .tip-card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .tip-card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .footer {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background: white;
            color: #4f46e5;
            transform: translateY(-3px);
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #4f46e5;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .survival-intro {
            max-width: 800px;
            margin: 0 auto 3rem auto;
            position: relative;
            padding: 2rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: float 5s ease-in-out infinite;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <!-- Navigation Bar -->
    <header class="navbar text-white py-4 px-6 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="../index.php" class="flex items-center space-x-3">
                <img src="../assets/images/logo_brahma.png" alt="Brahma Logo" class="h-10">
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-600">Brahma</span>
            </a>
            
            <nav class="hidden md:flex space-x-8">
                <a href="../index.php" class="nav-link text-gray-300 hover:text-white transition">Home</a>
                <a href="mapify.php" class="nav-link text-gray-300 hover:text-white transition">Map</a>
                <a href="survival_tips.php" class="nav-link text-white font-medium">Survival Tips</a>
                <a href="emergencyForm.php" class="nav-link text-gray-300 hover:text-white transition">Emergency</a>
                <a href="../pages/about-page.php" class="nav-link text-gray-300 hover:text-white transition">About</a>
            </nav>
            
            <button class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu (Hidden by default) -->
    <div class="hidden bg-gray-900 text-white p-4 md:hidden">
        <nav class="flex flex-col space-y-4">
            <a href="../index.php" class="py-2 hover:text-indigo-400 transition">Home</a>
            <a href="mapify.php" class="py-2 hover:text-indigo-400 transition">Map</a>
            <a href="survival_tips.php" class="py-2 text-indigo-400 font-medium">Survival Tips</a>
            <a href="emergencyForm.php" class="py-2 hover:text-indigo-400 transition">Emergency</a>
            <a href="../pages/about-page.php" class="py-2 hover:text-indigo-400 transition">About</a>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="flex-grow py-16 px-6">
        <div class="container mx-auto">
            <!-- Logo & Title -->
            <div class="text-center mb-10">
                <div class="logo-container">
                    <img src="logo.png" alt="Brahma Logo" class="logo floating">
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white page-title">Survival Tips</h1>
            </div>
            
            <!-- Introduction -->
            <div class="survival-intro text-white text-center mb-12">
                <p class="text-lg mb-4">Being prepared can mean the difference between life and death during disasters. These resources provide expert guidance on how to survive various emergency situations.</p>
                <p class="text-sm opacity-80">Click on any card below to access comprehensive survival guides from trusted sources.</p>
            </div>

            <!-- Tip Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Earthquake Card -->
                <a href="https://www.ready.gov/earthquakes" target="_blank" class="tip-card bg-gradient-to-br from-red-600 to-red-800">
                    <div class="tip-card-icon">
                        <i class="fas fa-house-damage"></i>
                    </div>
                    <h3 class="tip-card-title">Earthquake Survival</h3>
                    <p class="text-sm mt-2 opacity-80">Drop, Cover, and Hold On</p>
                </a>

                <!-- Flood Card -->
                <a href="https://www.ready.gov/floods" target="_blank" class="tip-card bg-gradient-to-br from-blue-600 to-blue-800">
                    <div class="tip-card-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3 class="tip-card-title">Flood Survival</h3>
                    <p class="text-sm mt-2 opacity-80">Turn Around, Don't Drown</p>
                </a>

                <!-- Hurricane Card -->
                <a href="https://www.ready.gov/hurricanes" target="_blank" class="tip-card bg-gradient-to-br from-yellow-600 to-yellow-800">
                    <div class="tip-card-icon">
                        <i class="fas fa-wind"></i>
                    </div>
                    <h3 class="tip-card-title">Hurricane Survival</h3>
                    <p class="text-sm mt-2 opacity-80">Evacuate or Shelter Safely</p>
                </a>

                <!-- Wildfire Card -->
                <a href="https://www.ready.gov/wildfires" target="_blank" class="tip-card bg-gradient-to-br from-orange-600 to-red-700">
                    <div class="tip-card-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h3 class="tip-card-title">Wildfire Survival</h3>
                    <p class="text-sm mt-2 opacity-80">Ready, Set, Go!</p>
                </a>

                <!-- Tornado Card -->
                <a href="https://www.ready.gov/tornadoes" target="_blank" class="tip-card bg-gradient-to-br from-purple-600 to-purple-800">
                    <div class="tip-card-icon">
                        <i class="fas fa-tornado"></i>
                    </div>
                    <h3 class="tip-card-title">Tornado Survival</h3>
                    <p class="text-sm mt-2 opacity-80">Find Safe Shelter Immediately</p>
                </a>

                <!-- Public Safety Card -->
                <a href="https://www.ready.gov/public-spaces" target="_blank" class="tip-card bg-gradient-to-br from-red-500 to-red-900">
                    <div class="tip-card-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="tip-card-title">Public Space Attacks</h3>
                    <p class="text-sm mt-2 opacity-80">Run, Hide, Fight</p>
                </a>

                <!-- Tsunami Card -->
                <a href="https://www.ready.gov/tsunamis" target="_blank" class="tip-card bg-gradient-to-br from-indigo-600 to-indigo-900">
                    <div class="tip-card-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3 class="tip-card-title">Tsunami Survival</h3>
                    <p class="text-sm mt-2 opacity-80">Move to Higher Ground</p>
                </a>

                <!-- Extreme Heat Card -->
                <a href="https://www.ready.gov/extreme-heat" target="_blank" class="tip-card bg-gradient-to-br from-amber-600 to-amber-800">
                    <div class="tip-card-icon">
                        <i class="fas fa-temperature-high"></i>
                    </div>
                    <h3 class="tip-card-title">Extreme Heat Survival</h3>
                    <p class="text-sm mt-2 opacity-80">Stay Cool, Hydrated, Informed</p>
                </a>

                <!-- Power Outage Card -->
                <a href="https://www.ready.gov/power-outages" target="_blank" class="tip-card bg-gradient-to-br from-gray-600 to-gray-800">
                    <div class="tip-card-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="tip-card-title">Power Outage Survival</h3>
                    <p class="text-sm mt-2 opacity-80">Prepare, Adapt, Recover</p>
                </a>
            </div>
            
            <!-- Additional Resources Section -->
            <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-8 text-white">
                <h2 class="text-2xl font-bold mb-6 text-center">Essential Survival Resources</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-indigo-900 bg-opacity-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold mb-4">Emergency Kit Essentials</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Water (one gallon per person per day)</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Non-perishable food (3-day supply)</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Battery or hand-crank radio</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Flashlight and extra batteries</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> First aid kit and medications</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Whistle to signal for help</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Dust mask and plastic sheeting</li>
                        </ul>
                    </div>
                    
                    <div class="bg-indigo-900 bg-opacity-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold mb-4">General Survival Tips</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-blue-400 mr-2 mt-1"></i> 
                                <span>Create a family emergency plan and practice it regularly</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-blue-400 mr-2 mt-1"></i> 
                                <span>Know evacuation routes for your area</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-blue-400 mr-2 mt-1"></i> 
                                <span>Keep important documents in waterproof containers</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-blue-400 mr-2 mt-1"></i> 
                                <span>Learn basic first aid and CPR</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-blue-400 mr-2 mt-1"></i> 
                                <span>Sign up for emergency alerts in your area</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer text-white py-8 mt-auto">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Logo & Copyright -->
                <div class="mb-6 md:mb-0 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start mb-4">
                        <img src="logo.png" alt="Brahma Logo" class="h-8 mr-3">
                        <span class="text-xl font-bold">Brahma</span>
                    </div>
                    <p class="text-sm text-gray-400">© 2025 Brahma Disaster Management. All rights reserved.</p>
                </div>
                
                <!-- Quick Links -->
                <div class="grid grid-cols-2 gap-8 mb-6 md:mb-0">
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider mb-3">Resources</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Documentation</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Blog</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">FAQs</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider mb-3">Company</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="about-page.php" class="text-gray-400 hover:text-white transition">About Us</a></li>
                            <li><a href="contact-page.php" class="text-gray-400 hover:text-white transition">Contact</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="text-center md:text-right">
                    <h3 class="text-sm font-semibold uppercase tracking-wider mb-3">Connect With Us</h3>
                    <div class="social-icons flex space-x-4 justify-center md:justify-end">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('button.md\\:hidden').addEventListener('click', function() {
            const mobileMenu = document.querySelector('.hidden.bg-gray-900');
            mobileMenu.classList.toggle('hidden');
        });
        
        // Add scroll reveal effect for cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.tip-card');
            
            function revealCards() {
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.classList.add('opacity-100');
                        card.classList.add('translate-y-0');
                    }, 100 * index);
                });
            }
            
            cards.forEach(card => {
                card.classList.add('opacity-0');
                card.classList.add('translate-y-10');
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });
            
            // Start the reveal animation after a short delay
            setTimeout(revealCards, 300);
        });
    </script>
</body>

</html>