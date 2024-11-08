<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embedded System - Activities</title>
    <link rel="stylesheet" href="src/output.css">
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
                        <li>
                            <a href="#act1" class="act-link">Act 1</a>
                        </li>
                        <li>
                            <a href="#act2" class="act-link">Act 2</a>
                        </li>
                        <li>
                            <a href="#act3" class="act-link">Act 3</a>
                        </li>
                        <li>
                            <a href="#act4" class="act-link">Act 4</a>
                        </li>
                        <li>
                            <a href="/act5.php" class="act-link">Act 5</a>
                        </li>
                        <li>
                            <a href="/act6.php" class="act-link">Act 6</a>
                        </li>
                        <li>
                            <a href="/act7.php" class="act-link">Act 7</a>
                        </li>
                        <li>
                            <a href="#act8" class="act-link">Act 8</a>
                        </li>
                        <li>
                            <a href="#act9" class="act-link">Act 9</a>
                        </li>
                        <li>
                            <a href="#act10" class="act-link">Act 10</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

<style>
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
</header>


    <!-- Landing page -->

    <main class="max-w-7xl mx-auto px-10">
        <div class="mt-14">
            <h1 class="text-center text-4xl font-bold p-4">
                Embedded Systems
            </h1>
        </div>
    
        <div id="act1" class="mt-14 pt-16">

        <div>
            <h2 class="text-2xl py-2 font-[600]">Activity 1 - Temperature and Humidity</h2>
        </div>


<!-- Activity 1 -->
<div class="border border-gray-400 rounded-md p-4 shadow-lg bg-white">

    <div class="grid grid-cols-2 gap-4 h-[400px]">

        <!-- Temperature Card -->
        <div class="col-span-1 row-span-1 justify-center grid border-2 border-blue-500 bg-gradient-to-br from-blue-200 to-blue-300 rounded-md shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
            <div class="flex mx-auto items-center justify-center">
                <h2 class="font-[500] text-2xl text-blue-600">Temperature</h2>
            </div>
            <div>
                <img src="assets/image/temperature-icon.png" alt="temperature-icon" class="h-[200px] w-[180px] mx-auto">
            </div>
            <div class="flex mx-auto items-center justify-center gap-4">
                <!-- Dropdown menu -->
                <select id="unit-select" class="text-2xl p-2 border border-gray-300 rounded w-full">
                    <option value="celsius">Celsius</option>
                    <option value="fahrenheit">Fahrenheit</option>
                </select>

                <!-- Temperature display -->
                <h2 id="temperature" class="font-[500] text-2xl">Loading...</h2>
            </div>
            <div class="flex mx-auto items-center justify-center gap-4">
                <h2 id="temperature-fahrenheit" class="font-[500] text-2xl" style="display: none;">Loading...</h2>

                <span id="buzzer">
                    <svg fill="#f8e45c" height="40px" width="40px" version="1.1" id="Icons"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 32 32" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M26.8,25H5.2c-0.8,0-1.5-0.4-1.9-1.1c-0.4-0.7-0.3-1.5,0.1-2.2L4.5,20c1.8-2.7,2.7-5.8,2.7-9c0-3.7,2.4-7.1,5.9-8.3 C13.7,1.6,14.8,1,16,1s2.3,0.6,2.9,1.7c3.5,1.2,5.9,4.6,5.9,8.3c0,3.2,0.9,6.3,2.7,9l1.1,1.7c0.4,0.7,0.5,1.5,0.1,2.2 C28.4,24.6,27.6,25,26.8,25z">
                                </path>
                            </g>
                            <path d="M11.1,27c0.5,2.3,2.5,4,4.9,4s4.4-1.7,4.9-4H11.1z"></path>
                        </g>
                    </svg>
                </span>
            </div>
        </div>

        <!-- Humidity Card -->
        <div class="col-span-1 row-span-1 justify-center grid border-2 border-green-500 bg-gradient-to-br from-green-200 to-green-300 rounded-md shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
            <div class="flex mx-auto items-center justify-center">
                <h2 class="font-[500] text-2xl text-green-600">Humidity</h2>
            </div>
            <div>
                <img src="assets/image/humidity-icon.png" alt="humidity-icon" class="h-[200px] w-[190px] mx-auto">
            </div>
            <div class="flex mx-auto items-center justify-center">
                <h2 id="humidity" class="font-[500] text-2xl">Loading...</h2>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-5 grid-rows-5 gap-4 h-[400px] bg-white rounded-[8px] border border-gray-300 shadow-lg p-4 py-8 w-full mt-4 mx-auto">
    <canvas id="myChart" width="18000" height="5000" class="mx-auto flex items-center justify-center"></canvas>
</div>

<!-- end activity 1 -->



 <!-- ACT2 -->
<section id="act2">
    <h2 class="text-2xl py-2 font-[600]">Activity 2 - Distance Sensor</h2>

    <div class="grid grid-cols-2 gap-4 pb-10">
        <!-- Distance Sensor 1 -->
        <div class="bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 justify-center grid">
            <div class="flex mx-auto items-center justify-center">
                <h2 class="font-[500] text-2xl">Distance Sensor 1</h2>
            </div>

            <div class="justify-center my-4">
                <img src="assets/image/Distance-icon.png" alt="distance-icon" class="h-[300px] w-[300px]">
                <h2 id="distance" class="font-[500] text-2xl text-center p-4">Loading...</h2>
            </div>

            <!-- Dropdown Menu -->
            <div class="flex mx-auto items-center justify-center gap-4">
                <label for="distance-unit-select" class="font-medium">Select Unit:</label>
                <select id="distance-unit-select" class="p-2 border rounded-md">
                    <option value="cm">Centimeters (cm)</option>
                    <option value="mm">Millimeters (mm)</option>
                    <option value="m">Meters (m)</option>
                    <option value="km">Kilometers (km)</option>
                </select>

                <span id="distancebuzzer">
                    <svg fill="#f8e45c" height="40px" width="40px" version="1.1" id="Icons"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 32 32" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M26.8,25H5.2c-0.8,0-1.5-0.4-1.9-1.1c-0.4-0.7-0.3-1.5,0.1-2.2L4.5,20c1.8-2.7,2.7-5.8,2.7-9c0-3.7,2.4-7.1,5.9-8.3 C13.7,1.6,14.8,1,16,1s2.3,0.6,2.9,1.7c3.5,1.2,5.9,4.6,5.9,8.3c0,3.2,0.9,6.3,2.7,9l1.1,1.7c0.4,0.7,0.5,1.5,0.1,2.2 C28.4,24.6,27.6,25,26.8,25z">
                                </path>
                            </g>
                            <path d="M11.1,27c0.5,2.3,2.5,4,4.9,4s4.4-1.7,4.9-4H11.1z"></path>
                        </g>
                    </svg>
                </span>
            </div>
        </div>

        <!-- Distance Sensor 2 -->
        <div class="bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 justify-center grid">
            <div class="flex mx-auto items-center justify-center">
                <h2 class="font-[500] text-2xl">Distance Sensor 2</h2>
            </div>

            <div class="justify-center my-4">
                <img src="assets/image/Distance-icon.png" alt="distance-icon" class="h-[300px] w-[300px]">
                <h2 id="distance1" class="font-[500] text-2xl text-center p-4">Loading...</h2>
            </div>

            <!-- Dropdown Menu -->
            <div class="flex mx-auto items-center justify-center gap-4">
                <label for="distance-unit-select1" class="font-medium">Select Unit:</label>
                <select id="distance-unit-select1" class="p-2 border rounded-md">
                    <option value="cm">Centimeters (cm)</option>
                    <option value="mm">Millimeters (mm)</option>
                    <option value="m">Meters (m)</option>
                    <option value="km">Kilometers (km)</option>
                </select>

                <span id="distancebuzzer1">
                    <svg fill="#f8e45c" height="40px" width="40px" version="1.1" id="Icons"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 32 32" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M26.8,25H5.2c-0.8,0-1.5-0.4-1.9-1.1c-0.4-0.7-0.3-1.5,0.1-2.2L4.5,20c1.8-2.7,2.7-5.8,2.7-9c0-3.7,2.4-7.1,5.9-8.3 C13.7,1.6,14.8,1,16,1s2.3,0.6,2.9,1.7c3.5,1.2,5.9,4.6,5.9,8.3c0,3.2,0.9,6.3,2.7,9l1.1,1.7c0.4,0.7,0.5,1.5,0.1,2.2 C28.4,24.6,27.6,25,26.8,25z">
                                </path>
                            </g>
                            <path d="M11.1,27c0.5,2.3,2.5,4,4.9,4s4.4-1.7,4.9-4H11.1z"></path>
                        </g>
                    </svg>
                </span>
            </div>
        </div>
    </div>

    <!-- Place CARD for Chart here ... -->
    <div class="grid grid-cols-5 grid-rows-5 gap-4 h-[400px] bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 w-full mt-4 mx-auto">
        <canvas id="combinedChart" width="18000" height="5000" class="mx-auto flex items-center justify-center"></canvas>
    </div>
    <!-- end chart -->
</section>


       <!-- ACT3 -->
       <section id="act3">
    <h2 class="text-2xl py-2 font-[600]">Activity 3 - PIR MOTION SENSOR</h2>

    <div class="grid grid-cols-5 grid-rows-5 gap-4 h-[400px] bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 w-full mt-4 mx-auto">
        <canvas id="pirChart" width="18000" height="5000" class="mx-auto flex items-center justify-center"></canvas>
    </div>

    <div style="display: flex; flex-direction: column; align-items: center; padding-top: 20px;">
        <span id="pirbuzzer">
            <svg fill="#f8e45c" height="150px" width="150px" version="1.1" id="Icons"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 32 32" xml:space="preserve">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <path
                            d="M26.8,25H5.2c-0.8,0-1.5-0.4-1.9-1.1c-0.4-0.7-0.3-1.5,0.1-2.2L4.5,20c1.8-2.7,2.7-5.8,2.7-9c0-3.7,2.4-7.1,5.9-8.3C13.7,1.6,14.8,1,16,1s2.3,0.6,2.9,1.7c3.5,1.2,5.9,4.6,5.9,8.3c0,3.2,0.9,6.3,2.7,9l1.1,1.7c0.4,0.7,0.5,1.5,0.1,2.2C28.4,24.6,27.6,25,26.8,25z">
                        </path>
                    </g>
                    <path d="M11.1,27c0.5,2.3,2.5,4,4.9,4s4.4-1.7,4.9-4H11.1z"></path>
                </g>
            </svg>
        </span>

        <h3 style="margin-top: 20px; font-size: 1.5rem; font-weight: 600;">Capture Images</h3>

        <img src="/python/image/motion_capture.jpg" alt="Motion Capture" style="max-width: 100%; height: auto; margin-top: 10px; padding-bottom: 40px;" onerror="this.onerror=null; this.src='/path/to/default/image.jpg';">
        
        <!-- Live Stream Video Feed -->
        <h3 style="margin-top: 20px; font-size: 1.5rem; font-weight: 600;">Live Camera Feed</h3>
        <img src="http://192.168.0.105:8080/?action=stream" alt="Live Stream" style="max-width: 100%; height: auto; margin-top: 10px; padding-bottom: 40px;">

        <!-- Buttons for functionality -->
        <div style="margin-top: 20px;">
            <button id="togglePir" class="bg-blue-500 text-white px-4 py-2 rounded">Toggle On/Off</button>
            <button id="captureImage" class="bg-green-500 text-white px-4 py-2 rounded">Capture Picture</button>
            <button id="showImages" class="bg-purple-500 text-white px-4 py-2 rounded">Show All Images</button>
        </div>

        <!-- Section to show all captured images -->
        <div id="imageGallery" style="margin-top: 20px; display: none;">
            <h3 style="font-size: 1.5rem; font-weight: 600;">Captured Images</h3>
            <div id="imagesContainer" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>
        </div>
    </div>
</section>


<script>
    function refreshImage() {
        const img = document.querySelector('img[alt="Motion Capture"]');
        const timestamp = new Date().getTime();
        img.src = /python/image/motion_capture.jpg?random=${timestamp};
    }
    setInterval(refreshImage, 5000);
</script>


        <!-- end chart -->
         
         <!-- End ACT 3  -->
<!-- ACT4 -->
<section id="act4" class="pb-20">
    <h2 class="text-2xl py-2 font-[600]">Activity 4 - GAS and VIBRATION SENSOR</h2>

    <div class="grid grid-cols-5 grid-rows-5 gap-4 h-[400px] bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 w-full mt-4 mx-auto">
        <canvas id="act4Chart" width="18000" height="5000" class="mx-auto flex items-center justify-center"></canvas>
    </div>

    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 10vh;">
    <span id="act4buzzer" style="display: inline-block; text-align: center;">
        <svg fill="#f8e45c" height="40px" width="40px" version="1.1" id="Icons"
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 0 32 32" xml:space="preserve">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <g>
                    <path
                        d="M26.8,25H5.2c-0.8,0-1.5-0.4-1.9-1.1c-0.4-0.7-0.3-1.5,0.1-2.2L4.5,20c1.8-2.7,2.7-5.8,2.7-9c0-3.7,2.4-7.1,5.9-8.3C13.7,1.6,14.8,1,16,1s2.3,0.6,2.9,1.7c3.5,1.2,5.9,4.6,5.9,8.3c0,3.2,0.9,6.3,2.7,9l1.1,1.7c0.4,0.7,0.5,1.5,0.1,2.2C28.4,24.6,27.6,25,26.8,25z">
                    </path>
                </g>
                <path d="M11.1,27c0.5,2.3,2.5,4,4.9,4s4.4-1.7,4.9-4H11.1z"></path>
            </g>
        </svg>
    </span>
</div>

    <br>

    <br>

    <table class="mt-4 w-full border-collapse border border-gray-200">
        <h1 class="text-center">Historical Data</h1>
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">Entry</th>
                <th class="border border-gray-300 p-2">Gas (Detected = 1)</th>
                <th class="border border-gray-300 p-2">Vibration (Detected = 1)</th>
            </tr>
        </thead>
        <tbody id="sensorDataBody">
            <!-- Data rows will be populated here -->
        </tbody>
    </table>
</section>


    
   <!-- End ACT 4  -->
    </main>

    <!-- Scripts for JS -->
    <script src="script/gas_vib_table.js"></script>
    <script src="script/act4_chart.js"></script> 
    <script src="script/dht22_chart.js"></script>
    <script src="script/temperature.js"></script>
    <script src="script/distance1.js"></script> 
    <script src="script/distance_chart.js"></script> 
    <script src="script/pirmotion_chart.js"></script> 
    <script src="script/buzzerpir.js"></script>
    <script src="script/buzzeract4.js"></script>
   
</html>