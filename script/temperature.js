function updateTemperature() {
    fetch('/includes/get_temp.php')
        .then(response => response.json())
        .then(data => {
            const celsius = data.temperature;
            const fahrenheit = (celsius * 9 / 5) + 32; // Convert Celsius to Fahrenheit

            // Get the selected unit from the dropdown
            const unitSelect = document.getElementById('unit-select');
            const selectedUnit = unitSelect.value;

            // Get the temperature display elements
            const tempCelsiusElement = document.getElementById('temperature');
            const tempFahrenheitElement = document.getElementById('temperature-fahrenheit');

            if (selectedUnit === 'celsius') {
                tempCelsiusElement.innerText = `${celsius} °C`;
                tempCelsiusElement.style.display = 'block';
                tempFahrenheitElement.style.display = 'none';
            } else {
                tempFahrenheitElement.innerText = `${fahrenheit.toFixed(1)} °F`;
                tempFahrenheitElement.style.display = 'block';
                tempCelsiusElement.style.display = 'none';
            }

            // Get the SVG element
            const buzzerIcon = document.querySelector('#buzzer svg');

            // Check if the temperature is 38 or above
            if (celsius >= 38) {
                // Set the buzzer icon color to red (on)
                buzzerIcon.style.fill = 'red'; // Buzzer "on"
            } else {
                // Set the buzzer icon color to green (off)
                buzzerIcon.style.fill = 'green'; // Buzzer "off"
            }
        })
        .catch(error => console.error('Error fetching temperature:', error));
}

function updateHumidity() {
    fetch('/includes/get_humidity.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('humidity').innerText = `${data.humidity} %`;
        })
        .catch(error => console.error('Error fetching humidity:', error));
}

function handleUnitChange() {
    // Update temperature when unit changes
    updateTemperature();
}

// Initial update
updateTemperature();
updateHumidity();

// Update every 10 seconds
setInterval(updateTemperature, 10000); // Adjust interval as needed
setInterval(updateHumidity, 10000); // Adjust interval as needed

// Add event listener for dropdown change
document.getElementById('unit-select').addEventListener('change', handleUnitChange);
