// Fetch data from db
var query = window.location.href
var deviceId = query.split("/").at(-1);

fetch(`/devices/${deviceId}/source-data`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(sourceData => {
        // Source data received from the backend
        console.log(sourceData)
        const voltage = sourceData.map(data => data.voltage).slice(-5)
        const current = sourceData.map(data => data.current).slice(-5)
        const power = sourceData.map(data => data.power).slice(-5)
        const temperature = sourceData.map(data => data.temperature).slice(-5)
        // You can further process the source data here
        // Inisialisasi Line Chart untuk Power Meter
        var powerMeterChart = new Chart(document.getElementById('powerMeterChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'], // Contoh label untuk hari
                datasets: [{
                    label: 'Voltage',
                    data: voltage, // Contoh data untuk tegangan
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 2,
                    fill: false
                }, {
                    label: 'Current',
                    data: current, // Contoh data untuk arus
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 2,
                    fill: false
                }, {
                    label: 'Power',
                    data: power, // Contoh data untuk daya
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Inisialisasi Line Chart untuk Temperature
        var temperatureChart = new Chart(document.getElementById('temperatureChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'], // Contoh label untuk hari
                datasets: [{
                    label: 'Temperature',
                    data: temperature, // Contoh data untuk suhu
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });


