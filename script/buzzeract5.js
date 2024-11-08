function updateBuzzerColor() {
    fetch('/includes/get_act5.php')
        .then(response => response.json())
        .then(data => {
            console.log("Sound Value:", data.sound);
            console.log("Rain Value:", data.rain);

            const rainValue = parseInt(data.rain || 0, 10);
            
            // Remove the extra multiplication by 100
            const soundValue = parseFloat(data.sound) || 0; 
            const soundPercentage = Math.round(soundValue); // Use the value as is
            
            const buzzerIcon = document.querySelector('#act5buzzer svg');

            if (rainValue === 1 && soundPercentage >= 50) {
                buzzerIcon.style.fill = 'red'; 
            } else {
                buzzerIcon.style.fill = 'green'; 
            }

            console.log(`Buzzer color updated. Sound Percentage: ${soundPercentage}%, Rain: ${rainValue}`);
        })
        .catch(error => console.error('Error fetching sound and rain values:', error));
}

updateBuzzerColor();
setInterval(updateBuzzerColor, 1000);
