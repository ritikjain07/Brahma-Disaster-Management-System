<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Brahma - Disaster Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
  <style>
    body {
      background: url('bgidn.jpg') no-repeat center center fixed;
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

    .typing-animation {
      border-right: 2px solid rgba(255, 255, 255, 0.75);
      white-space: nowrap;
      overflow: hidden;
      display: inline-block;
      animation: typing 4s steps(40, end), blink-caret .75s step-end infinite;
    }

    @keyframes typing {
      from {
        width: 0;
      }

      to {
        width: 100%;
      }
    }

    @keyframes blink-caret {

      from,
      to {
        border-color: transparent;
      }

      50% {
        border-color: rgba(255, 255, 255, 0.75);
      }
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
      max-width: 800px;
    }

    .weather-title {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .weather-data {
      font-size: 18px;
      margin: 5px 0;
    }

    .weather-forecast {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-top: 20px;
    }

    .forecast-box {
      background-color: #ff6347;
      color: #ffffff;
      padding: 10px;
      border-radius: 8px;
      text-align: center;
    }

    /* Sidebar Styles */
    .sidebar {
      width: 256px;
      height: 100%;
      background-color: #000;
      position: fixed;
      top: 0;
      left: -256px;
      transition: left 0.3s;
      z-index: 1000;
    }

    .sidebar.active {
      left: 0;
    }

    .sidebar ul {
      padding: 20px;
      list-style: none;
    }

    .sidebar ul li a {
      display: block;
      padding: 15px;
      color: #fff;
      text-decoration: none;
      transition: background 0.3s;
    }

    .sidebar ul li a:hover {
      background-color: #333;
    }

    .fixed-nav {
      display: flex;
      justify-content: center;
      /* Centering the content */
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      padding: 0 1rem;
      background-color: #000;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      z-index: 50;
    }

    .fixed-nav .nav-items {
      display: flex;
      align-items: center;
      /* space-x-2; */
    }

    .fixed-nav .logo {
      display: flex;
      align-items: center;
    }

    .fixed-nav .toggle-button {
      position: absolute;
      right: 1rem;
      background: none;
      border: none;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
    }
  </style>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-start min-h-screen">

  <div class="overlay"></div>

  <div class="fixed-nav">
    <div class="nav-items">
      <div class="logo">
        <img src="logo_brahma.png" alt="Logo" class="h-14">
        <span class="text-2xl font-bold text-white ml-2">Brahma</span>
      </div>
      <button id="sidebarToggle" class="toggle-button">
        ☰
      </button>
    </div>
  </div>


  <div id="sidebar" class="sidebar">
    <ul>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="about-page.php">About</a></li>
      <li><a href="/service-page/index.html">Services</a></li>
      <li><a href="contact-page.php">Contact</a></li>
      <li><a href="donation2.php">Donation</a></li>
      <li><a href="view_missing_person.php">View Missing Person</a></li>
      <li><a href="missing_person.php">Report a missing person</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
  </div>

  <div class="hero flex flex-col items-center justify-center text-center w-full text-white">
    <h1 class="text-5xl font-bold typing-animation">Do You Need Help?</h1>
    <p class="mt-4 text-xl">We're here to provide immediate assistance in times of disaster.</p>
    <div class="mt-8 flex flex-col items-center">
      <div id="sosButton" class="sos-button w-32 h-32 rounded-full text-white flex justify-center items-center text-4xl font-bold shadow-2xl cursor-pointer">
        SOS
      </div>
      <p class="mt-2 text-xl italic">Click Above for Immediate Assistance</p>
      <!-- New Section for Additional Buttons -->
      <div class="mt-12 flex flex-col space-y-4">
        <a href="emergencyForm.php" class="w-48 h-12 rounded-full text-white flex justify-center items-center text-xl font-bold shadow-2xl bg-blue-500 hover:bg-blue-600 transition">Emergency</a>
        <a href="evacuation.php" class="w-48 h-12 rounded-full text-white flex justify-center items-center text-xl font-bold shadow-2xl bg-yellow-500 hover:bg-yellow-600 transition">Evacuation</a>
        <a href="missing_person.php" class="w-48 h-12 rounded-full text-white flex justify-center items-center text-l font-bold shadow-2xl bg-red-500 hover:bg-red-600 transition">Report Missing Person</a>
        <a href="survival_tips.php" class="w-48 h-12 rounded-full text-white flex justify-center items-center text-xl font-bold shadow-2xl bg-green-500 hover:bg-green-600 transition">Survival tips</a>
      </div>
    </div>
  </div>


  <div class="w-full flex justify-center mt-12">
    <div class="weather-container">
      <h2 class="weather-title">Weather Information</h2>
      <p id="loading-message">Loading...</p>
      <p id="weather-location" class="weather-data"></p>
      <p id="weather-temp" class="weather-data"></p>
      <p id="weather-condition" class="weather-data"></p>
      <p id="weather-humidity" class="weather-data"></p>
      <p id="weather-wind" class="weather-data"></p>
      <div id="forecast-container" class="weather-forecast"></div>
      <p id="error-message" class="error-message"></p>
    </div>
  </div>

  <div>
    <a href="weatherForcast.php" class="w-48 h-12 rounded-full text-white flex justify-center items-center text-xl font-bold shadow-2xl bg-white-500 hover:bg-red-600 transition">Weather Forcast</a>
  </div>

  <div class="w-full flex justify-center mt-12">
    <div class="w-full max-w-4xl bg-black p-6 rounded-lg text-white">
      <h2 class="text-3xl font-bold mb-4">Our Impact Stories</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gray-800 p-4 rounded-lg">
          <h3 class="text-xl font-bold mb-2">Rescue Operation</h3>
          <p>Brahma's quick response saved many lives during the recent floods in Bengal. Our team was able to evacuate over 200 people and provide essential supplies.</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-lg">
          <h3 class="text-xl font-bold mb-2">Medical Aid</h3>
          <p>Our medical team provided crucial aid in remote areas of the Himalayas, delivering over 1000 medical kits and offering free medical checkups.</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-lg">
          <h3 class="text-xl font-bold mb-2">Disaster Relief</h3>
          <p>Brahma provided food, water, and shelter to hundreds of families affected by the earthquake in Nepal. Our relief efforts continue to make a difference.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="w-full flex justify-center mt-12 mb-12">
    <div class="w-full max-w-4xl bg-black p-6 rounded-lg text-center text-white">
      <h2 class="text-3xl font-bold mb-4">Support Our Cause</h2>
      <p class="mb-6">Your donations help us provide vital assistance in times of disaster. Join us in making a difference today.</p>
      <a href="donation2.php" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Donate Now</a>
    </div>
  </div>

  <script>
    document.getElementById('sosButton').addEventListener('click', function() {
      window.location.href = 'helpForm.php';
    });

    document.getElementById('sidebarToggle').addEventListener('click', function() {
      var sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('active');
    });

    // Fetch and display weather information
    getLocation();

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else {
        document.getElementById('loading-message').textContent = 'Geolocation is not supported by this browser.';
      }
    }

    function showPosition(position) {
      const lat = position.coords.latitude;
      const lon = position.coords.longitude;
      fetchWeatherData(lat, lon);
    }

    function showError(error) {
      switch (error.code) {
        case error.PERMISSION_DENIED:
          document.getElementById('loading-message').textContent = 'User denied the request for Geolocation.';
          break;
        case error.POSITION_UNAVAILABLE:
          document.getElementById('loading-message').textContent = 'Location information is unavailable.';
          break;
        case error.TIMEOUT:
          document.getElementById('loading-message').textContent = 'The request to get user location timed out.';
          break;
        case error.UNKNOWN_ERROR:
          document.getElementById('loading-message').textContent = 'An unknown error occurred.';
          break;
      }
    }

    function fetchWeatherData(lat, lon) {
      const apiKey = '9ed7fc6bfb9a4f75bec34602241507';
      fetch(`http://api.weatherapi.com/v1/forecast.json?key=${apiKey}&q=${lat},${lon}&days=3`)
        .then(response => response.json())
        .then(data => {
          displayWeatherData(data);
        })
        .catch(error => {
          console.error('Error fetching weather data:', error);
          document.getElementById('loading-message').textContent = 'Error loading weather data';
        });
    }

    function displayWeatherData(data) {
      const location = `${data.location.name}, ${data.location.region}, ${data.location.country}`;
      const temp = `Temperature: ${data.current.temp_c} °C`;
      const condition = `Condition: ${data.current.condition.text}`;
      const humidity = `Humidity: ${data.current.humidity} %`;
      const wind = `Wind: ${data.current.wind_kph} kph`;

      document.getElementById('weather-location').textContent = location;
      document.getElementById('weather-temp').textContent = temp;
      document.getElementById('weather-condition').textContent = condition;
      document.getElementById('weather-humidity').textContent = humidity;
      document.getElementById('weather-wind').textContent = wind;
      document.getElementById('loading-message').textContent = '';

      const forecastContainer = document.getElementById('forecast-container');
      data.forecast.forecastday.forEach(day => {
        const forecastBox = document.createElement('div');
        forecastBox.classList.add('forecast-box');
        forecastBox.innerHTML = `
          <p>${day.date}</p>
          <p>${day.day.condition.text}</p>
          <p>High: ${day.day.maxtemp_c} °C</p>
          <p>Low: ${day.day.mintemp_c} °C</p>
        `;
        forecastContainer.appendChild(forecastBox);
      });
    }
  </script>
</body>

</html>