<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survival Tips</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: url('bgidn.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 200px;
        }

        .tip-card {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: white;
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .tip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .tip-card i {
            margin-right: 0.5rem;
        }
    </style>
</head>

<body class="text-gray-800">
    <!-- Header -->
    <header class="bg-blue-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Brahma</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="index.php" class="hover:underline">Home</a></li>
                    <li><a href="about-page.php" class="hover:underline">About</a></li>
                    <li><a href="service-page.php" class="hover:underline">Services</a></li>
                    <li><a href="contact-page.php" class="hover:underline">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto text-center">
            <!-- Logo -->
            <div class="logo-container">
                <img src="logo_brahma.png" alt="Brahma Logo" class="logo">
            </div>

            <h2 class="text-3xl font-bold mb-8 text-white">Survival Tips</h2>
            <p class="text-lg mb-12 text-white">Click on the tips below to learn more about survival strategies during disasters:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="https://www.ready.gov/earthquakes" target="_blank" class="tip-card bg-red-600 hover:bg-red-700">
                    <i class="fas fa-radiation-alt"></i> Earthquake Survival Tips 🌍
                </a>

                <a href="https://www.ready.gov/floods" target="_blank" class="tip-card bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-water"></i> Flood Survival Tips 🌊
                </a>

                <a href="https://www.ready.gov/hurricanes" target="_blank" class="tip-card bg-yellow-600 hover:bg-yellow-700">
                    <i class="fas fa-wind"></i> Hurricane Survival Tips 🌪️
                </a>

                <a href="https://www.ready.gov/wildfires" target="_blank" class="tip-card bg-green-600 hover:bg-green-700">
                    <i class="fas fa-fire"></i> Wildfire Survival Tips 🔥
                </a>

                <a href="https://www.ready.gov/tornadoes" target="_blank" class="tip-card bg-purple-600 hover:bg-purple-700">
                    <i class="fas fa-wind"></i> Tornado Survival Tips 🌪️
                </a>

                <a href="https://www.ready.gov/public-spaces" target="_blank" class="tip-card bg-red-400 hover:bg-orange-700">
                    <i class="fas fa-temperature-high"></i> Attacks in Public Places Survival Tips
                </a>

                <a href="https://www.ready.gov/tsunamis" target="_blank" class="tip-card bg-indigo-600 hover:bg-indigo-700">
                    <i class="fas fa-water"></i> Tsunami Survival Tips 🌊
                </a>

                <a href="https://www.ready.gov/extreme-heat" target="_blank" class="tip-card bg-red-900 hover:bg-orange-700">
                    <i class="fas fa-temperature-high"></i> Extreme Heat Survival Tips ☀️
                </a>

                <a href="https://www.ready.gov/power-outages" target="_blank" class="tip-card bg-gray-600 hover:bg-gray-700">
                    <i class="fas fa-bolt"></i> Power Outage Survival Tips ⚡
                </a>
            </div>
        </div>
    </main>

    https://www.ready.gov/public-spaces

    <!-- Footer -->
    <footer class="bg-gray-900 text-white p-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Brahma. All rights reserved.</p>
            <nav class="mt-2">
                <a href="index.php" class="text-blue-400 hover:underline mx-2">Home</a>
                <a href="about-page.php" class="text-blue-400 hover:underline mx-2">About</a>
                <a href="service-page.php" class="text-blue-400 hover:underline mx-2">Services</a>
                <a href="contact-page.php" class="text-blue-400 hover:underline mx-2">Contact</a>
            </nav>
        </div>
    </footer>
</body>

</html>