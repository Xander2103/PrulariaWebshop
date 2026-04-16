<main class="container my-5">
    <h1 class="mb-4">Afrekenen</h1>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                <?php foreach ($errors as $error) echo "<li>" . htmlspecialchars($error) . "</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-7">
            <form id="checkoutForm" action="index.php?action=checkoutProcess" method="POST">
                
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">1. Bestemmingsgegevens</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!$isLoggedIn): ?>
                            <p class="text-muted small mb-3 checkoutLogin">Nog geen account? <a href="index.php?action=login" class="text-decoration-none">Log in</a> voor sneller afrekenen.</p>
                        <?php endif; ?>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Voornaam:</label>
                                <input type="text" name="voornaam" class="form-control" value="<?= $isLoggedIn && $persoon ? htmlspecialchars($persoon->getVoornaam() ?? '') : '' ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Achternaam:</label>
                                <input type="text" name="familienaam" class="form-control" value="<?= $isLoggedIn && $persoon ? htmlspecialchars($persoon->getFamilienaam() ?? '') : '' ?>" required>
                            </div>
                        </div>
                        
                        <?php if (!$isLoggedIn): ?>
                            <div class="mb-4">
                                <label class="form-label">E-mailadres:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        <?php endif; ?>

                        <h6 class="mt-4 mb-3 border-bottom pb-2">Leveringsadres</h6>
                        <div class="mb-3">
                            <label class="form-label">Straat:</label>
                            <input type="text" name="straat" class="form-control" value="<?= $isLoggedIn && $adres ? htmlspecialchars($adres->getStraat()) : '' ?>" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Huisnummer:</label>
                                <input type="text" name="huisnummer" class="form-control" value="<?= $isLoggedIn && $adres ? htmlspecialchars($adres->getHuisNummer()) : '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Bus: <span class="text-muted small">(optioneel)</span></label>
                                <input type="text" name="bus" class="form-control" value="<?= $isLoggedIn && $adres ? htmlspecialchars($adres->getBus() ?? '') : '' ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Postcode: <span class="text-muted small">(bv. 1000)</span></label>
                                <input type="text" name="postcode" class="form-control" value="<?= $isLoggedIn && $plaats ? htmlspecialchars($plaats->getPostcode()) : '' ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Plaats:</label>
                            <input type="text" name="plaats" class="form-control" value="<?= $isLoggedIn && $plaats ? htmlspecialchars($plaats->getPlaats()) : '' ?>" required>
                        </div>
                        
                        <?php if (!$isLoggedIn): ?>
                            <div class="alert alert-secondary mt-4 mb-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="create_account" id="createCheck"> 
                                    <label class="form-check-label" for="createCheck">
                                        <strong>Maak direct een account aan!</strong><br>
                                        <span class="text-muted small">U bent één wachtwoord verwijderd van een account.</span>
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">2. Betaalwijze</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($betaalwijzes as $bw): ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="betaalwijzeId" id="betaal_<?= $bw->getBetaalwijzeId() ?>" value="<?= $bw->getBetaalwijzeId() ?>" required>
                                <label class="form-check-label" for="betaal_<?= $bw->getBetaalwijzeId() ?>">
                                    <?= htmlspecialchars($bw->getNaam()) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </form>
        </div>

        <div class="col-lg-5">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Actiecode</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['actiecode_error'])): ?>
                        <div class="alert alert-danger py-2 px-3 mb-3"><?= htmlspecialchars($_SESSION['actiecode_error']) ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['actiecode_success'])): ?>
                        <div class="alert alert-success py-2 px-3 mb-3"><?= htmlspecialchars($_SESSION['actiecode_success']) ?></div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['actiecode'])): ?>
                        <p class="mb-2">Actieve actiecode: <strong><?= htmlspecialchars($_SESSION['actiecode']) ?></strong></p>
                        <form method="post" action="index.php?action=verwijderActiecode">
                            <button type="submit" class="btn btn-outline-secondary btn-sm w-100">Verwijderen</button>
                        </form>
                    <?php else: ?>
                        <form method="post" action="index.php?action=pasActiecodeToe" class="d-flex gap-2">
                            <input type="text" class="form-control" name="actiecode" placeholder="Actiecode invoeren" required>
                            <button type="submit" class="btn btn-dark">Toepassen</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">3. Overzicht bestelling</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        <?php foreach ($winkelmandregels as $regel): ?>
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span><?= htmlspecialchars($regel['artikel']->getNaam()) ?> <small class="text-muted">(x<?= $regel['aantal'] ?>)</small></span>
                                <span>&euro; <?= number_format($regel['subtotaal'], 2, ',', '.') ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <?php if (isset($korting) && $korting > 0): ?>
                        <div class="d-flex justify-content-between text-danger mb-2">
                            <strong>Korting (10% actiecode)</strong>
                            <strong>- &euro; <?= number_format($korting, 2, ',', '.') ?></strong>
                        </div>
                    <?php endif; ?>
                    
                    <div class="d-flex justify-content-between border-top pt-3 mb-3">
                        <strong class="fs-5">Totaal:</strong>
                        <strong class="fs-5">&euro; <?= number_format($totaalPrijs, 2, ',', '.') ?></strong>
                    </div>

                    <div class="alert alert-info mb-4 py-2 px-3">
                        <small class="mb-0">
                            <strong>🚚 <?= \Config\AppConfig::DELIVERY_PROMISE ?></strong><br>
                            <span class="text-muted">Levering na ontvangst van de betaling</span>
                        </small>
                    </div>

                    <button type="submit" form="checkoutForm" class="btn btn-lg w-100 btn-checkout">Betalen & Bestelling Plaatsen</button>
                </div>
            </div>
        </div>
    </div>
</main>
