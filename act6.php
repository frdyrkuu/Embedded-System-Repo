<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embedded System - Activities</title>
    <link rel="stylesheet" href="src/output.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Fixed Navigation Style */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000; /* Ensure it stays above other content */
        }
        
        /* Add padding to the body content to prevent overlap with fixed nav */
        body {
            padding-top: 60px; /* Adjust this value to the height of your nav */
        }

        .act-link {
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            text-align: center;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            background: linear-gradient(145deg, #2a2a2a, #1f1f1f);
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3), -4px -4px 8px rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .act-link:hover {
            background: linear-gradient(145deg, #1e1e1e, #2c2c2c);
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3), -2px -2px 6px rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
    </style>

    <!-- Map Style -->
    <style>
        #map {
            height: 400px; /* Adjust the height of the map */
            width: 100%;
            position: relative;
        }

        /* Button styling */
        #myLocationButton {
            display: block;
            padding: 10px 20px;
            background-color: white;
            color: black;
            border: 2px solid #000;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            position: absolute;
            bottom: 10px; /* Place the button near the bottom of the map */
            left: 50%; /* Center horizontally */
            transform: translateX(-50%); /* Centering trick */
            z-index: 1000; /* Ensure button stays above the map */
        }

        #myLocationButton:hover {
            background-color: #f0f0f0; /* Light gray hover effect */
        }
    </style>
</head>

<body class="bg-[#F5F5F5]">
    <!-- header -->
    <header>
        <nav class="bg-[#316FF6] border-blue-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="https://flowbite.com" class="flex items-center">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Embedded System</span>
                </a>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li><a href="/#act1" class="act-link">Act 1</a></li>
                        <li><a href="/#act2" class="act-link">Act 2</a></li>
                        <li><a href="/#act3" class="act-link">Act 3</a></li>
                        <li><a href="/#act4" class="act-link">Act 4</a></li>
                        <li><a href="/act5.php" class="act-link">Act 5</a></li>
                        <li><a href="/act6.php" class="act-link">Act 6</a></li>
                        <li><a href="/act7.php" class="act-link">Act 7</a></li>
                        <li><a href="/#act8" class="act-link">Act 8</a></li>
                        <li><a href="" class="act-link">Act 9</a></li>
                        <li><a href="" class="act-link">Act 10</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="max-w-7xl mx-auto px-10">
        <div class="mt-14">
            <h1 class="text-center text-4xl font-bold p-4">
                Embedded Systems
            </h1>
        </div>

        <div id="act1" class="mt-14 pt-16">
            <!-- Geolocation Map -->
            <h1>Geolocation Map</h1>
            <div id="map">
                <button id="myLocationButton">My Location</button>
            </div>

            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
            <script>
                // Initialize the map with a default view
                var map = L.map('map').setView([14.621761, 121.173875], 13);

                // Load tile layers on the map
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var marker;  // Declare marker variable

                // Function to fetch the latest latitude and longitude from the server
                function updateMap() {
                    fetch('/includes/get_act6.php')  // Fetch the data from the PHP script
                        .then(response => response.json())
                        .then(data => {
                            if (data.latitude && data.longitude) {
                                var lat = data.latitude;
                                var lng = data.longitude;

                                // Check if the marker exists, if not, create a new one
                                if (marker) {
                                    marker.setLatLng([lat, lng]); // Update marker position
                                } else {
                                    marker = L.marker([lat, lng]).addTo(map);  // Create a new marker
                                }

                                // Bind popup with updated GPS coordinates
                                marker.bindPopup(`<b>Marker at:</b><br>Lat: ${lat}<br>Lng: ${lng}`).openPopup();
                            }
                        })
                        .catch(error => console.error('Error fetching GPS data:', error));
                }

                // Add event listener for "My Location" button
                document.getElementById('myLocationButton').addEventListener('click', function() {
                    fetch('/includes/get_act6.php')
                        .then(response => response.json())
                        .then(data => {
                            if (data.latitude && data.longitude) {
                                var lat = data.latitude;
                                var lng = data.longitude;

                                // Center the map on the latest GPS coordinates
                                map.setView([lat, lng], 13);

                                // Also call updateMap to place the marker
                                updateMap();
                            }
                        })
                        .catch(error => console.error('Error fetching GPS data:', error));
                });

                // Flag to prevent automatic recentering
                var isUserInteracting = false;

                // Listen for map movements
                map.on('movestart', function() {
                    isUserInteracting = true; // User is interacting with the map
                });

                map.on('moveend', function() {
                    isUserInteracting = false; // User finished interacting with the map
                });

                // Update the map every 10 seconds but only update the marker position
                setInterval(function() {
                    if (!isUserInteracting) {
                        updateMap();
                    }
                }, 10000);

                // Initial call to update the map
                updateMap();
            </script>
        </div>

<br>
<br>

<div class="mt-4 text-center"> <!-- Add text-center class to the div -->
    <h1 class="text-center">Historical Data</h1>
    <div class="overflow-x-auto"> <!-- Optional: This will allow horizontal scrolling on smaller screens -->
        <table class="min-w-full border border-gray-300 mx-auto"> <!-- Add mx-auto for centering -->
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">Index</th>
                    <th class="border border-gray-300 p-2">Latitude</th>
                    <th class="border border-gray-300 p-2">Longitude</th>
                    <th class="border border-gray-300 p-2">Date</th>
                </tr>
            </thead>
            <tbody id="sensorDataBody">
                <!-- Data will be populated here by JavaScript -->
            </tbody>
        </table>
    </div>
</div>
<br>
<br>

    </main>
    <script src="script/act6_chart.js"></script>
</body>

</html>
