<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emergency Contacts</title>
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

    .contact-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-decoration: none;
      color: white;
    }

    .contact-card i {
      margin-right: 0.5rem;
    }

    .contact-card:hover {
      opacity: 0.8;
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
    <div class="container mx-auto justify-centre text-center">
      <!-- Logo -->
      <div class="logo-container">
        <img src="logo_brahma.png" alt="Brahma Logo" class="logo">
      </div>

      <h2 class="text-3xl font-bold mb-8 text-white">Emergency Contacts</h2>
      <p class="text-lg mb-12 text-white">For immediate assistance, please contact the following emergency services:</p>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="tel:+911" class="contact-card bg-red-600 hover:bg-red-700">
          <i class="fas fa-ambulance fa-2x"></i>
          <div class="flex-1 text-left">
            <div class="text-xl">Ambulance 🚑</div>
            <div class="text-lg font-semibold">+91 911</div>
          </div>
        </a>

        <a href="tel:+100" class="contact-card bg-blue-600 hover:bg-blue-700">
          <i class="fas fa-police fa-2x"></i>
          <div class="flex-1 text-left">
            <div class="text-xl">Police 🚓</div>
            <div class="text-lg font-semibold">+91 100</div>
          </div>
        </a>

        <a href="tel:+101" class="contact-card bg-yellow-600 hover:bg-yellow-700">
          <i class="fas fa-fire-extinguisher fa-2x"></i>
          <div class="flex-1 text-left">
            <div class="text-xl">Fire Brigade 🚒</div>
            <div class="text-lg font-semibold">+91 101</div>
          </div>
        </a>

        <a href="tel:+112" class="contact-card bg-green-600 hover:bg-green-700">
          <i class="fas fa-plane fa-2x"></i>
          <div class="flex-1 text-left">
            <div class="text-xl">Air Ambulance ✈️</div>
            <div class="text-lg font-semibold">+91 112</div>
          </div>
        </a>

        <a href="tel:+1099" class="contact-card bg-purple-600 hover:bg-purple-700">
          <i class="fas fa-users fa-2x"></i>
          <div class="flex-1 text-left">
            <div class="text-xl">Disaster Management 🚨</div>
            <div class="text-lg font-semibold">+91 1099</div>
          </div>
        </a>
      </div>
    </div>
  </main>

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
