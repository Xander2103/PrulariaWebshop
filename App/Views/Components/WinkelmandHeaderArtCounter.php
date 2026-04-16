<?php

declare(strict_types=1);

use App\Services\WinkelmandjeService;

$winkelmandjeService = new WinkelmandjeService();
$winkelmandregels = $winkelmandjeService->getWinkelmandregels();

$aantalWinkelmandItems = 0;

foreach ($winkelmandregels as $winkelmandregel) {
    $aantalWinkelmandItems += (int) ($winkelmandregel['aantal'] ?? 0);
}
?>

<?php if ($aantalWinkelmandItems > 0): ?>
    <span class="buttonNav-badge">
        <?= htmlspecialchars((string) $aantalWinkelmandItems); ?>
    </span>
<?php endif; ?>