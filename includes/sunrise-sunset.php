<?php
// includes/sunrise-sunset.php
// Gemaakt door: [tyler]
// Lijst A - Item 2: Zonsopkomst en zonsondergang via Open-Meteo

$lat = 52.3676;
$lon = 4.9041;
$today = date('Y-m-d');

$url = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}&daily=sunrise,sunset&timezone=Europe%2FAmsterdam&start_date={$today}&end_date={$today}";

$sunrise = null;
$sunset = null;
$daylength = null;

$response = @file_get_contents($url);
if ($response) {
    $data = json_decode($response, true);
    if (isset($data['daily'])) {
        $sunriseRaw = $data['daily']['sunrise'][0] ?? null;
        $sunsetRaw  = $data['daily']['sunset'][0] ?? null;
        if ($sunriseRaw) $sunrise = date('H:i', strtotime($sunriseRaw));
        if ($sunsetRaw)  $sunset  = date('H:i', strtotime($sunsetRaw));

        if ($sunriseRaw && $sunsetRaw) {
            $diffSeconds = strtotime($sunsetRaw) - strtotime($sunriseRaw);
            $hours = floor($diffSeconds / 3600);
            $minutes = floor(($diffSeconds % 3600) / 60);
            $daylength = "{$hours}u {$minutes}m";
        }
    }
}

// Bereken hoe ver de dag gevorderd is (voor de boog)
$now = time();
$progressPercent = 0;
if ($sunrise && $sunset) {
    $sunriseTs = strtotime(date('Y-m-d') . ' ' . $sunrise);
    $sunsetTs  = strtotime(date('Y-m-d') . ' ' . $sunset);
    if ($now >= $sunriseTs && $now <= $sunsetTs) {
        $progressPercent = round((($now - $sunriseTs) / ($sunsetTs - $sunriseTs)) * 100);
    } elseif ($now > $sunsetTs) {
        $progressPercent = 100;
    }
}
?>
<link rel="stylesheet" href="css/sunrise.css">

<div class="dashboard-card card-sunrise">
    <div class="card-header">
        <span class="card-icon">🌅</span>
        <span class="card-label">Zon vandaag</span>
    </div>
    <div class="card-body">
        <?php if ($sunrise && $sunset): ?>
            <div class="sun-arc-wrapper">
                <div class="sun-arc">
                    <div class="sun-track">
                        <div class="sun-progress" style="width: <?= $progressPercent ?>%"></div>
                        <div class="sun-dot" style="left: <?= $progressPercent ?>%">☀️</div>
                    </div>
                </div>
            </div>
            <div class="sun-times">
                <div class="sun-time">
                    <span class="sun-time-icon">🌄</span>
                    <span class="sun-time-label">Opkomst</span>
                    <span class="sun-time-value"><?= $sunrise ?></span>
                </div>
                <div class="sun-time-middle">
                    <span class="sun-day-length"><?= $daylength ?></span>
                    <span class="sun-day-label">daglengte</span>
                </div>
                <div class="sun-time">
                    <span class="sun-time-icon">🌇</span>
                    <span class="sun-time-label">Ondergang</span>
                    <span class="sun-time-value"><?= $sunset ?></span>
                </div>
            </div>
        <?php else: ?>
            <p class="error-msg">⚠️ Data niet beschikbaar</p>
        <?php endif; ?>
    </div>
    <div class="item-credit">sunrise-sunset.php – gemaakt door [NaamStudent4]</div>
</div>
