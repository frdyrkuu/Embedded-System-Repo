const act4Labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']; // X-axis labels

// Get the canvas context only once
const canvasElement = document.getElementById('act4Chart'); // Renamed to avoid redeclaration
if (canvasElement) {
    const ctx = canvasElement.getContext('2d');

    const act4Chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: act4Labels,
            datasets: [
                {
                    label: 'Gas (1 = Detected, 0 = Not Detected)',
                    data: Array(10).fill(null), // Initialize with null for 10 points
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)', // Color for gas line
                },
                {
                    label: 'Vibration (1 = Detected, 0 = Not Detected)',
                    data: Array(10).fill(null), // Initialize with null for 10 points
                    fill: false,
                    borderColor: 'rgb(54, 162, 235)', // Color for vibration line
                }
            ]
        },
        options: {
            responsive: true,
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
                        text: 'Sensor Status'
                    },
                    min: 0,
                    max: 1 // Assuming values are either 0 or 1
                }
            }
        }
    });

    // Function to fetch data from the server
    function fetchData() {
        fetch('/includes/act4_chart.php') // Update with your PHP script path
            .then(response => response.json())
            .then(data => {
                // Update the chart with new gas and vibration data
                act4Chart.data.datasets[0].data = data.gas; // Gas data
                act4Chart.data.datasets[1].data = data.vibration; // Vibration data
                act4Chart.update(); // Re-render the chart
                
                // Populate the table
                const tbody = document.getElementById('sensorDataBody');
                tbody.innerHTML = ''; // Clear existing rows
                data.gas.forEach((gasValue, index) => {
                    const vibrationValue = data.vibration[index];
                    const row = `<tr>
                                    <td class="border border-gray-300 p-2">${index + 1}</td>
                                    <td class="border border-gray-300 p-2">${gasValue}</td>
                                    <td class="border border-gray-300 p-2">${vibrationValue}</td>
                                 </tr>`;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }
    

    // Fetch data every 10 seconds
    setInterval(fetchData, 1000); // 10000 milliseconds = 10 seconds

    // Initial data fetch
    fetchData();
} else {
    console.error('Canvas element not found');
}


