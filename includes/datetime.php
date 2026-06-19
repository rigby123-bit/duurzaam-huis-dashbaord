<?php
// includes/datetime.php
// Gemaakt door: [NaamStudent1]
// Lijst A - Item 4: Huidige datum en tijd (met JS)
?>
<link rel="stylesheet" href="css/datetime.css">

<div class="dashboard-card card-datetime">
    <div class="card-header">
        <span class="card-icon">🕐</span>
        <span class="card-label">Datum & Tijd</span>
    </div>
    <div class="card-body">
        <div class="datetime-display">
            <div class="clock-time" id="live-clock">00:00:00</div>
            <div class="clock-date" id="live-date">laden...</div>
            <div class="clock-day"  id="live-day">--</div>
        </div>
    </div>
    <div class="item-credit">datetime.php – gemaakt door Victor</div>
</div>

<script>
// Datum en tijd live bijwerken
const DAYS_NL    = ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'];
const MONTHS_NL  = ['januari','februari','maart','april','mei','juni',
                    'juli','augustus','september','oktober','november','december'];

function updateClock() {
    const now = new Date();

    // Tijd
    const h = String(now.getHours()).padStart(2, '0');
    const m = String(now.getMinutes()).padStart(2, '0');
    const s = String(now.getSeconds()).padStart(2, '0');
    document.getElementById('live-clock').textContent = `${h}:${m}:${s}`;

    // Datum
    const day  = now.getDate();
    const month = MONTHS_NL[now.getMonth()];
    const year  = now.getFullYear();
    document.getElementById('live-date').textContent = `${day} ${month} ${year}`;

    // Dag van de week
    document.getElementById('live-day').textContent = DAYS_NL[now.getDay()];
}

updateClock();
setInterval(updateClock, 1000);
</script>
