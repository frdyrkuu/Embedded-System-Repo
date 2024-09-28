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
                // Assuming data.gas and data.vibration are arrays of the last 10 records
                act4Chart.data.datasets[0].data = data.gas; // Gas data
                act4Chart.data.datasets[1].data = data.vibration; // Vibration data
                act4Chart.update(); // Re-render the chart
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Fetch data every 10 seconds
    setInterval(fetchData, 10000); // 10000 milliseconds = 10 seconds

    // Initial data fetch
    fetchData();
} else {
    console.error('Canvas element not found');
}
