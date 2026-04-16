<?php
// accountDropdown.php - Account dropdown menu component
declare(strict_types=1);

$isIngelogd = isset($_SESSION["gebruiker"]);
$voornaam = "";
if ($isIngelogd) {
    $rawVoornaam = $_SESSION["gebruiker"]["voornaam"] ?? "Account";
    // Limiteer tot 22 karakters, voeg "..." toe indien ingekort
    if (mb_strlen($rawVoornaam) > 22) {
        $voornaam = htmlspecialchars(mb_substr($rawVoornaam, 0, 22)) . "...";
    } else {
        $voornaam = htmlspecialchars($rawVoornaam);
    }
}
?>

<?php if ($isIngelogd): ?>
    <!-- Ingelogd: Dropdown menu -->
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center gap-1 buttonNav dropdown-toggle" 
           id="accountDropdown" 
           data-bs-toggle="dropdown" 
           aria-expanded="false"
           style="text-decoration: none;">
            <?php include __DIR__ . '/iconAccount.php'; ?>
            <span class="d-none d-md-inline"><?= $voornaam ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
            <li>
                <a class="dropdown-item" href="?action=bestelgeschiedenis">
                    Mijn bestellingen
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="?action=profiel">
                    Mijn profiel
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="?action=actiecodes">
                    Mijn actiecodes
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item text-warning" 
                   href="?action=deactiveerAccount" 
                   onclick="return confirm('Weet u zeker dat u uw account wilt deactiveren? Dit kan niet ongedaan worden gemaakt.');">
                    Account deactiveren
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="?action=logout">
                    Uitloggen
                </a>
            </li>
        </ul>
    </div>
<?php else: ?>
    <!-- Niet ingelogd: Login link -->
    <a href="?action=loginformulier" class="d-flex align-items-center gap-1 buttonNav">
        <?php include __DIR__ . '/iconAccount.php'; ?>
        <span class="d-none d-md-inline">Inloggen / Registreren</span>
        <?php include __DIR__ . '/iconArrow.php'; ?>
    </a>
<?php endif; ?>
