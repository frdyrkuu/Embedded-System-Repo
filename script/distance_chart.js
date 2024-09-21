document.addEventListener('DOMContentLoaded', (event) => {
    // Define labels for the chart
    const distanceLabels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];

    // Setup the chart for both distance sensors
    const combinedCtx = document.getElementById('combinedChart').getContext('2d');
    const combinedChart = new Chart(combinedCtx, {
        type: 'line',
        data: {
            labels: distanceLabels, // X-axis labels
            datasets: [
                {
                    label: 'Distance Sensor 1 (cm)',
                    data: [], // Initial empty data
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)', // Color for distance sensor 1 line
                    tension: 0.1
                },
                {
                    label: 'Highest Distance Sensor 1 (cm)',
                    data: [], // Empty data initially
                    fill: false,
                    borderColor: 'rgb(0, 255, 0)', // Green for highest distance sensor 1 line
                    borderWidth: 0, // No line
                    pointRadius: 5, // Size of the dots
                    pointBackgroundColor: 'rgb(0, 255, 0)' // Green for dots
                },
                {
                    label: 'Lowest Distance Sensor 1 (cm)',
                    data: [], // Empty data initially
                    fill: false,
                    borderColor: 'rgb(255, 255, 0)', // Yellow for lowest distance sensor 1
                    borderWidth: 0, // No line
                    pointRadius: 5, // Size of the dots
                    pointBackgroundColor: 'rgb(255, 255, 0)' // Dot color
                },
                {
                    label: 'Distance Sensor 2 (cm)',
                    data: [], // Initial empty data
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)', // Color for distance sensor 2 line
                    tension: 0.1
                },
                {
                    label: 'Highest Distance Sensor 2 (cm)',
                    data: [], // Empty data initially
                    fill: false,
                    borderColor: 'rgb(0, 255, 0)', // Green for highest distance sensor 2
                    borderWidth: 0, // No line
                    pointRadius: 5, // Size of the dots
                    pointBackgroundColor: 'rgb(0, 255, 255)' // Green for dots
                },
                {
                    label: 'Lowest Distance Sensor 2 (cm)',
                    data: [], // Empty data initially
                    fill: false,
                    borderColor: 'rgb(255, 165, 0)', // Orange for lowest distance sensor 2
                    borderWidth: 0, // No line
                    pointRadius: 5, // Size of the dots
                    pointBackgroundColor: 'rgb(255, 165, 0)' // Dot color
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
                        text: 'Distance'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        generateLabels: function(chart) {
                            const original = Chart.defaults.plugins.legend.labels.generateLabels(chart);
                            return original.map(label => {
                                const dataset = chart.data.datasets[label.datasetIndex];
                                switch (dataset.label) {
                                    case 'Highest Distance Sensor 1 (cm)':
                                        label.textColor = 'rgb(0, 255, 0)'; // Green
                                        break;
                                    case 'Lowest Distance Sensor 1 (cm)':
                                        label.textColor = 'rgb(255, 255, 0)'; // Yellow
                                        break;
                                    case 'Highest Distance Sensor 2 (cm)':
                                        label.textColor = 'rgb(0, 255, 255)'; // Green
                                        break;
                                    case 'Lowest Distance Sensor 2 (cm)':
                                        label.textColor = 'rgb(255, 165, 0)'; // Orange
                                        break;
                                    default:
                                        label.textColor = dataset.borderColor; // Default to borderColor
                                }
                                return label;
                            });
                        }
                    }
                }
            }
        }
    });

    // Function to fetch data for both sensors
    function fetchCombinedData() {
        // Fetch data for distance sensor 1
        fetch('/includes/ultra_chart.php')
            .then(response => response.json())
            .then(data1 => {
                if (data1.distance && Array.isArray(data1.distance)) {
                    const distance1 = data1.distance;
                    const distMax1 = Math.max(...distance1);
                    const distMin1 = Math.min(...distance1);

                    // Prepare data for sensor 1
                    combinedChart.data.datasets[0].data = distance1;
                    combinedChart.data.datasets[1].data = distance1.map(() => distMax1);
                    combinedChart.data.datasets[2].data = distance1.map(() => distMin1);
                }
            })
            .catch(error => console.error('Error fetching distance data 1:', error));

        // Fetch data for distance sensor 2
        fetch('/includes/ultra_chart1.php')
            .then(response => response.json())
            .then(data2 => {
                if (data2.distance1 && Array.isArray(data2.distance1)) {
                    const distance2 = data2.distance1;
                    const distMax2 = Math.max(...distance2);
                    const distMin2 = Math.min(...distance2);

                    // Prepare data for sensor 2
                    combinedChart.data.datasets[3].data = distance2;
                    combinedChart.data.datasets[4].data = distance2.map(() => distMax2);
                    combinedChart.data.datasets[5].data = distance2.map(() => distMin2);
                }
            })
            .catch(error => console.error('Error fetching distance data 2:', error));

        // Update the chart
        combinedChart.update();
    }

    // Fetch data for both sensors every 10 seconds
    setInterval(fetchCombinedData, 10000);

    // Initial data fetch
    fetchCombinedData();
});
