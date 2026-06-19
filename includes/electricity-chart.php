<?php
// includes/electricity-chart.php
// Gemaakt door: Ilham Abahoua
// Lijst B - Item 1: Electriciteitsverbruik via JSON
?>
<link rel="stylesheet" href="css/charts.css">

<div class="dashboard-card card-chart">
    <div class="card-header">
        <span class="card-icon">⚡</span>
        <span class="card-label">Electriciteitsverbruik</span>
        <span class="card-unit" id="electricity-total">-- kWh</span>
    </div>
    <div class="card-body">
        <canvas id="electricityChart" height="200"></canvas>
    </div>
    <div class="item-credit">electricity-chart.php – gemaakt door Ilham Abahoua</div>
</div>

<script>
// Laad JSON en bouw grafiek
fetch('data/electricity.json')
    .then(r => r.json())
    .then(data => {
        const span = window.currentTimeSpan || 'week';
        const labels = data[span].labels;
        const values = data[span].values;

        const total = values.reduce((a,b)=>a+b,0).toFixed(1);
        document.getElementById('electricity-total').textContent = total + ' kWh';

        const ctx = document.getElementById('electricityChart').getContext('2d');
        window.electricityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'kWh',
                    data: values,
                    backgroundColor: 'rgba(234, 179, 8, 0.7)',
                    borderColor: 'rgba(234, 179, 8, 1)',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'kWh' } }
                }
            }
        });

        // Luister naar tijdspanne-wijziging
        document.addEventListener('timespanChanged', (e) => {
            const newSpan = e.detail.span;
            window.electricityChart.data.labels = data[newSpan].labels;
            window.electricityChart.data.datasets[0].data = data[newSpan].values;
            window.electricityChart.update();
            const newTotal = data[newSpan].values.reduce((a,b)=>a+b,0).toFixed(1);
            document.getElementById('electricity-total').textContent = newTotal + ' kWh';
        });
    })
    .catch(() => {
        document.getElementById('electricityChart').parentElement.innerHTML += '<p class="error-msg">⚠️ Data niet geladen</p>';
    });
</script>
