<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather Forecast</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-100 flex items-center justify-center min-h-screen">
  <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Brahma Weather Forecast</h1>
    <div class="flex mb-6">
      <input type="text" id="location-input" class="flex-grow p-3 border rounded-l-lg" placeholder="Enter a location">
      <button id="get-weather-btn" class="bg-blue-500 text-white p-3 rounded-r-lg hover:bg-blue-700">Get Weather</button>
    </div>
    <div id="weather-container" class="p-6 bg-blue-50 rounded-lg shadow-inner"></div>
  </div>
  <script>
    const apiKey = '9ed7fc6bfb9a4f75bec34602241507';
const weatherContainer = document.getElementById('weather-container');
const getWeatherBtn = document.getElementById('get-weather-btn');
const locationInput = document.getElementById('location-input');

// Fetch weather data by location
const fetchWeather = (location) => {
  fetch(`https://api.weatherapi.com/v1/forecast.json?key=${apiKey}&q=${location}&days=3&alerts=yes`)
    .then(response => response.json())
    .then(data => renderWeather(data))
    .catch(error => console.error('Error:', error));
};

// Render weather data to the container
const renderWeather = (data) => {
  const { location, current, forecast, alerts } = data;

  const currentWeatherHTML = `
    <div class="text-center mb-6">
      <h2 class="text-2xl font-bold mb-4">${location.name}, ${location.country}</h2>
      <img src="${current.condition.icon}" alt="Weather Icon" class="mx-auto mb-4">
      <p class="text-xl">${current.condition.text}</p>
      <p class="text-2xl font-bold">${current.temp_c}°C</p>
      <p class="text-md text-gray-600">Feels like: ${current.feelslike_c}°C</p>
      <p class="text-md text-gray-600">Humidity: ${current.humidity}%</p>
      <p class="text-md text-gray-600">Wind: ${current.wind_kph} kph, ${current.wind_dir}</p>
      <p class="text-md text-gray-600">UV Index: ${current.uv}</p>
      <p class="text-md text-gray-600">Sunrise: ${forecast.forecastday[0].astro.sunrise}</p>
      <p class="text-md text-gray-600">Sunset: ${forecast.forecastday[0].astro.sunset}</p>
    </div>
  `;

  const forecastHTML = forecast.forecastday.map(day => `
    <div class="weather-box p-4 mb-4 bg-white rounded-lg shadow-md">
      <h3 class="text-lg font-bold mb-2">${new Date(day.date).toDateString()}</h3>
      <img src="${day.day.condition.icon}" alt="${day.day.condition.text}" class="mx-auto mb-2">
      <p class="text-md">${day.day.condition.text}</p>
      <p class="text-md">Max Temp: ${day.day.maxtemp_c}°C</p>
      <p class="text-md">Min Temp: ${day.day.mintemp_c}°C</p>
      <p class="text-md">Avg Humidity: ${day.day.avghumidity}%</p>
      <p class="text-md">Chance of Rain: ${day.day.daily_chance_of_rain}%</p>
      <p class="text-md">UV Index: ${day.day.uv}</p>
      <p class="text-md">Sunrise: ${day.astro.sunrise}</p>
      <p class="text-md">Sunset: ${day.astro.sunset}</p>
    </div>
  `).join('');

  const alertsHTML = alerts.alert.length ? `
    <div class="alerts bg-red-100 p-4 mb-6 rounded-lg shadow-md">
      <h3 class="text-xl font-bold mb-2">Weather Alerts</h3>
      ${alerts.alert.map(alert => `
        <div class="alert mb-2">
          <h4 class="font-bold">${alert.headline}</h4>
          <p>${alert.desc}</p>
          <p class="text-sm text-gray-600">Effective: ${alert.effective}</p>
          <p class="text-sm text-gray-600">Expires: ${alert.expires}</p>
        </div>
      `).join('')}
    </div>
  ` : '';

  weatherContainer.innerHTML = `
    ${alertsHTML}
    ${currentWeatherHTML}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      ${forecastHTML}
    </div>
  `;
};

// Get weather for the input location
getWeatherBtn.addEventListener('click', () => {
  const location = locationInput.value;
  if (location) {
    fetchWeather(location);
  } else {
    alert('Please enter a location');
  }
});

// Get user's current location and fetch weather
const fetchWeatherByCoords = (lat, lng) => {
  fetch(`https://api.weatherapi.com/v1/forecast.json?key=${apiKey}&q=${lat},${lng}&days=3&alerts=yes`)
    .then(response => response.json())
    .then(data => renderWeather(data))
    .catch(error => console.error('Error:', error));
};

// Get current position of the user
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(position => {
    const { latitude, longitude } = position.coords;
    fetchWeatherByCoords(latitude, longitude);
  }, () => {
    alert('Could not get your location');
  });
} else {
  alert('Geolocation is not supported by your browser');
}


  </script>
</body>
</html>
