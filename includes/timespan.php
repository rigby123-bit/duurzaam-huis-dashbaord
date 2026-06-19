<?php
// includes/timespan.php
// Gemaakt door: [NaamStudent4]
// Lijst C - Item 2: Tijdspanne selectie (dag / week / maand)
?>

<div class="dashboard-card card-control">
    <div class="card-header">
        <span class="card-icon">📆</span>
        <span class="card-label">Tijdspanne grafieken</span>
    </div>
    <div class="card-body">
        <div class="timespan-group">
            <button class="timespan-btn" data-span="dag">Dag</button>
            <button class="timespan-btn active" data-span="week">Week</button>
            <button class="timespan-btn" data-span="maand">Maand</button>
        </div>
        <p class="timespan-info" id="timespan-info">Grafiek toont data per week</p>
    </div>
    <div class="item-credit">timespan.php – gemaakt door Tyler</div>
</div>

<script>
// Sla globale tijdspanne op zodat grafieken kunnen luisteren
window.currentTimeSpan = 'week';

const labels = { dag: 'dag', week: 'week', maand: 'maand' };

document.querySelectorAll('.timespan-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.timespan-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const span = btn.dataset.span;
        window.currentTimeSpan = span;
        document.getElementById('timespan-info').textContent = `Grafiek toont data per ${labels[span]}`;

        // Stuur event naar alle grafieken
        document.dispatchEvent(new CustomEvent('timespanChanged', { detail: { span } }));
    });
});
</script>
