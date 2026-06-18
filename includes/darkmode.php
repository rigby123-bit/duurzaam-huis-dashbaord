<?php
// includes/darkmode.php
// Gemaakt door: Ilham Abahoua
// Lijst C - Item 1: Dark mode / Light mode toggle
?>
<link rel="stylesheet" href="css/controls.css">

<div class="dashboard-card card-control">
    <div class="card-header">
        <span class="card-icon">🌙</span>
        <span class="card-label">Weergave</span>
    </div>
    <div class="card-body">
        <div class="toggle-group">
            <span class="toggle-label" id="mode-label">☀️ Licht</span>
            <label class="toggle-switch" aria-label="Dark mode aan/uit">
                <input type="checkbox" id="darkmode-toggle">
                <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">🌙 Donker</span>
        </div>
    </div>
    <div class="item-credit">darkmode.php – gemaakt door [NaamStudent3]</div>
</div>

<script>
const toggle = document.getElementById('darkmode-toggle');
const app    = document.getElementById('app');

// Herstel vorige instelling
if (localStorage.getItem('darkmode') === 'true') {
    app.classList.replace('light-mode', 'dark-mode');
    toggle.checked = true;
}

toggle.addEventListener('change', () => {
    if (toggle.checked) {
        app.classList.replace('light-mode', 'dark-mode');
        localStorage.setItem('darkmode', 'true');
    } else {
        app.classList.replace('dark-mode', 'light-mode');
        localStorage.setItem('darkmode', 'false');
    }
});
</script>
