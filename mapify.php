<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "brahma_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if (isset($latitude) && isset($longitude)) {
        $stmt = $conn->prepare("INSERT INTO locations (latitude, longitude) VALUES (?, ?)");
        $stmt->bind_param("dd", $latitude, $longitude);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            echo '<script>alert("Location saved successfully");</script>';
        } else {
            echo '<script>alert("Error saving location: ' . $stmt->error . '");</script>';
            $stmt->close();
            $conn->close();
        }
    } else {
        echo '<script>alert("Invalid data");</script>';
        $conn->close();
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disaster Management Map</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        #map {
            height: calc(100vh - 4rem);
        }
        #sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #333;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            z-index: 1000;
        }
        #sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }
        #sidebar a:hover {
            color: #f1f1f1;
        }
        #sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        #sidebarToggle {
            font-size: 30px;
            cursor: pointer;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #333;
            color: white;
            z-index: 10;
        }
        .header .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }
        .header .logo-container img {
            height: 3.5rem;
            margin-right: 0.5rem;
        }
        .header .logo-container span {
            font-size: 1.75rem;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="header">
    <span id="sidebarToggle" class="cursor-pointer text-2xl ml-4">
        ☰
    </span>
    <div class="logo-container">
        <img src="logo.png" alt="Logo" class="h-2">
        <span class="text-2xl font-bold">Brahma</span>
    </div>
    <div style="width: 50px;"></div>
</div>

<div id="sidebar" class="bg-gray-900 text-white">
    <a href="javascript:void(0)" class="closebtn text-3xl" onclick="closeSidebar()">&times;</a>
    <a href="index.php" class="block px-4 py-2 hover:bg-gray-700">Home</a>
    <a href="info.php" class="block px-4 py-2 hover:bg-gray-700">Disaster Information</a>
</div>

<div class="mt-16">
    <div id="map" class="h-screen"></div>
</div>

<form id="locationForm" action="mapify.php" method="POST" target="hiddenFrame" style="display:none;">
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
</form>

<iframe name="hiddenFrame" style="display:none;"></iframe>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>
    'use strict';

    let map, routingControl;
    let userLat, userLon;

    const disasterData = [
        { type: 'Earthquake', lat: 34.0522, lon: -118.2437 },
        { type: 'Flood', lat: 29.7604, lon: -95.3698 },
        { type: 'Fire', lat: 37.7749, lon: -122.4194 }
    ];

    const hospitalData = [
        { name: 'Hospital 1', lat: 34.0722, lon: -118.2437 },
        { name: 'Hospital 2', lat: 29.7704, lon: -95.3698 }
    ];

    const shelterData = [
        { name: 'Shelter 1', lat: 34.0622, lon: -118.2537 },
        { name: 'Shelter 2', lat: 29.7504, lon: -95.3598 }
    ];

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const { latitude, longitude } = position.coords;
                userLat = latitude;
                userLon = longitude;
                const coords = [latitude, longitude];
                map = L.map('map').setView(coords, 16);
                L.tileLayer('https://tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                }).addTo(map);
                L.marker(coords).addTo(map).bindPopup('You are here.').openPopup();

                disasterData.forEach(disaster => {
                    L.marker([disaster.lat, disaster.lon]).addTo(map).bindPopup(disaster.type);
                });

                hospitalData.forEach(hospital => {
                    L.marker([hospital.lat, hospital.lon], { icon: L.icon({ iconUrl: 'https://cdn-icons-png.flaticon.com/512/883/883408.png', iconSize: [30, 30] }) }).addTo(map).bindPopup(hospital.name);
                });

                shelterData.forEach(shelter => {
                    L.marker([shelter.lat, shelter.lon], { icon: L.icon({ iconUrl: 'https://cdn-icons-png.flaticon.com/512/4825/4825898.png', iconSize: [30, 30] }) }).addTo(map).bindPopup(shelter.name);
                });

                map.on('click', function(e) {
                    const { lat, lng } = e.latlng;
                    if (routingControl) {
                        map.removeControl(routingControl);
                    }
                    routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(userLat, userLon),
                            L.latLng(lat, lng)
                        ],
                        routeWhileDragging: true
                    }).addTo(map);
                });

                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
                document.getElementById('locationForm').submit();
            },
            function (error) {
                console.error('Error getting location:', error.message);
                alert('Could not get your position');
            }
        );
    } else {
        alert('Geolocation is not supported by your browser');
    }

    document.getElementById('sidebarToggle').addEventListener('click', openSidebar);

    function openSidebar() {
        document.getElementById('sidebar').style.left = "0";
    }

    function closeSidebar() {
        document.getElementById('sidebar').style.left = "-250px";
    }
</script>

</body>
</html>
