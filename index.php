<?php
// Duurzaam Huis Dashboard - index.php
// Hoofdpagina die alle includes samenvoegt
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duurzaam Huis Dashboard</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="light-mode" id="app">

    <?php include 'includes/header.php'; ?>

    <main class="dashboard-grid">

        <!-- LIJST A: Actuele Data -->
        <section class="dashboard-section section-data">
            <h2 class="section-title">📡 Live Data</h2>
            <div class="cards-row">
                <?php include 'includes/temperature.php'; ?>
                <?php include 'includes/sunrise-sunset.php'; ?>
                <?php include 'includes/datetime.php'; ?>
            </div>
            <div class="cards-row">
                <?php include 'includes/weather-forecast.php'; ?>
            </div>
        </section>

        <!-- LIJST C: Bedieningselementen -->
        <section class="dashboard-section section-controls">
            <h2 class="section-title">⚙️ Instellingen</h2>
            <div class="cards-row">
                <?php include 'includes/darkmode.php'; ?>
                <?php include 'includes/timespan.php'; ?>
            </div>
        </section>

        <!-- LIJST B: Grafieken -->
        <section class="dashboard-section section-charts">
            <h2 class="section-title">📊 Verbruik & Opbrengst</h2>
            <div class="charts-grid">
                <?php include 'includes/electricity-chart.php'; ?>
                <?php include 'includes/gas-chart.php'; ?>
                <?php include 'includes/water-chart.php'; ?>
                <?php include 'includes/solar-chart.php'; ?>
            </div>
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="js/charts.js"></script>
</body>
</html>
