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
    <title>Disaster Management Map | Brahma</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }
        
        .map-container {
            position: relative;
            height: calc(100vh - 64px);
            width: 100%;
            margin-top: 64px;
        }
        
        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
            background-color: #f0f0f0; /* Light background to see if it's loading */
        }
        
        #sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #1f2937;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 70px;
            z-index: 1001;
            box-shadow: 2px 0 5px rgba(0,0,0,0.2);
        }
        
        #sidebar a {
            padding: 12px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #e5e7eb;
            display: block;
            transition: 0.2s;
        }
        
        #sidebar a:hover {
            background-color: #374151;
        }
        
        #sidebar .closebtn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            margin-left: 50px;
        }
        
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            align-items: center;
            height: 64px;
            padding: 0 1rem;
            background-color: #1f2937;
            color: white;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        #sidebarToggle {
            font-size: 24px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: background-color 0.2s;
        }
        
        #sidebarToggle:hover {
            background-color: #374151;
        }
        
        .header .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }
        
        .header .logo-container img {
            height: 40px;
            margin-right: 10px;
        }
        
        .header .logo-container span {
            font-size: 22px;
            font-weight: bold;
        }
        
        .map-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 500;
            background-color: white;
            padding: 8px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .map-legend {
            position: absolute;
            bottom: 25px;
            right: 10px;
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 500;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .legend-color {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            border-radius: 50%;
        }
        
        .user-marker { background-color: blue; }
        .disaster-marker { background-color: red; }
        .hospital-marker { background-color: green; }
        .shelter-marker { background-color: orange; }
        
        /* Debug styles */
        .debug-info {
            position: fixed;
            top: 70px;
            left: 10px;
            background: white;
            padding: 5px;
            border-radius: 4px;
            z-index: 2000;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="header">
    <span id="sidebarToggle">
        ☰
    </span>
    <div class="logo-container">
        <img src="logo.png" alt="Brahma Logo">
        <span>Brahma</span>
    </div>
    <div style="width: 40px;"></div>
</div>

<div id="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">&times;</a>
    <a href="index.php">Home</a>
    <a href="info.php">Disaster Information</a>
    <a href="emergencyForm.php">Emergency Contacts</a>
    <a href="search.php">Search Resources</a>
    <a href="profile.php">My Profile</a>
</div>

<div class="map-container">
    <div id="map"></div>
    
    <div class="map-controls">
        <button onclick="getCurrentLocation()" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4Zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1ZM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Z"/>
            </svg>
        </button>
    </div>
    
    <div class="map-legend">
        <h3 class="font-bold mb-2">Map Legend</h3>
        <div class="legend-item">
            <div class="legend-color user-marker"></div>
            <span>Your Location</span>
        </div>
        <div class="legend-item">
            <div class="legend-color disaster-marker"></div>
            <span>Disaster Area</span>
        </div>
        <div class="legend-item">
            <div class="legend-color hospital-marker"></div>
            <span>Hospital</span>
        </div>
        <div class="legend-item">
            <div class="legend-color shelter-marker"></div>
            <span>Shelter</span>
        </div>
    </div>
    
    <!-- Debug info panel -->
    <div class="debug-info" id="debug-info">Map loading...</div>
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

    // Debug function to help diagnose issues
    function debug(msg) {
        const debugEl = document.getElementById('debug-info');
        debugEl.innerHTML += '<br>' + msg;
    }

    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        debug("DOM loaded");
        initMap();
    });

    let map, routingControl;
    let userLat, userLon;
    let userMarker;

    function initMap() {
        try {
            debug("Initializing map");
            
            // Check if map element exists
            const mapElement = document.getElementById('map');
            if (!mapElement) {
                debug("Map element not found!");
                return;
            }
            
            debug("Map element found");
            
            // Initialize map with a default view
            map = L.map('map', {
                zoomControl: true,
                attributionControl: true
            }).setView([34.0522, -118.2437], 10);
            
            debug("Map object created");
            
            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);
            
            debug("Tile layer added");
            
            // Data for markers
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
            
            debug("Data prepared");

            // Custom icons
            const userIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/149/149060.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
            
            const hospitalIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/883/883408.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
            
            const shelterIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/4825/4825898.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
            
            const disasterIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/1684/1684426.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
            
            debug("Icons created");

            // Add disaster markers
            disasterData.forEach(disaster => {
                L.marker([disaster.lat, disaster.lon], { icon: disasterIcon })
                    .addTo(map)
                    .bindPopup(`<b>${disaster.type}</b><br>Active disaster area`);
            });
            
            debug("Disaster markers added");

            // Add hospital markers
            hospitalData.forEach(hospital => {
                L.marker([hospital.lat, hospital.lon], { icon: hospitalIcon })
                    .addTo(map)
                    .bindPopup(`<b>${hospital.name}</b><br>Medical Facility`);
            });
            
            debug("Hospital markers added");

            // Add shelter markers
            shelterData.forEach(shelter => {
                L.marker([shelter.lat, shelter.lon], { icon: shelterIcon })
                    .addTo(map)
                    .bindPopup(`<b>${shelter.name}</b><br>Emergency Shelter`);
            });
            
            debug("Shelter markers added");
            
            // Set up map click handler for routing
            map.on('click', function(e) {
                const { lat, lng } = e.latlng;
                
                if (!userLat || !userLon) {
                    alert('Please share your location first to enable routing');
                    return;
                }
                
                if (routingControl) {
                    map.removeControl(routingControl);
                }
                
                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(userLat, userLon),
                        L.latLng(lat, lng)
                    ],
                    routeWhileDragging: true,
                    lineOptions: {
                        styles: [{ color: '#6366F1', weight: 6 }]
                    },
                    createMarker: function() { return null; } // Don't create default markers
                }).addTo(map);
            });
            
            debug("Click handler set up");
            
            // Get user location after map is fully initialized
            setTimeout(getCurrentLocation, 1000);
            
            // Fix map size issues
            setTimeout(function() {
                map.invalidateSize();
                debug("Map size refreshed");
            }, 300);
        } catch (error) {
            debug("Error: " + error.message);
            console.error("Map initialization error:", error);
        }
    }

    function getCurrentLocation() {
        debug("Getting current location");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const { latitude, longitude } = position.coords;
                    userLat = latitude;
                    userLon = longitude;
                    
                    debug("Location received: " + latitude + ", " + longitude);
                    
                    try {
                        // Center map on user location
                        map.setView([latitude, longitude], 16);
                        
                        // Update or create user marker
                        if (userMarker) {
                            userMarker.setLatLng([latitude, longitude]);
                        } else {
                            userMarker = L.marker([latitude, longitude], { 
                                icon: L.icon({
                                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/149/149060.png',
                                    iconSize: [32, 32],
                                    iconAnchor: [16, 32],
                                    popupAnchor: [0, -32]
                                })
                            })
                            .addTo(map)
                            .bindPopup('Your current location')
                            .openPopup();
                        }
                        
                        debug("Marker added");
                        
                        // Save location to database
                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;
                        document.getElementById('locationForm').submit();
                        
                        // Hide debug info after successful loading
                        setTimeout(function() {
                            document.getElementById('debug-info').style.display = 'none';
                        }, 2000);
                    } catch (error) {
                        debug("Error in location handling: " + error.message);
                    }
                },
                function (error) {
                    debug("Geolocation error: " + error.message);
                    console.error('Error getting location:', error.message);
                    alert('Could not get your position: ' + error.message);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        } else {
            debug("Geolocation not supported");
            alert('Geolocation is not supported by your browser');
        }
    }

    // Sidebar functions
    document.getElementById('sidebarToggle').addEventListener('click', openSidebar);

    function openSidebar() {
        document.getElementById('sidebar').style.left = "0";
    }

    function closeSidebar() {
        document.getElementById('sidebar').style.left = "-250px";
    }
    
    // Fix map size issues when window resizes
    window.addEventListener('resize', function() {
        setTimeout(function() {
            try {
                if (map) map.invalidateSize();
            } catch (error) {
                console.error("Error resizing map:", error);
            }
        }, 100);
    });
</script>

</body>
</html>