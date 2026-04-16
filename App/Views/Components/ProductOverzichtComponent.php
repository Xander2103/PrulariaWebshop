<?php
global $baseUrl;

$queryParameters = $_GET;

$prevParameters = $queryParameters;
$prevParameters['pagina'] = max(1, $pagina - 1);

$nextParameters = $queryParameters;
$nextParameters['pagina'] = $pagina + 1;

$wishlistArtikelIds = $wishlistArtikelIds ?? [];
$huidigeUrl = $_SERVER['REQUEST_URI'] ?? 'index.php?action=home';


?>
<div class="filtersHome p-1">
    <div class="mb-2">
        <form id="zoekForm" action="" method="get">
            <input type="text" id="zoekveld" name="zoektekst" placeholder="Typ hier je zoekterm..." class="form-control focus-ring focus-ring-success"/>
        </form>
    </div>
    <div class="d-flex flex-wrap gap-2 voorraadkleur">
        <div class="flex-grow-1 flex-md-auto">
            <label class="mb-0" for="opVoorraad">
                <input type="checkbox" id="opVoorraad" class="form-check-input text-success  focus-ring focus-ring-success text-sorteer"/>
                Alleen op voorraad</label>
        </div>

        <div class="d-flex flex-grow-1 gap-0">
            <label class="mb-0 flex-grow-0 me-0 p-0 m-1 me-4" for="minPrijs">Min prijs: €<span id="minValue">0</span>
                <input type="range" id="minPrijs" min="0" max="<?= $maxArtikelPrijs["prijs"] ?>" value="0" step="1" />
            </label>
            <label class="mb-0 flex-grow-0 ms-0 p-0 m-1" for="maxPrijs">Max prijs: €<span
                    id="maxValue"><?= $maxArtikelPrijs["prijs"] ?></span>
                <input type="range" id="maxPrijs" min="0" max="<?= $maxArtikelPrijs["prijs"] ?>"
                    value="<?= $maxArtikelPrijs["prijs"] ?>" step="1">
            </label>
        </div>

        <div class="flex-grow-0 flex-md-auto">
            <button id="resetFilters">Reset filters</button>
        </div>
    </div>

    <div>
        <label for="sorteer" class="">Sorteer op:</label>
        <select name="sorteer" id="sorteer" class="form-select d-inline-block w-auto focus-ring focus-ring-success">
            <option value="">---Maak uw keuze---</option>
            <option value="prijs_desc">Prijs (hoog naar laag)</option>
            <option value="prijs_asc">Prijs (laag naar hoog)</option>
            <option value="naam_desc">Naam (Z-A)</option>
            <option value="naam_asc">Naam (A-Z)</option>
        </select>
    </div>

    <?php
    if (!empty($filters)) {
        ?>
        <div class='d-flex justify-content-center m-3'>
            <?php

            if (empty($artikelen)) {
                if (isset($filters["zoektekst"])) {
                    ?>
                    <p class='d-inline-block border alert alert-warning p-1'>Er zijn geen artikelen gevonden voor de zoekterm:
                        <strong><?= $filters["zoektekst"] ?></strong>.
                    </p>
                    <?php
                    exit;
                } else {
                    ?>
                    <p class='d-inline-block border alert alert-warning p-1'>Er zijn geen artikelen gevonden.</p>
                    <?php
                    exit;
                }
            } else {
                 if (isset($filters["zoektekst"])) {
                    ?>
                    <p class='d-inline-block border alert p-1'>Er zijn  <strong><?= $aantalArtikelen ?></strong> artikelen gevonden voor de zoekterm:
                        <strong><?= $filters["zoektekst"] ?></strong>.
                    </p>
                    <?php
                 }
                    else {
                ?>
                <p class='d-inline-block border alert  p-1'>Er zijn <strong><?= $aantalArtikelen ?></strong>
                    artikelen gevonden</p>
                <?php
            }}
            ?>
        </div>
        <?php
    }
    ?>

</div>

<div class="product-overzicht p-1">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 me-0">
        <?php foreach ($artikelen as $artikel): ?>
            <div class="col mb-4">
                <?php $isInWishlist = in_array($artikel->getArtikelId(), $wishlistArtikelIds, true); ?>

                <div class="artikel artikel-kaart position-relative h-100 d-flex flex-column flex-grow-1 text-center">

                    <form method="post" action="index.php?action=togglewishlist" class="wishlist-form-overlay">
                        <input
                            type="hidden"
                            name="artikelId"
                            value="<?= htmlspecialchars((string)$artikel->getArtikelId()); ?>">
                        <input
                            type="hidden"
                            name="redirect_url"
                            value="<?= htmlspecialchars($huidigeUrl); ?>">

                        <button
                            type="submit"
                            class="wishlist-heart-button <?= $isInWishlist ? 'is-active' : ''; ?>"
                            aria-label="<?= $isInWishlist ? 'Verwijder uit wishlist' : 'Voeg toe aan wishlist'; ?>"
                            title="<?= $isInWishlist ? 'Verwijder uit wishlist' : 'Voeg toe aan wishlist'; ?>">
                            ♥
                        </button>
                    </form>

                    <a href="?action=detailpagina&artikelId=<?= htmlspecialchars((string) $artikel->getArtikelId()); ?>"
                        class="artikel-detail-link"
                        aria-label="Bekijk product <?= htmlspecialchars($artikel->getNaam()); ?>">
                        <!-- Afbeelding -->
                        <img src="<?= $baseUrl ?>/Public/img/img/images/<?= htmlspecialchars((string) $artikel->getArtikelId()) ?>.jpg"
                            alt="<?= htmlspecialchars($artikel->getNaam() ?? 'product-foto') ?>" class="img-fluid w-100">

                        <!-- Titel -->
                        <h3 class="mb-0 product-detail-title HomeArtikelOverzichtTitel">
                            <?= htmlspecialchars($artikel->getNaam() ?? 'Onbekend product') ?>
                        </h3>

                        <!-- Categorie -->
                        <?php $categorienamen = $artikel->getCategorieen(); ?>
                        <?php if (!empty($categorienamen)): ?>
                            <p class="categorie small">
                                <?= htmlspecialchars(is_array($categorienamen) ? implode(', ', $categorienamen) : $categorienamen) ?>
                            </p>
                        <?php endif; ?>

                        <!-- Voorraad -->
                        <p class="voorraad">
                            <?php if ($artikel->getVoorraad() > 5): ?>
                                <span class="in-stock product-detail-stock">Op voorraad</span>
                            <?php elseif ($artikel->getVoorraad() > 0): ?>
                                <span class="out-of-stock product-detail-stock text-warning">Bijna uitverkocht</span>
                            <?php else: ?>
                                <span class="out-of-stock product-detail-stock text-danger">Niet op voorraad</span>
                            <?php endif; ?>
                            <p class="aantal-label">Voorraad: <?= $artikel->getVoorraad() ?></p>
                        </p>

                        <!-- Prijs -->
                        <p class="prijs product-detail-price">
                            &euro; <?= number_format($artikel->getPrijs(), 2, ',', '.') ?> (incl. btw)
                        </p>
                    </a>

                    <form method="post" action="?action=toevoegenAanWinkelmandje" class="w-100 mt-auto">
                        <input
                            type="hidden"
                            name="artikelId"
                            value="<?= htmlspecialchars((string)$artikel->getArtikelId()); ?>">

                        <div class="aantal-wrapper mb-2">
                            <span class="aantal-label">Aantal</span>

                            <div class="aantal-selector">
                                <button
                                    type="button"
                                    class="aantal-knop"
                                    onclick="verlaagAantal(<?= (int)$artikel->getArtikelId(); ?>)"
                                    <?= $artikel->getVoorraad() <= 0 ? 'disabled' : '' ?>>
                                    −
                                </button>

                                <input
                                    id="aantal-<?= (int)$artikel->getArtikelId(); ?>"
                                    type="number"
                                    name="aantal"
                                    min="1"
                                    max="<?= (int)$artikel->getVoorraad(); ?>"
                                    value="1"
                                    class="aantal-input"
                                    <?= $artikel->getVoorraad() <= 0 ? 'disabled aria-disabled="true"' : '' ?>>

                                <button
                                    type="button"
                                    class="aantal-knop"
                                    onclick="verhoogAantal(<?= (int)$artikel->getArtikelId(); ?>, <?= (int)$artikel->getVoorraad(); ?>)"
                                    <?= $artikel->getVoorraad() <= 0 ? 'disabled' : '' ?>>
                                    +
                                </button>
                            </div>
                        </div>

                        <button type="submit"
                            class="btn w-100 d-flex justify-content-center align-items-center position-relative <?= $artikel->getVoorraad() <= 0 ? 'disabled' : '' ?>"
                            <?= $artikel->getVoorraad() <= 0 ? 'disabled aria-disabled="true"' : '' ?>>
                            <span>Toevoegen aan winkelmandje</span>
                            <?php include __DIR__ . '/iconCart.php'; ?>
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-center w-100 gap-3 mt-4 mb-4 border-top pt-4">
        <?php if ($pagina > 1): ?>
            <button 
                type="button" 
                class="btn homePaging" 
                onclick="window.location.href='?<?= http_build_query($prevParameters) ?>'">
                Vorige
            </button>
        <?php endif; ?>

        <?php if (count($artikelen) === $limit): ?>
            <button 
                type="button" 
                class="btn homePaging" 
                onclick="window.location.href='?<?= http_build_query($nextParameters) ?>'">
                Volgende
            </button>
        <?php endif; ?>
    </div>
</div>

<script>
    function verlaagAantal(artikelId) {
        const input = document.getElementById("aantal-" + artikelId);
        const huidigeWaarde = parseInt(input.value) || 1;
        const minimum = parseInt(input.min) || 1;

        if (huidigeWaarde > minimum) {
            input.value = huidigeWaarde - 1;
        }
    }

    function verhoogAantal(artikelId, voorraad) {
        const input = document.getElementById("aantal-" + artikelId);
        const huidigeWaarde = parseInt(input.value) || 1;
        const maximum = parseInt(input.max) || voorraad;

        if (huidigeWaarde < maximum) {
            input.value = huidigeWaarde + 1;
        }
    }
</script>