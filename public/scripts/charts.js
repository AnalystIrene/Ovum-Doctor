/**
 * Initializes the Chart.js line chart for vitals (Heart Rate & Weight).
 */
function initializeVitalsChart() {
    try {
        const ctx = document.getElementById('vitalsChart').getContext('2d');
        const vitalsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'], // Example static labels, can be dynamic
                datasets: [{
                    label: 'Heart Rate',
                    data: [72, 75, 70, 73, 72], // Example data, make it dynamic if needed
                    borderColor: '#0d6efd', // Blue color for heart rate
                    backgroundColor: 'rgba(13, 110, 253, 0.2)', // Light blue background
                    tension: 0.4 // Smooth curves
                }, {
                    label: 'Weight',
                    data: [70, 69.5, 69.8, 70.2, 70], // Example data, make it dynamic if needed
                    borderColor: '#198754', // Green color for weight
                    backgroundColor: 'rgba(25, 135, 84, 0.2)', // Light green background
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Allow the chart to resize
                plugins: {
                    legend: {
                        position: 'top', // Position of legend
                        labels: {
                            boxWidth: 12 // Smaller legend boxes
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true // Start the y-axis at 0
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error initializing vitals chart:', error);
    }
}

/**
 * Initializes the Highcharts line chart for cycle variations.
 */
function initializeCycleChart() {
    try {
        Highcharts.chart('chart-container', {
            title: {
                text: 'Change in Cycle Lengths'
            },
            xAxis: {
                categories: ['2024-01', '2024-02', '2024-03', '2024-04', '2024-05', '2024-06', '2024-07', '2024-08', '2024-09', '2024-10', '2024-11', '2024-12'], // Example static categories
                title: {
                    text: 'Month'
                }
            },
            yAxis: {
                title: {
                    text: 'Days'
                }
            },
            series: [{
                name: 'Cycle Length',
                data: [72, 75, 70, 73, 72, 71, 70, 72, 73, 74, 75, 76], // Example data, make it dynamic if needed
                color: '#007bff' // Blue color for cycle length
            }, {
                name: 'Period Length',
                data: [70, 69.5, 69.8, 70.2, 70, 69.5, 69.8, 70.2, 70, 69.5, 69.8, 70.2], // Example data, make it dynamic if needed
                color: '#28a745' // Green color for period length
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 600 // Adjust chart for smaller screens
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    } catch (error) {
        console.error('Error initializing cycle chart:', error);
    }
}

// Initialize charts and other interactive elements
document.addEventListener('DOMContentLoaded', function() {
    // Initialize both charts when the document is ready
    initializeVitalsChart();
    initializeCycleChart();
});
