<?php
// includes/solar-chart.php
// Gemaakt door: [NaamStudent2]
// Lijst B - Item 5: Opbrengst zonnepanelen via JSON
?>

<div class="dashboard-card card-chart">
    <div class="card-header">
        <span class="card-icon">☀️</span>
        <span class="card-label">Zonnepanelen opbrengst</span>
        <span class="card-unit" id="solar-total">-- kWh</span>
    </div>
    <div class="card-body">
        <canvas id="solarChart" height="200"></canvas>
    </div>
    <div class="item-credit">solar-chart.php – gemaakt door [NaamStudent2]</div>
</div>

<script>
fetch('data/solar.json')
    .then(r => r.json())
    .then(data => {
        const span = window.currentTimeSpan || 'week';
        const labels = data[span].labels;
        const values = data[span].values;

        const total = values.reduce((a,b)=>a+b,0).toFixed(1);
        document.getElementById('solar-total').textContent = total + ' kWh';

        const ctx = document.getElementById('solarChart').getContext('2d');
        window.solarChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'kWh opgewekt',
                    data: values,
                    backgroundColor: 'rgba(251, 191, 36, 0.2)',
                    borderColor: 'rgba(251, 191, 36, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(251, 191, 36, 1)',
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

        document.addEventListener('timespanChanged', (e) => {
            const newSpan = e.detail.span;
            window.solarChart.data.labels = data[newSpan].labels;
            window.solarChart.data.datasets[0].data = data[newSpan].values;
            window.solarChart.update();
            const newTotal = data[newSpan].values.reduce((a,b)=>a+b,0).toFixed(1);
            document.getElementById('solar-total').textContent = newTotal + ' kWh';
        });
    });
</script>
