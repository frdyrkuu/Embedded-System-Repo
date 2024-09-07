const labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']; // X-axis labels

// Initial chart setup
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Temperature (°C)',
                data: [], // Initial empty data
                fill: false,
                borderColor: 'rgb(255, 99, 132)', // Color for temperature line
                tension: 0.1
            },
            {
                label: 'Humidity (%)',
                data: [], // Initial empty data
                fill: false,
                borderColor: 'rgb(54, 162, 235)', // Color for humidity line
                tension: 0.1
            },
            {
                label: 'Highest Temperature (Last 5 min)',
                data: [], // Empty data initially
                fill: false,
                borderColor: 'rgb(0, 255, 0)', // Green for highest temperature
                borderDash: [10, 5], // Dotted line style
                tension: 0.1
            },
            {
                label: 'Lowest Temperature (Last 5 min)',
                data: [], // Empty data initially
                fill: false,
                borderColor: 'rgb(255, 255, 0)', // Yellow for lowest temperature
                borderDash: [10, 5], // Dotted line style
                tension: 0.1
            }
        ]
    },
    options: {
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
                    text: 'Value'
                }
            }
        }
    }
});

// Function to fetch data from the server
function fetchData() {
    fetch('includes/chartdata.php') // Update with your PHP script path
        .then(response => response.json())
        .then(data => {
            // Update the chart with new data
            myChart.data.datasets[0].data = data.temperature;
            myChart.data.datasets[1].data = data.humidity;

            // Determine highest temperature and lowest temperature over the last 5 minutes
            const tempMax = Math.max(...data.temperature);
            const tempMin = Math.min(...data.temperature); // Updated to find the lowest temperature

            // Assuming data is evenly spaced, calculate the range for the last 5 minutes
            const interval = Math.floor(data.temperature.length / 5); // Divide by 5 to get a 5-minute range

            const highestTempLine = Array(data.temperature.length).fill(tempMax);
            const lowestTempLine = Array(data.temperature.length).fill(tempMin);

            // Update highlight lines
            myChart.data.datasets[2].data = highestTempLine;
            myChart.data.datasets[3].data = lowestTempLine;

            myChart.update(); // Re-render the chart
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data every 10 seconds
setInterval(fetchData, 10000); // 10000 milliseconds = 10 seconds

// Initial data fetch
fetchData();