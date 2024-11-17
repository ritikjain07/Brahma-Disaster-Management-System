<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medical Aid</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    #map {
      height: 500px;
      width: 100%;
    }
  </style>
</head>
<body class="bg-gray-100 flex flex-col items-center">

  <!-- Header with centered logo and name -->
  <header class="bg-black text-white w-full py-4 shadow-md fixed top-0 z-50">
    <div class="container mx-auto px-4 flex justify-between items-center">
      <div class="flex items-center justify-center w-full">
        <img src="logo.png" alt="Brahma Logo" class="h-12 mr-2">
        <span class="text-2xl font-bold">Brahma</span>
      </div>
      <nav class="flex space-x-4">
        <a href="main.html" class="hover:text-blue-500 mx-2">Home</a>
        <a href="index.html#about" class="hover:text-blue-500 mx-2">About Us</a>
        <a href="index.html#services" class="hover:text-blue-500 mx-2">Services</a>
        <a href="donation2.html" class="hover:text-blue-500 mx-2">Donation</a>
        <a href="index.html#login" class="hover:text-blue-500 mx-2">Login</a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <div class="bg-zinc-950 flex flex-col items-center w-screen pt-24 px-4 md:px-0">
    <div class="text-center mt-16 mb-4">
      <h1 class="text-white text-2xl md:text-4xl font-bold">Medical Aid</h1>
    </div>

    <!-- Map Section -->
    <div class="w-full max-w-6xl mt-8">
      <div id="map"></div>
    </div>

    <!-- Appointment Booking Form (for future implementation) -->
    <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg w-full max-w-lg mt-8">
      <h2 class="text-lg font-bold mb-4">Book an Appointment</h2>
      <form method="post" action="book_appointment.php">
        <!-- Form Fields Here -->
      </form>
    </div>
  </div>

  <script>
    // Initialize Leaflet map
    const map = L.map('map').setView([0, 0], 13); // Default center; will be updated by geolocation

    // Add a tile layer to the map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    }).addTo(map);

    // Function to generate random nearby locations within land areas
    function getRandomNearbyLocations(lat, lon, numLocations) {
      const locations = [];
      const maxLatOffset = 0.05; // Adjusted radius for land area
      const maxLonOffset = 0.05; // Adjusted radius for land area
      for (let i = 0; i < numLocations; i++) {
        // Ensure generated locations are plausible
        const offsetLat = (Math.random() - 0.5) * maxLatOffset;
        const offsetLon = (Math.random() - 0.5) * maxLonOffset;

        // Ensure the offset does not push the location outside realistic bounds
        if (lat + offsetLat >= -90 && lat + offsetLat <= 90 && lon + offsetLon >= -180 && lon + offsetLon <= 180) {
          locations.push({
            lat: lat + offsetLat,
            lon: lon + offsetLon,
            name: `Hospital ${i + 1}`
          });
        }
      }
      return locations;
    }

    // Use geolocation API to center the map and add hospital markers
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(position => {
        const userLat = position.coords.latitude;
        const userLon = position.coords.longitude;

        // Center the map on the user's location
        map.setView([userLat, userLon], 13);

        // Generate random hospital locations nearby
        const hospitals = getRandomNearbyLocations(userLat, userLon, 5);

        // Add markers for each hospital
        hospitals.forEach(hospital => {
          L.marker([hospital.lat, hospital.lon])
            .addTo(map)
            .bindPopup(hospital.name);
        });
      }, () => {
        alert('Geolocation is not supported or permission denied.');
      });
    } else {
      alert('Geolocation is not supported by this browser.');
    }
  </script>
</body>
</html>
