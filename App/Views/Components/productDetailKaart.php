<?php
global $baseUrl;
$isInWishlist = $isInWishlist ?? false;
$huidigeUrl = $_SERVER['REQUEST_URI'] ?? 'index.php?action=home';
?>
<div>
    <section class="product-detail-page">
        <?php if ($artikel === null): ?>
            <p class="product-detail-not-found">Product niet gevonden.</p>
        <?php else: ?>
            <?php $voorraad = $artikel->getVoorraad(); ?>

            <div class="product-detail-card">
                <div class="product-detail-image-wrapper">
                    <img
                        src="<?= $baseUrl ?>/Public/img/img/images/<?= htmlspecialchars((string)$artikel->getArtikelId()) ?>.jpg"
                        alt="<?= htmlspecialchars($artikel->getNaam()); ?>"
                        class="product-detail-image">
                </div>

                <div class="product-detail-content">
                    <h1 class="product-detail-title">
                        <?= htmlspecialchars($artikel->getNaam()); ?>
                    </h1>

                    <p class="product-detail-description">
                        <?= htmlspecialchars($artikel->getBeschrijving() ?? ''); ?>
                    </p>

                    <p class="product-detail-price">
                        € <?= number_format($artikel->getPrijs(), 2, ',', '.'); ?>
                    </p>

                    <?php if ($voorraad > 5): ?>
                        <p class="product-detail-stock in-stock">Op voorraad</p>
                    <?php elseif ($voorraad > 0): ?>
                        <p class="product-detail-stock low-stock">
                            Nog slechts <?= htmlspecialchars((string)$voorraad); ?> op voorraad
                        </p>
                    <?php else: ?>
                        <p class="product-detail-stock out-of-stock">Niet op voorraad</p>
                    <?php endif; ?>

                    <p class="product-detail-meta">
                        <strong>Artikelnummer:</strong>
                        <?= htmlspecialchars((string)$artikel->getArtikelId()); ?>
                    </p>

                    <p class="product-detail-meta">
                        <strong>Beschikbare voorraad:</strong>
                        <?= htmlspecialchars((string)$voorraad); ?>
                    </p>

                    <div class="product-detail-action-row">
                        <form method="post" action="index.php?action=toevoegenAanWinkelmandje" class="product-detail-form">
                            <input
                                type="hidden"
                                name="artikelId"
                                value="<?= htmlspecialchars((string)$artikel->getArtikelId()); ?>">

                            <div class="detail-aantal-wrapper">
                                <span class="detail-aantal-label" id="aantalHC">Aantal</span>

                                <div class="detail-aantal-selector">
                                    <button
                                        type="button"
                                        class="detail-aantal-knop"
                                        onclick="verlaagAantalDetail(<?= (int)$artikel->getArtikelId(); ?>)"
                                        <?= $voorraad <= 0 ? 'disabled' : '' ?>>
                                        −
                                    </button>

                                    <input
                                        id="aantal-detail-<?= (int)$artikel->getArtikelId(); ?>"
                                        type="number"
                                        name="aantal"
                                        min="1"
                                        max="<?= (int)$voorraad; ?>"
                                        value="1"
                                        class="detail-aantal-input"
                                        readonly
                                        <?= $voorraad <= 0 ? 'disabled aria-disabled="true"' : '' ?>>

                                    <button
                                        type="button"
                                        class="detail-aantal-knop"
                                        onclick="verhoogAantalDetail(<?= (int)$artikel->getArtikelId(); ?>, <?= (int)$voorraad; ?>)"
                                        <?= $voorraad <= 0 ? 'disabled' : '' ?>>
                                        +
                                    </button>
                                </div>
                            </div>

                            <div class="product-detail-submit-row">
                                <button
                                    type="submit"
                                    class="product-detail-button"
                                    <?= $voorraad === 0 ? 'disabled' : ''; ?>>
                                    Toevoegen aan winkelmandje
                                </button>
                        </form>


                    </div>
                </div>
            </div>
</div>
<?php endif; ?>
</section>
</div>

<script>
    function verlaagAantalDetail(artikelId) {
        const input = document.getElementById("aantal-detail-" + artikelId);
        const huidigeWaarde = parseInt(input.value) || 1;
        const minimum = parseInt(input.min) || 1;

        if (huidigeWaarde > minimum) {
            input.value = huidigeWaarde - 1;
        }
    }

    function verhoogAantalDetail(artikelId, voorraad) {
        const input = document.getElementById("aantal-detail-" + artikelId);
        const huidigeWaarde = parseInt(input.value) || 1;
        const maximum = parseInt(input.max) || voorraad;

        if (huidigeWaarde < maximum) {
            input.value = huidigeWaarde + 1;
        }
    }
</script>