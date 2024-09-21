document.addEventListener('DOMContentLoaded', () => {
    // Convert distance from cm to the selected unit
    function convertDistance(cm, unit) {
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
                const cm = data.distance; // Distance from first sensor in centimeters
                const cm1 = data.distance1; // Distance from second sensor in centimeters
                console.log('Fetched distance in cm:', cm); // Debugging line
                console.log('Fetched second distance in cm:', cm1); // Debugging line

                // Get the selected unit from the dropdowns
                const unitSelect = document.getElementById('distance-unit-select');
                const unitSelect1 = document.getElementById('distance-unit-select1');
                
                if (!unitSelect || !unitSelect1) {
                    console.error('Distance unit select element(s) not found');
                    return;
                }
                const selectedUnit = unitSelect.value;
                const selectedUnit1 = unitSelect1.value;
                console.log('Selected unit for Distance:', selectedUnit); // Debugging line
                console.log('Selected unit for Distance 1:', selectedUnit1); // Debugging line

                // Convert distances based on selected unit
                const convertedDistance = convertDistance(cm, selectedUnit);
                const convertedDistance1 = convertDistance(cm1, selectedUnit1);
                console.log('Converted distance:', convertedDistance); // Debugging line
                console.log('Converted second distance:', convertedDistance1); // Debugging line

                // Check if convertedDistance is a valid number before calling toFixed
                if (!isNaN(convertedDistance) && !isNaN(convertedDistance1)) {
                    // Update the distance display
                    const distanceElement = document.getElementById('distance');
                    const distance1Element = document.getElementById('distance1');
                    
                    if (distanceElement) {
                        distanceElement.innerText = `${convertedDistance.toFixed(2)} ${selectedUnit}`;
                    } else {
                        console.error('Distance element not found');
                    }

                    if (distance1Element) {
                        distance1Element.innerText = `${convertedDistance1.toFixed(2)} ${selectedUnit1}`;
                    } else {
                        console.error('Distance1 element not found');
                    }

                    // Get the SVG elements for the buzzers
                    const buzzerIcon = document.querySelector('#distancebuzzer svg');
                    const buzzerIcon1 = document.querySelector('#distancebuzzer1 svg');
                    
                    if (buzzerIcon) {
                        // Change the buzzer icon color based on the distance in cm
                        if (cm > 12) {
                            buzzerIcon.style.fill = 'red'; // Buzzer "on"
                        } else {
                            buzzerIcon.style.fill = 'green'; // Buzzer "off"
                        }
                    } else {
                        console.error('Buzzer SVG element for Distance not found');
                    }

                    if (buzzerIcon1) {
                        // Change the buzzer icon color based on the second distance in cm
                        if (cm1 > 12) {
                            buzzerIcon1.style.fill = 'red'; // Buzzer "on"
                        } else {
                            buzzerIcon1.style.fill = 'green'; // Buzzer "off"
                        }
                    } else {
                        console.error('Buzzer SVG element for Distance1 not found');
                    }
                } else {
                    console.error('Converted distance(s) is not a valid number');
                }
            })
            .catch(error => console.error('Error fetching distance:', error));
    }

    // Handle changes in the distance unit dropdowns
    function handleDistanceUnitChange() {
        updateDistance(); // Update distances when unit changes
    }

    // Initial update
    updateDistance();

    // Update every 10 seconds
    setInterval(updateDistance, 10000); // Adjust interval as needed

    // Add event listener for dropdown changes
    const unitSelect = document.getElementById('distance-unit-select');
    const unitSelect1 = document.getElementById('distance-unit-select1');
    
    if (unitSelect) {
        unitSelect.addEventListener('change', handleDistanceUnitChange);
    } else {
        console.error('Distance unit select element for Distance not found');
    }
    
    if (unitSelect1) {
        unitSelect1.addEventListener('change', handleDistanceUnitChange);
    } else {
        console.error('Distance unit select element for Distance1 not found');
    }
});
