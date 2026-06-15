<?php
// includes/footer.php
// Gemaakt door: [tyler]
// Footer met groepsnamen
?>
<link rel="stylesheet" href="css/footer.css">

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <span>🌿 Duurzaam Huis Dashboard</span>
            <span class="footer-year"><?= date('Y') ?></span>
        </div>

        <div class="footer-team">
            <span class="footer-label">Groep:</span>
            <ul class="team-list">
                <li>Student 1 – [Naam]</li>
                <li>Student 2 – [Naam]</li>
                <li>Student 3 – [Naam]</li>
                <li>Student 4 – [Naam]</li>
            </ul>
        </div>

        <div class="footer-school">
            <span>[Schoolnaam] &middot; [Klas] &middot; <?= date('Y') ?></span>
        </div>
    </div>
    <div class="item-credit">footer.php – gemaakt door [tyler]</div>
</footer>
