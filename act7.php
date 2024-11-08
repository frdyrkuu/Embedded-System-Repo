<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embedded System - Act 7</title>
    <link rel="stylesheet" href="src/output.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                        <li><a href="/#act1" class="act-link">Act 1</a></li>
                        <li><a href="/#act2" class="act-link">Act 2</a></li>
                        <li><a href="/#act3" class="act-link">Act 3</a></li>
                        <li><a href="/#act4" class="act-link">Act 4</a></li>
                        <li><a href="/act5.php" class="act-link">Act 5</a></li>
                        <li><a href="/act6.php" class="act-link">Act 6</a></li>
                        <li><a href="/act7.php" class="act-link">Act 7</a></li>
                        <li><a href="/act8.php" class="act-link">Act 8</a></li>
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
                Embedded Systems - Act 7
            </h1>
        </div>

        <!-- LED Status Section -->
        <div class="flex justify-center space-x-10 mt-10">
            <div class="text-center">
                <i id="redBulb" class="fas fa-lightbulb" style="font-size: 50px; color: gray;" data-original-color="red"></i>
                <p id="redStatus">OFF</p>
            </div>
            <div class="text-center">
                <i id="blueBulb" class="fas fa-lightbulb" style="font-size: 50px; color: gray;" data-original-color="blue"></i>
                <p id="blueStatus">OFF</p>
            </div>
            <div class="text-center">
                <i id="greenBulb" class="fas fa-lightbulb" style="font-size: 50px; color: gray;" data-original-color="green"></i>
                <p id="greenStatus">OFF</p>
            </div>
        </div>

        <div class="text-center mt-5">
            <p id="commandStatus">Command Status: N/A</p>
        </div>
    </main>

    <script>
    function updateBulbStatus(commandStatus) {
        const redBulb = document.getElementById('redBulb');
        const blueBulb = document.getElementById('blueBulb');
        const greenBulb = document.getElementById('greenBulb');

        // Reset bulb colors and statuses
        redBulb.style.color = 'gray';
        blueBulb.style.color = 'gray';
        greenBulb.style.color = 'gray';
        document.getElementById('redStatus').innerText = 'OFF';
        document.getElementById('blueStatus').innerText = 'OFF';
        document.getElementById('greenStatus').innerText = 'OFF';

        // Flag to check if the command is valid
        let validCommand = true;

        // Trim and lowercase command status
        const trimmedCommand = commandStatus.toLowerCase().trim();

        // Handle command statuses
        switch (trimmedCommand) {
            case 'red led on':
                redBulb.style.color = 'red';
                document.getElementById('redStatus').innerText = 'ON';
                break;
            case 'red off':
                redBulb.style.color = 'gray';
                document.getElementById('redStatus').innerText = 'OFF';
                break;
            case 'blue led on':
                blueBulb.style.color = 'blue';
                document.getElementById('blueStatus').innerText = 'ON';
                break;
            case 'blue off':
                blueBulb.style.color = 'gray';
                document.getElementById('blueStatus').innerText = 'OFF';
                break;
            case 'green led on':
                greenBulb.style.color = 'green';
                document.getElementById('greenStatus').innerText = 'ON';
                break;
            case 'green off':
                greenBulb.style.color = 'gray';
                document.getElementById('greenStatus').innerText = 'OFF';
                break;
            case 'all on':
                redBulb.style.color = 'red';
                blueBulb.style.color = 'blue';
                greenBulb.style.color = 'green';
                document.getElementById('redStatus').innerText = 'ON';
                document.getElementById('blueStatus').innerText = 'ON';
                document.getElementById('greenStatus').innerText = 'ON';
                break;
            case 'all off':
                redBulb.style.color = 'gray';
                blueBulb.style.color = 'gray';
                greenBulb.style.color = 'gray';
                document.getElementById('redStatus').innerText = 'OFF';
                document.getElementById('blueStatus').innerText = 'OFF';
                document.getElementById('greenStatus').innerText = 'OFF';
                break;
                stopBlinking(redBulb);
                stopBlinking(blueBulb);
                stopBlinking(greenBulb);
                break;
            case 'red blink on':
                redBulb.style.color = 'red';
                document.getElementById('redStatus').innerText = 'BLINKING';
                startBlinking(redBulb);
                break;
            case 'red blink off':
                stopBlinking(redBulb);
                break;
            case 'blue blink on':
                blueBulb.style.color = 'blue';
                document.getElementById('blueStatus').innerText = 'BLINKING';
                startBlinking(blueBulb);
                break;
            case 'blue blink off':
                stopBlinking(blueBulb);
                break;
            case 'green blink on':
                greenBulb.style.color = 'green';
                document.getElementById('greenStatus').innerText = 'BLINKING';
                startBlinking(greenBulb);
                break;
            case 'green blink off':
                stopBlinking(greenBulb);
                break;
            case 'all blink on':
                startBlinking(redBulb);
                startBlinking(blueBulb);
                startBlinking(greenBulb);
                break;
            case 'all blink off':
                stopBlinking(redBulb);
                stopBlinking(blueBulb);
                stopBlinking(greenBulb);
                break;
            default:
                validCommand = false; // Mark command as invalid
                console.error('Invalid command received:', commandStatus); // Log invalid command
                break;
        }

        // Show alert if the command is invalid
        if (!validCommand) {
            alert("This is not a right command");
        }
    }

    let blinkInterval;

    function startBlinking(bulb) {
        bulb.blinking = true; // Flag to indicate that the bulb is blinking
        bulb.dataset.originalColor = bulb.style.color; // Store the original color
        blinkInterval = setInterval(() => {
            bulb.style.color = bulb.style.color === 'gray' ? bulb.dataset.originalColor : 'gray'; // Toggle color
        }, 500);
    }

    function stopBlinking(bulb) {
        bulb.blinking = false; // Clear the blinking flag
        clearInterval(blinkInterval); // Stop blinking
        bulb.style.color = bulb.dataset.originalColor; // Reset to original color
    }

    function fetchCommandStatus() {
        fetch('/includes/get_act7.php')
            .then(response => response.json())
            .then(data => {
                const commandStatus = data.command_status;
                document.getElementById('commandStatus').innerText = commandStatus;
                updateBulbStatus(commandStatus); // Update bulb statuses based on command
            })
            .catch(error => console.error('Error fetching command status:', error));
    }

    // Fetch command status every 5 seconds
    setInterval(fetchCommandStatus, 5000);

    // Initial command status fetch
    fetchCommandStatus();
</script>


</body>

</html>
