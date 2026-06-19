<?php
// includes/gas-chart.php
// Gemaakt door: [NaamStudent4]
// Lijst B - Item 2: Gasverbruik via JSON
?>

<div class="dashboard-card card-chart">
    <div class="card-header">
        <span class="card-icon">🔥</span>
        <span class="card-label">Gasverbruik</span>
        <span class="card-unit" id="gas-total">-- m³</span>
    </div>
    <div class="card-body">
        <canvas id="gasChart" height="200"></canvas>
    </div>
    <div class="item-credit">gas-chart.php – gemaakt door Tyler</div>
</div>

<script>
fetch('data/gas.json')
    .then(r => r.json())
    .then(data => {
        const span = window.currentTimeSpan || 'week';
        const labels = data[span].labels;
        const values = data[span].values;

        const total = values.reduce((a,b)=>a+b,0).toFixed(2);
        document.getElementById('gas-total').textContent = total + ' m³';

        const ctx = document.getElementById('gasChart').getContext('2d');
        window.gasChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'm³',
                    data: values,
                    backgroundColor: 'rgba(239, 68, 68, 0.15)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(239, 68, 68, 1)',
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'm³' } }
                }
            }
        });

        document.addEventListener('timespanChanged', (e) => {
            const newSpan = e.detail.span;
            window.gasChart.data.labels = data[newSpan].labels;
            window.gasChart.data.datasets[0].data = data[newSpan].values;
            window.gasChart.update();
            const newTotal = data[newSpan].values.reduce((a,b)=>a+b,0).toFixed(2);
            document.getElementById('gas-total').textContent = newTotal + ' m³';
        });
    });
</script>
