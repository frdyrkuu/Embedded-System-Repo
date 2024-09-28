const pirLabels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']; // X-axis labels

// Get the canvas context only once
const canvas = document.getElementById('pirChart');
if (canvas) {
    const ctx = canvas.getContext('2d');

    const pirChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: pirLabels,
            datasets: [{
                label: 'Movement (1 = Detected, 0 = Not Detected)',
                data: [], // Initial empty data
                fill: false,
                borderColor: 'rgb(255, 99, 132)', // Color for movement line
                tension: 0.1
            }]
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
                        text: 'Movement'
                    },
                    min: 0,
                    max: 1 // Assuming movement values are either 0 or 1
                }
            }
        }
    });

    // Function to fetch data from the server
    function fetchData() {
        fetch('/includes/pir_chart.php') // Update with your PHP script path
            .then(response => response.json())
            .then(data => {
                // Update the chart with new movement data
                pirChart.data.datasets[0].data = data.movement;
                pirChart.update(); // Re-render the chart
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
