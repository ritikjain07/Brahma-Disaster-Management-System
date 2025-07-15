<?php
/**
 * Brahma Disaster Management System - Home Page
 * 
 * @author Ritik Jain
 * @version 1.0
 */

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set up paths and configuration
$basePath = './';
$pageTitle = 'Home';
$bodyClass = 'home-page';

// Try to include functions safely
try {
    require_once 'includes/functions_simple.php';
} catch (Exception $e) {
    // If functions fail, create basic functions
    function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
}

// Additional head content for home page
$additionalHead = '
<style>
    /* Any page-specific overrides can go here */
</style>
';

// Include header
include 'includes/header.php';
?>

<div class="overlay"></div>

<!-- Hero Section -->
<section class="min-h-screen flex items-center justify-center px-4">
    <div class="hero text-center text-white fade-in">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">
            Welcome to <span class="text-blue-400">Brahma</span>
        </h1>
        <p class="text-lg md:text-xl mb-8 typewriter">
            Advanced Disaster Management System for Emergency Response
        </p>
        <p class="text-base md:text-lg mb-8">
            Leveraging cutting-edge technology including drones and quadrupedal robots to support disaster relief efforts, ensuring faster and more efficient operations.
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
            <!-- Feature 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="text-4xl text-red-500 mb-4">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Disaster Reporting</h3>
                <p class="text-gray-600">Report disasters and upload relevant details to help authorities assess situations quickly.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="text-4xl text-blue-500 mb-4">
                    <i class="fas fa-cloud-sun"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Weather Forecasts</h3>
                <p class="text-gray-600">Real-time weather updates to assist with disaster preparedness and planning.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="text-4xl text-green-500 mb-4">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Medical Aid</h3>
                <p class="text-gray-600">Find nearest hospitals, book appointments, and view essential medical contacts.</p>
            </div>
            
            <!-- Feature 4 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="text-4xl text-purple-500 mb-4">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Missing Person</h3>
                <p class="text-gray-600">Report missing persons and upload images for rescue teams to act swiftly.</p>
            </div>
            
            <!-- Feature 5 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="text-4xl text-orange-500 mb-4">
                    <i class="fas fa-route"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Evacuation Requests</h3>
                <p class="text-gray-600">Easy way to request evacuation assistance during emergencies.</p>
            </div>
            
            <!-- Feature 6 -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="text-4xl text-teal-500 mb-4">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Points of Interest</h3>
                <p class="text-gray-600">Essential locations like hospitals, shelters, and rescue stations on interactive maps.</p>
            </div>
        </div>
    </div>
</section>

<!-- Emergency Services Section -->
<section class="py-16 bg-blue-900 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-8">Emergency Services</h2>
        <p class="text-xl mb-8">Quick access to essential emergency services</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-red-600 rounded-lg p-6">
                <i class="fas fa-fire text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Fire Department</h3>
                <p class="text-2xl font-bold">911</p>
            </div>
            
            <div class="bg-blue-600 rounded-lg p-6">
                <i class="fas fa-shield-alt text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Police</h3>
                <p class="text-2xl font-bold">911</p>
            </div>
            
            <div class="bg-green-600 rounded-lg p-6">
                <i class="fas fa-ambulance text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Ambulance</h3>
                <p class="text-2xl font-bold">911</p>
            </div>
        </div>
    </div>
</section>

<script>
function emergencyAlert() {
    if (confirm('Are you in immediate danger? This will alert emergency services.')) {
        // Show loading state
        const button = document.querySelector('.sos-button');
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.disabled = true;
        
        // Simulate emergency alert
        setTimeout(() => {
            alert('Emergency alert sent! Help is on the way.');
            // Redirect to emergency form
            window.location.href = 'pages/emergencyForm.php';
        }, 2000);
    }
}

// Add fade-in animation when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Animate feature cards
    const featureCards = document.querySelectorAll('.bg-white');
    featureCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('fade-in');
        }, index * 200);
    });
    
    // Add hover effects to buttons
    const buttons = document.querySelectorAll('a[href^="pages/"]');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Add scroll animation
window.addEventListener('scroll', function() {
    const nav = document.querySelector('nav');
    if (window.scrollY > 100) {
        nav.style.backgroundColor = 'rgba(30, 58, 138, 0.95)';
    } else {
        nav.style.backgroundColor = 'rgb(30, 58, 138)';
    }
});
</script>

<?php
// Include footer
include 'includes/footer.php';
?>