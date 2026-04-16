<div class="winkelmand-page">
    <h1 class="winkelmand-title">Winkelmand</h1>

    <?php if (empty($winkelmandregels)): ?>
        <?php include __DIR__ . '/../Components/winkelmandLeegComponent.php'; ?>
    <?php else: ?>
        <?php include __DIR__ . '/../Components/winkelmandComponent.php'; ?>
    <?php endif; ?>
</div>
