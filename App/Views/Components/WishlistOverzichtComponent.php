<?php global $baseUrl; ?>



<?php if (empty($wishlistOverzicht)): ?>
    <div class="wishlist-leeg">
        <p class="wishlist-leeg-tekst">Je wishlist is momenteel leeg.</p>
        <a href="index.php?action=home" class="wishlist-terug-link">Verder winkelen</a>
    </div>
<?php else: ?>
    
    <div class="wishlist-overzicht">
        <?php foreach ($wishlistOverzicht as $item): ?>
            <?php
            $wishlistItem = $item["wishlistItem"];
            $artikel = $item["artikel"];
            ?>
            <div class="wishlist-kaart">
                <div class="wishlist-kaart__afbeelding">
                    <img
                        src="<?= $baseUrl ?>/Public/img/img/images/<?= htmlspecialchars((string)$artikel->getArtikelId()) ?>.jpg"
                        alt="<?= htmlspecialchars($artikel->getNaam() ?? 'product-foto') ?>"
                        class="img-fluid">
                </div>

                <div class="wishlist-kaart__inhoud">
                    <h2 class="wishlist-kaart__titel">
                        <?= htmlspecialchars((string)$artikel->getNaam()); ?>
                    </h2>

                    <?php $categorienamen = $artikel->getCategorieen(); ?>
                    <?php if (!empty($categorienamen)): ?>
                        <p class="wishlist-kaart__categorie">
                            <?= htmlspecialchars(is_array($categorienamen) ? implode(', ', $categorienamen) : $categorienamen) ?>
                        </p>
                    <?php endif; ?>

                    <p class="wishlist-kaart__prijs">
                        € <?= number_format((float)$artikel->getPrijs(), 2, ",", "."); ?> <span>(incl. btw)</span>
                    </p>

                    <p class="wishlist-kaart__voorraad">
                        <?php if ($artikel->getVoorraad() > 5): ?>
                            <span class="in-stock">Op voorraad</span>
                        <?php elseif ($artikel->getVoorraad() > 0): ?>
                            <span class="out-of-stock">Bijna uitverkocht</span>
                        <?php else: ?>
                            <span class="out-of-stock">Niet op voorraad</span>
                        <?php endif; ?>
                    </p>

                    <div class="wishlist-kaart__acties">
                        <a
                            href="index.php?action=detailpagina&artikelId=<?= htmlspecialchars((string)$artikel->getArtikelId()); ?>"
                            class="wishlist-detail-link" id="wishlistHover">
                            Bekijk product
                        </a>

                        <form method="post" action="index.php?action=verwijderenUitWishlist" class="wishlist-verwijder-form">
                            <input
                                type="hidden"
                                name="artikelId"
                                value="<?= htmlspecialchars((string)$artikel->getArtikelId()); ?>">
                            <button type="submit" class="wishlist-verwijder-knop" id="wishlistDelete">Verwijderen</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>