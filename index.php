
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embedded System - Activities</title>
    <link rel="stylesheet" href="src/output.css">
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                            <a href="#" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Company</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Marketplace</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white">Features</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Team</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Landing page -->

    <main class="max-w-7xl mx-auto px-10">
        <div class="mt-14">
            <h1 class="text-center text-4xl font-bold p-4">
                Embedded Systems
            </h1>
        </div>

        <!-- Activity 1 Temp and Humidity  -->
        <div>
            <h2 class="text-2xl py-2 font-[600]">Activity 1 - Temperature and Humidity</h2>
        </div>
        <div class="grid grid-cols-2 grid-rows-2 gap-4 h-[400px]">
            <div class="col-span-2 row-span-5 bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 justify-center grid">
                <!-- Card 1  -->
                <div class="flex mx-auto items-center justify-center">
                    <h2 class="font-[500] text-2xl">Temperature</h2>
                </div>
                <div>
                    <img src="assets/image/temperature-icon.png" alt="temperature-icon" class="h-[200px] w-[180px]">
                </div>
                <div class="flex mx-auto items-center justify-center gap-4">
                    <h2 id="temperature" class="font-[500] text-2xl">Loading...</h2>
                    <span id="buzzer"> 
                    <svg fill="#f8e45c" height="40px" width="40px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M26.8,25H5.2c-0.8,0-1.5-0.4-1.9-1.1c-0.4-0.7-0.3-1.5,0.1-2.2L4.5,20c1.8-2.7,2.7-5.8,2.7-9c0-3.7,2.4-7.1,5.9-8.3 C13.7,1.6,14.8,1,16,1s2.3,0.6,2.9,1.7c3.5,1.2,5.9,4.6,5.9,8.3c0,3.2,0.9,6.3,2.7,9l1.1,1.7c0.4,0.7,0.5,1.5,0.1,2.2 C28.4,24.6,27.6,25,26.8,25z"></path> </g> <path d="M11.1,27c0.5,2.3,2.5,4,4.9,4s4.4-1.7,4.9-4H11.1z"></path> </g></svg>
                    </span>
                    </div>
            </div>
            <div class="col-span-2 row-span-5 col-start-3 bg-white rounded-[8px] border-gray-200 shadow-sm p-8 justify-center grid">
                <!-- Card 2  -->
                <div class="flex mx-auto items-center justify-center">
                    <h2 class="font-[500] text-2xl">Humidity</h2>
                </div>
                <div>
                    <img src="assets/image/humidity-icon.png" alt="temperature-icon" class="h-[200px] w-[190px]">
                </div>
                <div class="flex mx-auto items-center justify-center">
                    <h2 id="humidity" class="font-[500] text-2xl">Loading...</h2>
                </div>
            </div>
        </div>
        
        
        <div class="grid grid-cols-5 grid-rows-5 gap-4 h-[400px] bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 w-full mt-4 mx-auto">
            
                  <canvas id="myChart" width="18000" height="5000" class="mx-auto flex items-center justify-center"></canvas>		
            </div>
            <br>
             <script>
        const labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']; // X-axis labels

        // Initial chart setup
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Temperature (°C)',
                        data: [], // Initial empty data
                        fill: false,
                        borderColor: 'rgb(255, 99, 132)', // Color for temperature line
                        tension: 0.1
                    },
                    {
                        label: 'Humidity (%)',
                        data: [], // Initial empty data
                        fill: false,
                        borderColor: 'rgb(54, 162, 235)', // Color for humidity line
                        tension: 0.1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Label (1-10)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Value'
                        }
                    }
                }
            }
        });

        // Function to fetch data from the server
        function fetchData() {
            fetch('includes/chartdata.php') // Update with your PHP script path
                .then(response => response.json())
                .then(data => {
                    // Update the chart with new data
                    myChart.data.datasets[0].data = data.temperature;
                    myChart.data.datasets[1].data = data.humidity;
                    myChart.update(); // Re-render the chart
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Fetch data every 10 seconds
        setInterval(fetchData, 1000); // 10000 milliseconds = 10 seconds

        // Initial data fetch
        fetchData();
    </script>
        </div>
            
        <!-- end activity 1 -->

    </main>

    <script>
function updateTemperature() {
    fetch('includes/get_temp.php')
        .then(response => response.json())
        .then(data => {
            // Update the temperature display
            document.getElementById('temperature').innerText = `${data.temperature} C`;

            // Get the buzzer icon element
            const buzzerIcon = document.getElementById('buzzer');
            
            // Check if the temperature is 38 or above
            if (data.temperature >= 38) {
                // Show the buzzer icon
                buzzerIcon.style.display = 'block';
            } else {
                // Hide the buzzer icon
                buzzerIcon.style.display = 'none';
            }
        })
        .catch(error => console.error('Error fetching temperature:', error));
}
         
        function updateHumidity() {
            fetch('includes/get_humidity.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('humidity').innerText = `${data.humidity} %`;
                })
                .catch(error => console.error('Error fetching temperature:', error));
        }
        // Initial update
        updateTemperature();
        updateHumidity();
        
        // Update every 5 seconds
        setInterval(updateTemperature, 1000);
        setInterval(updateHumidity, 1000);
    </script>

</body>

</html>
