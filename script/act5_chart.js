const act5Labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']; // X-axis labels

// Get the canvas contexts for both charts
const soundCanvasElement = document.getElementById('soundChart');
const rainCanvasElement = document.getElementById('rainChart');

if (soundCanvasElement && rainCanvasElement) {
    const soundCtx = soundCanvasElement.getContext('2d');
    const rainCtx = rainCanvasElement.getContext('2d');

    // Sound Chart (Percentage)
    const soundChart = new Chart(soundCtx, {
        type: 'line',
        data: {
            labels: act5Labels,
            datasets: [
                {
                    label: 'Sound Detection (%)',
                    data: Array(10).fill(0), // Initialize with zeros for 10 points
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)', // Color for sound line
                    tension: 0.1 // Add slight curve to line for smoother visualization
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Data Points'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Sound Detection (%)'
                    },
                    min: 0,
                    max: 100, // Y-axis scale for percentage
                    ticks: {
                        stepSize: 20,
                        callback: function(value) {
                            return value + '%'; // Add '%' symbol to the y-axis labels
                        }
                    }
                }
            }
        }
    });

    // Rain Chart
    const rainChart = new Chart(rainCtx, {
        type: 'line',
        data: {
            labels: act5Labels,
            datasets: [
                {
                    label: 'Rain (1 = Detected, 0 = Not Detected)',
                    data: Array(10).fill(0), // Initialize with zeros for 10 points
                    fill: false,
                    borderColor: 'rgb(54, 162, 235)', // Color for rain line
                    tension: 0.1 // Add slight curve to line for smoother visualization
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Data Points'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Sensor Status'
                    },
                    min: 0,
                    max: 1,
                    ticks: {
                        stepSize: 0.2 // Set the step size for the y-axis
                    }
                }
            }
        }
    });

    // Function to fetch data from the server
    function fetchData() {
        fetch('/includes/act5_chart.php') // Update with your PHP script path for act5
            .then(response => response.json())
            .then(data => {
                // Log the received data for debugging
                console.log('Fetched Data:', data);
                
                // Check if data is valid before updating the chart
                if (data.sound.length === 10 && data.rain.length === 10) {
                    // Update the sound chart with percentage data
                    const soundPercentage = data.sound.map(value => (parseFloat(value) * 10).toFixed(2)); // Multiply by 10
                    
                    // Update the sound and rain charts with new data
                    soundChart.data.datasets[0].data = soundPercentage; // Sound data as percentage
                    rainChart.data.datasets[0].data = data.rain; // Rain data as is

                    // Re-render the charts
                    soundChart.update();
                    rainChart.update();

                    // Populate the table
                    const tbody = document.getElementById('sensorDataBody');
                    tbody.innerHTML = ''; // Clear existing rows
                    data.sound.forEach((soundValue, index) => {
                        const rainValue = data.rain[index];
                        const row = `<tr>
                                        <td class="border border-gray-300 p-2">${index + 1}</td>
                                        <td class="border border-gray-300 p-2">${(soundValue * 10).toFixed(2)}%</td> <!-- Display sound as percentage -->
                                        <td class="border border-gray-300 p-2">${rainValue}</td>
                                     </tr>`;
                        tbody.innerHTML += row;
                    });
                } else {
                    console.error("Invalid data length received from server");
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Fetch data every 5 seconds
    setInterval(fetchData, 5000);

    // Initial data fetch
    fetchData();
} else {
    console.error('Canvas elements not found');
}
