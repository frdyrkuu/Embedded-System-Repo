function updateWeatherIcon() {
    // Fetch data from your backend (via AJAX)
    fetch('/includes/get_weather_data.php')
        .then(response => response.json())
        .then(data => {
            const rain = parseFloat(data.rain);          // Convert rain to float
            const sound = parseFloat(data.sound) || 0;   // Convert sound to float and default to 0 if null
            const humidity = data.humidity;               // Humidity value
            const temperature = data.temperature;         // Temperature value
            
            // Assuming sound is already a percentage (0 to 100), don't multiply it by 100 again
            const soundPercentage = Math.round(sound); // Just round the sound value, no need for further multiplication
            
            // Debugging outputs for rain and sound values
            console.log("Rain (float):", rain);    
            console.log("Sound Percentage:", soundPercentage); // Log sound as percentage
            
            const iconElement = document.getElementById("icon");
            const weatherTextElement = document.getElementById("weather-text"); // Get the span element for weather condition text
            const temperatureElement = document.getElementById("temperature").querySelector('span'); // Get the span element for temperature
            const humidityElement = document.getElementById("humidity").querySelector('span'); // Get the span element for humidity

            // Update temperature and humidity displays
            temperatureElement.textContent = `Temperature: ${temperature} °C`;
            humidityElement.textContent = `Humidity: ${humidity}%`;

            // Threshold for considering rain and sound detected (adjust as needed)
            const threshold = 50; // Now in percentage

            // Determine weather condition based on rain and sound (as percentages)
            if (rain >= threshold / 100 && soundPercentage >= threshold) {
                console.log("Rainy condition triggered!");  // Log when rainy condition is triggered
                iconElement.src = "/assets/icons/rainy-svgrepo-com.svg";  // Rainy icon
                weatherTextElement.textContent = "Rainy";  // Update text to "Rainy"
            } else if (humidity > 70) {
                iconElement.src = "/assets/icons/sun-cloudy-svgrepo-com.svg";  // Cloudy icon
                weatherTextElement.textContent = "Cloudy";  // Update text to "Cloudy"
            } else {
                iconElement.src = "/assets/icons/sunny-svgrepo-com.svg";  // Sunny icon
                weatherTextElement.textContent = "Sunny";  // Update text to "Sunny"
            }
        })
        .catch(error => console.error('Error fetching weather data:', error));
}

// Call the function every 1 second to update the icon
setInterval(updateWeatherIcon, 1000);
