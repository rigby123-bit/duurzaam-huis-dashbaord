# 🌿 Duurzaam Huis Dashboard

Een PHP/JS/CSS dashboard voor het monitoren van energieverbruik en actuele weersinformatie.

## Groepsleden
- [victor/rigby123-bit] – index.php, water-chart.php, datetime.php
- [tyler] – footer.php, solar-chart.php, weather-forecast.php
- [ilham] – header.php, electricity-chart.php, darkmode.php
- [tyler] – sunrise-sunset.php, gas-chart.php, timespan.php

## Mappenstructuur
```
duurzaam-huis-dashboard/
├── index.php              # Hoofdpagina
├── includes/
│   ├── header.php         # Header met logo
│   ├── footer.php         # Footer met groepsnamen
│   ├── temperature.php    # Buitentemperatuur (API)
│   ├── sunrise-sunset.php # Zon op/onder (API)
│   ├── datetime.php       # Datum & tijd (JS)
│   ├── weather-forecast.php # Weersverwachting (API)
│   ├── electricity-chart.php # Electriciteit grafiek
│   ├── gas-chart.php      # Gas grafiek
│   ├── water-chart.php    # Water grafiek
│   ├── solar-chart.php    # Zonnepanelen grafiek
│   ├── darkmode.php       # Dark/light mode toggle
│   └── timespan.php       # Tijdspanne selector
├── css/                   # Stylesheets per include
├── js/                    # JavaScript
└── data/                  # JSON databestanden
```
## API's gebruikt
- [Open-Meteo](https://open-meteo.com/) – gratis, geen API-key nodig
  - Temperatuur, wind, luchtvochtigheid
  - Zonsopkomst & zonsondergang
  - 5-daagse weersverwachting

## Lokaal draaien
Je hebt een PHP server nodig (bijv. XAMPP of MAMP):
1. Clone de repo in je `htdocs` map
2. Start Apache
3. Ga naar `http://localhost/duurzaam-huis-dashboard/`

## GitHub Workflow
```bash
# Wijzigingen committen en pushen
git add .
git commit -m "Beschrijving van je wijziging"
git push origin main
```

