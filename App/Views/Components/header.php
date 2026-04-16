<?php global $baseUrl; ?>

<header>
    <div class="container-fluid p-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">

                <!--            hamburger icon for mobile-->
                <button class="btn d-md-none p-2 me-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasCategorieen" aria-controls="offcanvasCategorieen">
                    <?php include __DIR__ . '/iconHamburger.php'; ?>
                </button>

                <!--            logo-->
                <a href="?action=home">
                    <img id="logo" class="img-fluid" src="<?= $baseUrl ?>/Public/img/logo_prularia_wit_transparant.png"
                        alt="logo prularia" style="max-height: 60px;" />
                </a>
            </div>

            <!--            navigatie-->
            <nav class="d-flex align-items-center gap-2">
                <?php include __DIR__ . '/accountDropdown.php'; ?>
                <a href="?action=wishlist" class="buttonNav">
                    <span class="wishlist-nav-icon-wrap">
                        <?php include __DIR__ . '/iconWishlist.php'; ?>
                        <?php include __DIR__ . '/WishlistHeaderArtCounter.php'; ?>
                    </span>
                </a>
                <a href="?action=winkelmandje" class="buttonNav">
                    <span class="header-icon-wrap">
                        <?php include __DIR__ . '/iconCart.php'; ?>
                        <?php include __DIR__ . '/WinkelmandHeaderArtCounter.php'; ?>
                    </span>
                </a>
            </nav>
        </div>

        <div class="toegankelijkheidsmenu mt-2 justify-content-center" role="group" aria-label="Kies een weergave">
            <!-- Toevoegen keuze schermweergave -->
            <span class="toegankelijkheidslabel">Weergave:</span>
            <button type="button" class="weergave-knop actief" data-theme="standaard" aria-pressed="true">Standaard</button>
            <button type="button" class="weergave-knop" data-theme="hoog-contrast" aria-pressed="false">Hoog contrast</button>
            <button type="button" class="weergave-knop" data-theme="leesvriendelijk" aria-pressed="false">Leesvriendelijk</button>
            <span class="toegankelijkheidslabel toegankelijkheidslabel-split">Voorlezen:</span>
            <button type="button" class="weergave-knop voorlees-knop" data-voorlezen-toggle aria-pressed="false">Voorlezen uit</button>
        </div>
    </div>
</header>