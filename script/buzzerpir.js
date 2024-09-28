function updateBuzzerColor() {
    fetch('/includes/get_pir.php') // Replace with your actual endpoint
        .then(response => response.json())
        .then(data => {
            const pirValue = data.pir; // Assuming the response contains PIR value

            const buzzerIcon = document.querySelector('#pirbuzzer svg');

            // Change the buzzer icon color based on the PIR value
            if (pirValue > 0) {
                buzzerIcon.style.fill = 'red'; // Motion detected
            } else {
                buzzerIcon.style.fill = 'green'; // No motion
            }
        })
        .catch(error => console.error('Error fetching PIR value:', error));
}

// Call updateBuzzerColor function when needed
updateBuzzerColor();
setInterval(updateBuzzerColor, 10000); // Update every 10 seconds
