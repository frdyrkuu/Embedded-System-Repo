document.addEventListener('DOMContentLoaded', () => {
    // Convert distance from cm to the selected unit
    function convertDistance(cm, unit) {
        // Ensure cm is a number
        const distanceCm = parseFloat(cm);
        if (isNaN(distanceCm)) {
            console.error('Invalid distance value:', cm);
            return NaN; // Return NaN if the input is not a number
        }

        switch (unit) {
            case 'mm':
                return distanceCm * 10; // Convert cm to mm
            case 'm':
                return distanceCm / 100; // Convert cm to meters
            case 'km':
                return distanceCm / 100000; // Convert cm to kilometers
            case 'cm':
            default:
                return distanceCm; // Default to cm
        }
    }

    // Update the distance displayed based on the selected unit
    function updateDistance() {
        fetch('/includes/get_distance.php')
            .then(response => response.json())
            .then(data => {
                const cm = data.distance; // Distance in centimeters
                console.log('Fetched distance in cm:', cm); // Debugging line

                // Get the selected unit from the dropdown
                const unitSelect = document.getElementById('distance-unit-select');
                if (!unitSelect) {
                    console.error('Distance unit select element not found');
                    return;
                }
                const selectedUnit = unitSelect.value;
                console.log('Selected unit:', selectedUnit); // Debugging line

                // Convert distance based on selected unit
                const convertedDistance = convertDistance(cm, selectedUnit);
                console.log('Converted distance:', convertedDistance); // Debugging line

                // Check if convertedDistance is a valid number before calling toFixed
                if (!isNaN(convertedDistance)) {
                    // Update the distance display
                    const distanceElement = document.getElementById('distance');
                    if (distanceElement) {
                        distanceElement.innerText = `${convertedDistance.toFixed(2)} ${selectedUnit}`;
                    } else {
                        console.error('Distance element not found');
                    }

                    // Get the SVG element for the buzzer
                    const buzzerIcon = document.querySelector('#distancebuzzer svg');

                    // Change the buzzer icon color based on the distance in cm
                    if (cm > 12) {
                        buzzerIcon.style.fill = 'red'; // Buzzer "on"
                    } else {
                        buzzerIcon.style.fill = 'green'; // Buzzer "off"
                    }
                } else {
                    console.error('Converted distance is not a valid number');
                }
            })
            .catch(error => console.error('Error fetching distance:', error));
    }

    // Handle changes in the distance unit dropdown
    function handleDistanceUnitChange() {
        updateDistance(); // Update distance when unit changes
    }

    // Initial update
    updateDistance();

    // Update every 10 seconds
    setInterval(updateDistance, 10000); // Adjust interval as needed

    // Add event listener for dropdown change
    const unitSelect = document.getElementById('distance-unit-select');
    if (unitSelect) {
        unitSelect.addEventListener('change', handleDistanceUnitChange);
    } else {
        console.error('Distance unit select element not found');
    }
});
