<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Brahma - Disaster Management System</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo $basePath; ?>assets/images/logo_brahma.png">
    
    <!-- External CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css">
    
    <!-- Meta tags -->
    <meta name="description" content="Brahma - Advanced Disaster Management System for emergency response, weather monitoring, and community safety.">
    <meta name="keywords" content="disaster management, emergency response, weather forecast, medical aid, missing persons">
    <meta name="author" content="Ritik Jain">
    
    <!-- Open Graph meta tags -->
    <meta property="og:title" content="Brahma - Disaster Management System">
    <meta property="og:description" content="Advanced disaster management system for emergency response and community safety">
    <meta property="og:image" content="<?php echo $basePath; ?>assets/images/logo_brahma.png">
    <meta property="og:url" content="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="website">
    
    <!-- Additional head content -->
    <?php if (isset($additionalHead)) echo $additionalHead; ?>
</head>
<body class="<?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
    
    <!-- Navigation -->
    <nav class="bg-blue-900 text-white p-4 fixed top-0 left-0 right-0 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="<?php echo $basePath; ?>assets/images/logo_brahma.png" alt="Brahma Logo" class="h-8 w-8">
                <span class="text-xl font-bold">Brahma</span>
            </div>
            
            <div class="hidden md:flex space-x-6">
                <a href="<?php echo $basePath; ?>index.php" class="hover:text-blue-300 transition-colors">Home</a>
                <a href="<?php echo $basePath; ?>pages/about-page.php" class="hover:text-blue-300 transition-colors">About</a>
                <a href="<?php echo $basePath; ?>pages/service-page.php" class="hover:text-blue-300 transition-colors">Services</a>
                <a href="<?php echo $basePath; ?>pages/contact-page.php" class="hover:text-blue-300 transition-colors">Contact</a>
                <?php if (isLoggedIn()): ?>
                    <a href="<?php echo $basePath; ?>pages/profile.php" class="hover:text-blue-300 transition-colors">Profile</a>
                    <a href="<?php echo $basePath; ?>auth/logout.php" class="hover:text-blue-300 transition-colors">Logout</a>
                <?php else: ?>
                    <a href="<?php echo $basePath; ?>auth/login.php" class="hover:text-blue-300 transition-colors">Login</a>
                    <a href="<?php echo $basePath; ?>auth/signup.php" class="hover:text-blue-300 transition-colors">Sign Up</a>
                <?php endif; ?>
            </div>
            
            <!-- Mobile menu button -->
            <button class="md:hidden" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobileMenu" class="md:hidden mt-4 space-y-2 hidden">
            <a href="<?php echo $basePath; ?>index.php" class="block py-2 hover:text-blue-300 transition-colors">Home</a>
            <a href="<?php echo $basePath; ?>pages/about-page.php" class="block py-2 hover:text-blue-300 transition-colors">About</a>
            <a href="<?php echo $basePath; ?>pages/service-page.php" class="block py-2 hover:text-blue-300 transition-colors">Services</a>
            <a href="<?php echo $basePath; ?>pages/contact-page.php" class="block py-2 hover:text-blue-300 transition-colors">Contact</a>
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo $basePath; ?>pages/profile.php" class="block py-2 hover:text-blue-300 transition-colors">Profile</a>
                <a href="<?php echo $basePath; ?>auth/logout.php" class="block py-2 hover:text-blue-300 transition-colors">Logout</a>
            <?php else: ?>
                <a href="<?php echo $basePath; ?>auth/login.php" class="block py-2 hover:text-blue-300 transition-colors">Login</a>
                <a href="<?php echo $basePath; ?>auth/signup.php" class="block py-2 hover:text-blue-300 transition-colors">Sign Up</a>
            <?php endif; ?>
        </div>
    </nav>
    
    <!-- Main content starts here -->
    <main class="pt-16"><?php // Padding top to account for fixed navigation ?>
