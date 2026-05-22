<?php
// includes/water-chart.php
// Gemaakt door: [NaamStudent1]
// Lijst B - Item 3: Waterverbruik via JSON
?>

<div class="dashboard-card card-chart">
    <div class="card-header">
        <span class="card-icon">💧</span>
        <span class="card-label">Waterverbruik</span>
        <span class="card-unit" id="water-total">-- L</span>
    </div>
    <div class="card-body">
        <canvas id="waterChart" height="200"></canvas>
    </div>
    <div class="item-credit">water-chart.php – gemaakt door [NaamStudent1]</div>
</div>

<script>
fetch('data/water.json')
    .then(r => r.json())
    .then(data => {
        const span = window.currentTimeSpan || 'week';
        const labels = data[span].labels;
        const values = data[span].values;

        const total = values.reduce((a,b)=>a+b,0).toFixed(0);
        document.getElementById('water-total').textContent = total + ' L';

        const ctx = document.getElementById('waterChart').getContext('2d');
        window.waterChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Liter',
                    data: values,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Liter' } }
                }
            }
        });

        document.addEventListener('timespanChanged', (e) => {
            const newSpan = e.detail.span;
            window.waterChart.data.labels = data[newSpan].labels;
            window.waterChart.data.datasets[0].data = data[newSpan].values;
            window.waterChart.update();
            const newTotal = data[newSpan].values.reduce((a,b)=>a+b,0).toFixed(0);
            document.getElementById('water-total').textContent = newTotal + ' L';
        });
    });
</script>
