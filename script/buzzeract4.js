function updateBuzzerColor() {
    fetch('/includes/get_act4.php') // Replace with your actual endpoint for gas and vibration data
        .then(response => response.json())
        .then(data => {
            const gasValue = data.gas; // Assuming the response contains gas value
            const vibrationValue = data.vibration; // Assuming the response contains vibration value

            const buzzerIcon = document.querySelector('#act4buzzer svg');

            // Check if either gas or vibration sensor detects an alert (value > 0)
            if (gasValue > 0 || vibrationValue > 0) {
                buzzerIcon.style.fill = 'red'; // Alert detected: buzzer turns red
            } else {
                buzzerIcon.style.fill = 'green'; // No alert: buzzer stays green
            }
        })
        .catch(error => console.error('Error fetching gas and vibration values:', error));
}

// Call updateBuzzerColor function when needed
updateBuzzerColor();
setInterval(updateBuzzerColor, 1000); // Update every 1 second
