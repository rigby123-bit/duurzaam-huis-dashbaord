<?php
// includes/temperature.php
// Gemaakt door: [NaamStudent3]
// Lijst A - Item 1: Actuele buitentemperatuur via Open-Meteo API (gratis, geen key nodig)

// Coördinaten Amsterdam (pas aan naar jouw stad)
$lat = 52.3676;
$lon = 4.9041;

$url = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}&current_weather=true&hourly=relativehumidity_2m&timezone=Europe%2FAmsterdam";

$temp = null;
$wind = null;
$weathercode = null;
$humidity = null;

$response = @file_get_contents($url);
if ($response) {
    $data = json_decode($response, true);
    if (isset($data['current_weather'])) {
        $temp = round($data['current_weather']['temperature'], 1);
        $wind = round($data['current_weather']['windspeed'], 1);
        $weathercode = $data['current_weather']['weathercode'];
    }
    // Luchtvochtigheid van het eerste uur
    if (isset($data['hourly']['relativehumidity_2m'][0])) {
        $humidity = $data['hourly']['relativehumidity_2m'][0];
    }
}

// Weer-icoon op basis van code
function getWeatherIcon($code) {
    if ($code === null) return '🌡️';
    if ($code === 0) return '☀️';
    if ($code <= 3) return '⛅';
    if ($code <= 48) return '🌫️';
    if ($code <= 67) return '🌧️';
    if ($code <= 77) return '❄️';
    if ($code <= 82) return '🌦️';
    return '⛈️';
}
?>
<link rel="stylesheet" href="css/temperature.css">

<div class="dashboard-card card-temperature">
    <div class="card-header">
        <span class="card-icon"><?= getWeatherIcon($weathercode) ?></span>
        <span class="card-label">Buitentemperatuur</span>
    </div>
    <div class="card-body">
        <?php if ($temp !== null): ?>
            <div class="temp-value">
                <span class="temp-number"><?= $temp ?></span>
                <span class="temp-unit">°C</span>
            </div>
            <div class="temp-details">
                <?php if ($wind): ?>
                    <span>💨 <?= $wind ?> km/u</span>
                <?php endif; ?>
                <?php if ($humidity): ?>
                    <span>💧 <?= $humidity ?>% vochtigheid</span>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p class="error-msg">⚠️ Data niet beschikbaar</p>
        <?php endif; ?>
    </div>
    <div class="item-credit">temperature.php – gemaakt door [NaamStudent3]</div>
</div>
