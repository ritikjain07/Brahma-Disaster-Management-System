<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Brahma - Disaster Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('background.jpg') no-repeat center center fixed;
      background-size: cover;
      padding-top: 4rem;
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
    }
    .sos-button {
      background: radial-gradient(circle, hsla(10, 74%, 63%, 1) 0%, hsla(0, 73%, 42%, 1) 100%);
      transition: transform 0.3s ease-in-out;
    }
    .sos-button:hover {
      transform: scale(1.1);
    }
    .typing-animation {
      border-right: 2px solid rgba(255, 255, 255, 0.75);
      white-space: nowrap;
      overflow: hidden;
      display: inline-block;
      animation: typing 4s steps(40, end), blink-caret .75s step-end infinite;
    }
    @keyframes typing {
      from { width: 0; }
      to { width: 100%; }
    }
    @keyframes blink-caret {
      from, to { border-color: transparent; }
      50% { border-color: rgba(255, 255, 255, 0.75); }
    }
    a {
      transition: color 0.3s ease-in-out;
    }
    a:hover {
      color: #ff6347;
    }
    .weather-container {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 100%;
    }
    .weather-title {
      font-size: 24px;
      margin-bottom: 10px;
    }
    .weather-data {
      font-size: 18px;
      margin: 5px 0;
    }
    .loading, .error-message {
      color: #d32f2f;
    }
  </style>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-start min-h-screen">

  <div class="overlay"></div>

  <div class="fixed top-0 left-0 right-0 flex items-center justify-center p-4 bg-black shadow-md z-50">
    <div class="flex items-center space-x-2">
      <img src="logo.png" alt="Logo" class="h-14">
      <span class="text-2xl font-bold text-white">Brahma</span>
    </div>
    <button id="sidebarToggle" class="absolute left-4 p-2 text-white">
      ☰
    </button>
  </div>

  <div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-black shadow-md transform -translate-x-full transition-transform duration-300">
    <div class="p-4">
      <h2 class="text-lg font-bold text-white">Menu</h2>
      <ul class="mt-4 space-y-2">
        <li><a href="#home" class="block p-2 text-white hover:bg-gray-700">Home</a></li>
        <li><a href="/about-page/index.html" class="block p-2 text-white hover:bg-gray-700">About</a></li>
        <li><a href="/service-page/index.html" class="block p-2 text-white hover:bg-gray-700">Services</a></li>
        <li><a href="/contact-page/index.html" class="block p-2 text-white hover:bg-gray-700">Contact</a></li>
        <li><a href="/donation2.html" class="block p-2 text-white hover:bg-gray-700">Donation</a></li>
        <li><a href="/brahma_main/login.html" class="block p-2 text-white hover:bg-gray-700">Logout</a></li>
      </ul>
    </div>
  </div>

  <div class="hero flex flex-col items-center justify-center text-center w-[80%] h-[50%] text-[3vw] text-white">
    <h1 class="text-5xl font-bold typing-animation">Do You Need Help?</h1>
    <p class="mt-4 text-xl typing-animation">We're here to provide immediate assistance in times of disaster.</p>
    <div class="mt-8 flex flex-col items-center">
      <div id="sosButton" class="sos-button w-[15vw] h-[15vw] rounded-full text-white flex justify-center items-center text-4xl font-bold shadow-2xl shadow-red-500/50 cursor-pointer">
        SOS
      </div>
      <p class="mt-2 text-white text-xl font-medium italic">Click Above for Immediate Assistance</p>
    </div>
  </div>

  <!-- Weather Information Section -->
  <div class="w-full flex justify-center mt-12">
    <div class="weather-container">
      <h2 class="weather-title">Weather Information</h2>
      <p id="loading-message" class="loading">Loading...</p>
      <p id="weather-location" class="weather-data"></p>
      <p id="weather-temp" class="weather-data"></p>
      <p id="weather-condition" class="weather-data"></p>
      <p id="error-message" class="error-message"></p>
    </div>
  </div>

  <div class="w-full flex justify-center mt-12">
    <div class="w-[80%] bg-black p-6 rounded-lg text-white">
      <h2 class="text-3xl font-bold mb-4">Our Impact Stories</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gray-800 p-4 rounded-lg">
          <h3 class="text-xl font-bold mb-2">Rescue Operation</h3>
          <p class="text-white">Brahma's quick response saved many lives during the recent floods in Bengal. Our team was able to evacuate over 200 people and provide essential supplies.</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-lg">
          <h3 class="text-xl font-bold mb-2">Medical Aid</h3>
          <p class="text-white">Our medical team provided crucial aid in remote areas of the Himalayas, delivering over 1000 medical kits and offering free medical checkups.</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-lg">
          <h3 class="text-xl font-bold mb-2">Disaster Relief</h3>
          <p class="text-white">Brahma provided food, water, and shelter to hundreds of families affected by the earthquake in Nepal. Our relief efforts continue to make a difference.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Donations Section -->
  <div class="w-full flex justify-center mt-12 mb-12">
    <div class="w-[80%] bg-black p-6 rounded-lg text-center text-white">
      <h2 class="text-3xl font-bold mb-4">Support Our Cause</h2>
      <p class="mb-6">Your donations help us provide vital assistance in times of disaster. Join us in making a difference today.</p>
      <a href="/donation2.html" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition">Donate Now</a>
    </div>
  </div>

  <footer class="w-full bg-black py-8">
    <div class="w-[80%] mx-auto text-white flex flex-col md:flex-row justify-between items-center">
      <div class="text-center md:text-left mb-4 md:mb-0">
        <h3 class="text-2xl font-bold">Brahma</h3>
        <p class="text-sm">Leading Disaster Management System</p>
      </div>
      <div class="flex space-x-6 mb-4 md:mb-0">
        <a href="/about-page/index.html" class="text-sm text-gray-400 hover:text-white">About Us</a>
        <a href="/service-page/index.html" class="text-sm text-gray-400 hover:text-white">Services</a>
        <a href="/contact-page/index.html" class="text-sm text-gray-400 hover:text-white">Contact</a>
        <a href="/donation2.html" class="text-sm text-gray-400 hover:text-white">Donate</a>
      </div>
    </div>
    <p class="text-center text-gray-400 text-sm mt-4">© 2024 Brahma. All rights reserved.</p>
  </footer>

  <script>
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });

    // SOS button click event
    const sosButton = document.getElementById('sosButton');
    sosButton.addEventListener('click', () => {
      alert('Emergency services have been alerted. Help is on the way.');
    });

    // Weather API integration (using your API key)
    const apiKey = '9ed7fc6bfb9a4f75bec34602241507';

    async function getWeather() {
      const url = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=latitude,longitude`;
      
      try {
        const response = await fetch(url);
        if (!response.ok) {
          throw new Error('Weather data not available');
        }
        const data = await response.json();
        updateWeather(data);
      } catch (error) {
        console.error('Error fetching weather:', error.message);
        document.getElementById('loading-message').style.display = 'none';
        document.getElementById('error-message').textContent = 'Failed to fetch weather data.';
      }
    }

    function updateWeather(data) {
      document.getElementById('loading-message').style.display = 'none';
      document.getElementById('weather-location').textContent = `Location: ${data.location.name}, ${data.location.region}, ${data.location.country}`;
      document.getElementById('weather-temp').textContent = `Temperature: ${data.current.temp_c}°C`;
      document.getElementById('weather-condition').textContent = `Condition: ${data.current.condition.text}`;
    }

    getWeather();
  </script>

</body>
</html>
