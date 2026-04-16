
<div class="winkelmand-lijst">
    <?php foreach ($winkelmandregels as $winkelmandregel): ?>
        <div class="winkelmand-card">
            <div class="winkelmand-card-inhoud">
                <div class="winkelmand-afbeelding-wrapper">
                    <img
                          src="<?= $baseUrl ?>/Public/img/img/images/<?= htmlspecialchars((string) $winkelmandregel['artikel']->getArtikelId()) ?>.jpg"
                        alt="<?= htmlspecialchars($winkelmandregel['artikel']->getNaam()); ?>"
                        class="winkelmand-afbeelding">
                </div>

                <div class="winkelmand-info">
                    <h2 class="winkelmand-product-naam">
                        <?= htmlspecialchars($winkelmandregel['artikel']->getNaam()); ?>
                    </h2>

                    <p class="winkelmand-meta">
                        <strong>Prijs per stuk:</strong>
                        € <?= number_format($winkelmandregel['artikel']->getPrijs(), 2, ',', '.'); ?>
                    </p>

                    <p class="winkelmand-meta">
                        <strong>Aantal:</strong>
                        <?= htmlspecialchars((string) $winkelmandregel['aantal']); ?>
                    </p>

                    <p class="winkelmand-subtotaal">
                        <strong>Subtotaal:</strong>
                        € <?= number_format((float) $winkelmandregel['subtotaal'], 2, ',', '.'); ?>
                    </p>
                </div>

                <div class="winkelmand-acties">
                    <form method="post" action="index.php?action=verwijderenUitWinkelmandje">
                        <input
                            type="hidden"
                            name="artikelId"
                            value="<?= htmlspecialchars((string)$winkelmandregel['artikel']->getArtikelId()); ?>">
                        <button type="submit" class="winkelmand-verwijder-knop">
                            Verwijderen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="winkelmand-samenvatting">
        <div class="winkelmand-actiecode-box mb-4">
            <?php if (isset($_SESSION['actiecode_error'])): ?>
                <div class="alert alert-danger mb-2"><?= htmlspecialchars($_SESSION['actiecode_error']) ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['actiecode_success'])): ?>
                <div class="alert alert-success mb-2"><?= htmlspecialchars($_SESSION['actiecode_success']) ?></div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['actiecode'])): ?>
                <p>Actieve actiecode: <strong><?= htmlspecialchars($_SESSION['actiecode']) ?></strong></p>
                <form method="post" action="index.php?action=verwijderActiecode">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Verwijderen</button>
                </form>
            <?php else: ?>
                <form method="post" action="index.php?action=pasActiecodeToe" class="d-flex gap-2">
                    <input type="text" class="form-control" name="actiecode" placeholder="Actiecode invoeren" required>
                    <button type="submit" class="btn btn-dark">Toepassen</button>
                </form>
            <?php endif; ?>
        </div>

        <div class="winkelmand-totaal-box d-flex flex-column align-items-start">
            <?php if (isset($korting) && $korting > 0): ?>
                <p class="text-danger mb-1">
                    <strong>Korting (10%):</strong>
                    - € <?= number_format((float) $korting, 2, ',', '.'); ?>
                </p>
            <?php endif; ?>
            <p class="winkelmand-totaal-tekst mb-0">
                <strong>Totaalprijs:</strong>
                € <?= number_format((float) $totaalPrijs, 2, ',', '.'); ?>
            </p>
        </div>

        <div class="winkelmand-samenvatting-acties">
            <a href="index.php" class="winkelmand-terug-link">
                Verder winkelen
            </a>

            <a href="index.php?action=checkout" class="winkelmand-afrekenen-knop">
                Afrekenen
            </a>
        </div>
    </div>
</div>