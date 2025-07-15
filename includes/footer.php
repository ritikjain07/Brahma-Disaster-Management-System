    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Section -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="<?php echo $basePath; ?>assets/images/logo_brahma.png" alt="Brahma Logo" class="h-8 w-8">
                        <span class="text-xl font-bold">Brahma</span>
                    </div>
                    <p class="text-gray-300">
                        Advanced disaster management system designed to assist individuals and organizations in responding effectively during emergencies.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo $basePath; ?>index.php" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/about-page.php" class="text-gray-300 hover:text-white transition-colors">About</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/service-page.php" class="text-gray-300 hover:text-white transition-colors">Services</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/contact-page.php" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Services</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo $basePath; ?>pages/emergencyForm.php" class="text-gray-300 hover:text-white transition-colors">Emergency Report</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/weather.php" class="text-gray-300 hover:text-white transition-colors">Weather Forecast</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/medical_aid.php" class="text-gray-300 hover:text-white transition-colors">Medical Aid</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/missing_person.php" class="text-gray-300 hover:text-white transition-colors">Missing Person</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                    <div class="space-y-2">
                        <p class="text-gray-300">
                            <i class="fas fa-envelope mr-2"></i>
                            ritikjain4560@gmail.com
                        </p>
                        <p class="text-gray-300">
                            <i class="fas fa-phone mr-2"></i>
                            Emergency: 911
                        </p>
                        <p class="text-gray-300">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Available 24/7
                        </p>
                    </div>
                </div>
            </div>
            
            <hr class="border-gray-600 my-6">
            
            <!-- Bottom Footer -->
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 text-center md:text-left">
                    © 2025 Brahma Disaster Management System. All rights reserved.
                </p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="https://github.com/ritikjain07" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="mailto:ritikjain4560@gmail.com" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="<?php echo $basePath; ?>assets/js/script.js"></script>
    
    <!-- Mobile menu toggle script -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
    
    <!-- Additional scripts -->
    <?php if (isset($additionalScripts)) echo $additionalScripts; ?>
    
</body>
</html>
