<?php
// includes/weather-forecast.php
// Gemaakt door: [NaamStudent2]
// Lijst A - Item 3: Weersverwachting voor de komende 5 dagen

$lat = 52.3676;
$lon = 4.9041;
$today = date('Y-m-d');
$endDate = date('Y-m-d', strtotime('+4 days'));

$url = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}"
     . "&daily=weathercode,temperature_2m_max,temperature_2m_min,precipitation_sum"
     . "&timezone=Europe%2FAmsterdam"
     . "&start_date={$today}&end_date={$endDate}";

$days = [];
$response = @file_get_contents($url);
if ($response) {
    $data = json_decode($response, true);
    if (isset($data['daily'])) {
        $d = $data['daily'];
        for ($i = 0; $i < count($d['time']); $i++) {
            $days[] = [
                'date'    => $d['time'][$i],
                'code'    => $d['weathercode'][$i],
                'max'     => round($d['temperature_2m_max'][$i], 1),
                'min'     => round($d['temperature_2m_min'][$i], 1),
                'precip'  => round($d['precipitation_sum'][$i], 1),
            ];
        }
    }
}

$NL_DAYS = ['zo','ma','di','wo','do','vr','za'];

function getForecastIcon($code) {
    if ($code === 0)       return '☀️';
    if ($code <= 2)        return '🌤️';
    if ($code <= 3)        return '⛅';
    if ($code <= 48)       return '🌫️';
    if ($code <= 55)       return '🌦️';
    if ($code <= 65)       return '🌧️';
    if ($code <= 77)       return '❄️';
    if ($code <= 82)       return '🌦️';
    return '⛈️';
}

function getForecastLabel($code) {
    if ($code === 0)  return 'Zonnig';
    if ($code <= 2)   return 'Half bewolkt';
    if ($code <= 3)   return 'Bewolkt';
    if ($code <= 48)  return 'Mist';
    if ($code <= 55)  return 'Motregen';
    if ($code <= 65)  return 'Regen';
    if ($code <= 77)  return 'Sneeuw';
    if ($code <= 82)  return 'Regenbuien';
    return 'Onweer';
}
?>
<link rel="stylesheet" href="css/forecast.css">

<div class="dashboard-card card-forecast card-wide">
    <div class="card-header">
        <span class="card-icon">📅</span>
        <span class="card-label">Weersverwachting – 5 dagen</span>
    </div>
    <div class="card-body">
        <?php if (!empty($days)): ?>
            <div class="forecast-strip">
                <?php foreach ($days as $i => $day):
                    $ts    = strtotime($day['date']);
                    $dayNr = (int)date('w', $ts);
                    $label = ($i === 0) ? 'Vandaag' : (($i === 1) ? 'Morgen' : strtoupper($NL_DAYS[$dayNr]));
                ?>
                <div class="forecast-day <?= $i === 0 ? 'forecast-today' : '' ?>">
                    <span class="f-day-label"><?= $label ?></span>
                    <span class="f-icon"><?= getForecastIcon($day['code']) ?></span>
                    <span class="f-desc"><?= getForecastLabel($day['code']) ?></span>
                    <span class="f-temps">
                        <span class="f-max"><?= $day['max'] ?>°</span>
                        <span class="f-min"><?= $day['min'] ?>°</span>
                    </span>
                    <?php if ($day['precip'] > 0): ?>
                        <span class="f-precip">💧 <?= $day['precip'] ?> mm</span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="error-msg">⚠️ Voorspelling niet beschikbaar</p>
        <?php endif; ?>
    </div>
    <div class="item-credit">weather-forecast.php – gemaakt door Tyler</div>
</div>
<?php
// includes/weather-forecast.php
// Gemaakt door: [tyler]
// Lijst A - Item 3: Weersverwachting voor de komende 5 dagen

$lat = 52.3676;
$lon = 4.9041;
$today = date('Y-m-d');
$endDate = date('Y-m-d', strtotime('+4 days'));

$url = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}"
     . "&daily=weathercode,temperature_2m_max,temperature_2m_min,precipitation_sum"
     . "&timezone=Europe%2FAmsterdam"
     . "&start_date={$today}&end_date={$endDate}";

$days = [];
$response = @file_get_contents($url);
if ($response) {
    $data = json_decode($response, true);
    if (isset($data['daily'])) {
        $d = $data['daily'];
        for ($i = 0; $i < count($d['time']); $i++) {
            $days[] = [
                'date'    => $d['time'][$i],
                'code'    => $d['weathercode'][$i],
                'max'     => round($d['temperature_2m_max'][$i], 1),
                'min'     => round($d['temperature_2m_min'][$i], 1),
                'precip'  => round($d['precipitation_sum'][$i], 1),
            ];
        }
    }
}

$NL_DAYS = ['zo','ma','di','wo','do','vr','za'];

function getForecastIcon($code) {
    if ($code === 0)       return '☀️';
    if ($code <= 2)        return '🌤️';
    if ($code <= 3)        return '⛅';
    if ($code <= 48)       return '🌫️';
    if ($code <= 55)       return '🌦️';
    if ($code <= 65)       return '🌧️';
    if ($code <= 77)       return '❄️';
    if ($code <= 82)       return '🌦️';
    return '⛈️';
}

function getForecastLabel($code) {
    if ($code === 0)  return 'Zonnig';
    if ($code <= 2)   return 'Half bewolkt';
    if ($code <= 3)   return 'Bewolkt';
    if ($code <= 48)  return 'Mist';
    if ($code <= 55)  return 'Motregen';
    if ($code <= 65)  return 'Regen';
    if ($code <= 77)  return 'Sneeuw';
    if ($code <= 82)  return 'Regenbuien';
    return 'Onweer';
}
?>
<link rel="stylesheet" href="css/forecast.css">

<div class="dashboard-card card-forecast card-wide">
    <div class="card-header">
        <span class="card-icon">📅</span>
        <span class="card-label">Weersverwachting – 5 dagen</span>
    </div>
    <div class="card-body">
        <?php if (!empty($days)): ?>
            <div class="forecast-strip">
                <?php foreach ($days as $i => $day):
                    $ts    = strtotime($day['date']);
                    $dayNr = (int)date('w', $ts);
                    $label = ($i === 0) ? 'Vandaag' : (($i === 1) ? 'Morgen' : strtoupper($NL_DAYS[$dayNr]));
                ?>
                <div class="forecast-day <?= $i === 0 ? 'forecast-today' : '' ?>">
                    <span class="f-day-label"><?= $label ?></span>
                    <span class="f-icon"><?= getForecastIcon($day['code']) ?></span>
                    <span class="f-desc"><?= getForecastLabel($day['code']) ?></span>
                    <span class="f-temps">
                        <span class="f-max"><?= $day['max'] ?>°</span>
                        <span class="f-min"><?= $day['min'] ?>°</span>
                    </span>
                    <?php if ($day['precip'] > 0): ?>
                        <span class="f-precip">💧 <?= $day['precip'] ?> mm</span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="error-msg">⚠️ Voorspelling niet beschikbaar</p>
        <?php endif; ?>
    </div>
    <div class="item-credit">weather-forecast.php – gemaakt door [tyler]</div>
</div>
