<?php
// profiel.php - Klant profiel beheer pagina
// Vereist ingelogde gebruiker

declare(strict_types=1);

global $baseUrl;
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 class="mb-4">Mijn Profiel</h1>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <!-- Tabs voor verschillende secties -->
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active helphelphelp" data-bs-toggle="tab" href="#persoonlijk" role="tab">
                        👤 Persoonlijke Gegevens
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link helphelphelp" data-bs-toggle="tab" href="#facturatieAdres" role="tab">
                        📄 Facturatieadres
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link helphelphelp" data-bs-toggle="tab" href="#leveringsAdres" role="tab">
                        📦 Leveringsadres
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- ========== TAB 1: PERSOONLIJKE GEGEVENS ========== -->
                <div class="tab-pane fade show active" id="persoonlijk" role="tabpanel">
                    <div class="card">
                        <div class="card-header text-white persGegePro">
                            <h3 class="mb-0">Persoonlijke Gegevens</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="index.php?action=updateProfiel">
                                <?php if ($gebruiker["type"] === "natuurlijk_persoon" && null !== $klantDetails): ?>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="voornaam" class="form-label">Voornaam: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="voornaam" 
                                                name="voornaam" 
                                                value="<?= htmlspecialchars($klantDetails->getVoornaam()) ?>"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="familienaam" class="form-label">Familienaam: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="familienaam" 
                                                name="familienaam" 
                                                value="<?= htmlspecialchars($klantDetails->getFamilienaam()) ?>"
                                                required
                                            >
                                        </div>
                                    </div>

                                <?php else: ?>
                                    <!-- Rechtspersoon -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="bedrijfsnaam" class="form-label">Bedrijfsnaam: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="bedrijfsnaam" 
                                                name="bedrijfsnaam" 
                                                value="<?= null !== $klantDetails ? htmlspecialchars($klantDetails->getNaam()) : '' ?>"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="btwNummer" class="form-label">BTW-nummer: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="btwNummer" 
                                                name="btwNummer" 
                                                value="<?= null !== $klantDetails ? htmlspecialchars($klantDetails->getBtwNummer()) : '' ?>"
                                                required
                                            >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="voornaam" class="form-label">Contactpersoon Voornaam: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="voornaam" 
                                                name="voornaam" 
                                                value="<?= htmlspecialchars($gebruiker['voornaam']) ?>"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="familienaam" class="form-label">Contactpersoon Familienaam: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="familienaam" 
                                                name="familienaam" 
                                                value="<?= htmlspecialchars($gebruiker['familienaam']) ?>"
                                                required
                                            >
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="emailadres" class="form-label">E-mailadres: <span class="text-danger">*</span></label>
                                    <input 
                                        type="email" 
                                        class="form-control bg-light" 
                                        id="emailadres" 
                                        name="emailadres" 
                                        value="<?= htmlspecialchars($gebruiker['emailadres']) ?>"
                                        readonly
                                        disabled
                                    >
                                    <small class="form-text text-muted">Email kan niet worden gewijzigd</small>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn gegeOpsl">
                                        💾 Gegevens Opslaan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ========== TAB 2: FACTURATIEADRES ========== -->
                <div class="tab-pane fade" id="facturatieAdres" role="tabpanel">
                    <div class="card">
                        <div class="card-header text-white persGegePro">
                            <h3 class="mb-0">Facturatieadres</h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($facturatieAdres)): ?>
                                <form method="POST" action="index.php?action=updateAdres">
                                    <input type="hidden" name="adresType" value="facturatie">

                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="facturatie_straat" class="form-label">Straat: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="facturatie_straat" 
                                                name="straat" 
                                                value="<?= htmlspecialchars($facturatieAdres->getStraat()) ?>"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="facturatie_huisNummer" class="form-label">Nr: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="facturatie_huisNummer" 
                                                name="huisNummer" 
                                                value="<?= htmlspecialchars($facturatieAdres->getHuisNummer()) ?>"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="facturatie_bus" class="form-label">Bus:</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="facturatie_bus" 
                                                name="bus" 
                                                value="<?= htmlspecialchars($facturatieAdres->getBus() ?? '') ?>"
                                            >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="facturatie_postcode" class="form-label">Postcode: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="facturatie_postcode" 
                                                name="postcode" 
                                                value="<?= htmlspecialchars($facturatieAdres->getPostcode()) ?>"
                                                pattern="[0-9]{4}"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label for="facturatie_plaats" class="form-label">Plaats:</label>
                                            <input 
                                                type="text" 
                                                class="form-control bg-light" 
                                                id="facturatie_plaats" 
                                                value="<?= htmlspecialchars($facturatieAdres->getPlaatsNaam()) ?>"
                                                readonly
                                                disabled
                                            >
                                            <small class="form-text text-muted">Plaats wordt automatisch ingevuld op basis van postcode</small>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn">
                                            💾 Facturatieadres Opslaan
                                        </button>
                                    </div>
                                </form>
                            <?php else: ?>
                                <p class="text-muted">Geen facturatieadres beschikbaar.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- ========== TAB 3: LEVERINGSADRES ========== -->
                <div class="tab-pane fade" id="leveringsAdres" role="tabpanel">
                    <div class="card">
                        <div class="card-header text-white persGegePro">
                            <h3 class="mb-0">Leveringsadres</h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($leveringsAdres)): ?>
                                <form method="POST" action="index.php?action=updateAdres">
                                    <input type="hidden" name="adresType" value="levering">

                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="levering_straat" class="form-label">Straat: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="levering_straat" 
                                                name="straat" 
                                                value="<?= htmlspecialchars($leveringsAdres->getStraat()) ?>"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="levering_huisNummer" class="form-label">Nr: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="levering_huisNummer" 
                                                name="huisNummer" 
                                                value="<?= htmlspecialchars($leveringsAdres->getHuisNummer()) ?>"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="levering_bus" class="form-label">Bus:</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="levering_bus" 
                                                name="bus" 
                                                value="<?= htmlspecialchars($leveringsAdres->getBus() ?? '') ?>"
                                            >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="levering_postcode" class="form-label">Postcode: <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="levering_postcode" 
                                                name="postcode" 
                                                value="<?= htmlspecialchars($leveringsAdres->getPostcode()) ?>"
                                                pattern="[0-9]{4}"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label for="levering_plaats" class="form-label">Plaats:</label>
                                            <input 
                                                type="text" 
                                                class="form-control bg-light" 
                                                id="levering_plaats" 
                                                value="<?= htmlspecialchars($leveringsAdres->getPlaatsNaam()) ?>"
                                                readonly
                                                disabled
                                            >
                                            <small class="form-text text-muted">Plaats wordt automatisch ingevuld op basis van postcode</small>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn">
                                            💾 Leveringsadres Opslaan
                                        </button>
                                    </div>
                                </form>
                            <?php else: ?>
                                <p class="text-muted">Geen leveringsadres beschikbaar.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terug naar home knop -->
            <div class="mt-4">
                <a href="index.php?action=home" class="btn btn-secondary">
                    ← Terug naar Home
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS voor tabs (indien nog niet geladen) -->
<script>
    // Bootstrap 5 tabs worden automatisch geactiveerd via data-bs-toggle
</script>

<!-- Real-time formulier validatie -->
<script src="<?= $baseUrl ?>/Public/Js/profielformulier.js"></script>
