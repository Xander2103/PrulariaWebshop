<!-- registratie.php - registratie formulier (Account of Gast) -->
<?php $prefill = $prefill ?? []; ?>

<main class="container">
    <div class="registratie-container">
        <h1>Registreren</h1>

        <form method="POST" id="registratieForm" class="registratie-form">
            
            <!-- ========== REGISTRATIE TYPE KEUZE ========== -->
            <div class="form-section">
                <h2>Hoe wilt u verder?</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <label class="mb-0 d-flex align-items-center">
                                    <input type="radio" name="registratieType" value="account" id="radioAccount" class="me-2" checked>
                                    <strong>Account aanmaken</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <label class="mb-0 d-flex align-items-center">
                                    <input type="radio" name="registratieType" value="gast" id="radioGast" class="me-2">
                                    <strong>Als gast bestellen</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== TYPE KLANT (PARTICULIER/BEDRIJF) ========== -->
            <div class="form-section">
                <h2>Type klant</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <label class="mb-0 d-flex align-items-center">
                                    <input type="radio" name="klantType" value="particulier" checked id="radioParticulier" class="me-2">
                                    <strong>Particulier</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <label class="mb-0 d-flex align-items-center">
                                    <input type="radio" name="klantType" value="bedrijf" id="radioBedrijf" class="me-2">
                                    <strong>Bedrijf</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== CONTACTGEGEVENS ========== -->
            <div class="form-section">
                <h2>Contactgegevens</h2>
                
                <div class="form-group">
                    <label for="emailadres">E-mailadres: <span class="required">*</span></label>
                    <input 
                        type="email" 
                        id="emailadres" 
                        name="emailadres" 
                        class="form-control" 
                        required 
                        maxlength="45"
                        placeholder="voorbeeld@email.com"
                        value="<?= htmlspecialchars($prefill['email'] ?? $_POST["emailadres"] ?? "") ?>"
                    >
                    <small class="form-text text-muted">Voor orderbevestiging en tracking</small>
                </div>
            </div>

            <!-- ========== WACHTWOORD SECTIE (ALLEEN BIJ ACCOUNT) ========== -->
            <div id="wachtwoordSectie" class="form-section">
                <h2>Wachtwoord</h2>
                
                <!-- Wachtwoord Requirements Info -->
                <div class="alert alert-info mb-2">
                    <strong>ℹ️ Vereisten:</strong> Min. 8 karakters, 1 hoofdletter (A-Z), 1 cijfer (0-9)
                </div>
                
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paswoord">Wachtwoord: <span class="required">*</span></label>
                            <input 
                                type="password" 
                                id="paswoord" 
                                name="paswoord" 
                                class="form-control" 
                                minlength="8"
                                pattern="^(?=.*[A-Z])(?=.*[0-9]).{8,}$"
                                title="Minimaal 8 karakters, 1 hoofdletter en 1 cijfer"
                                placeholder="Bijv. Welkom2026"
                            >
                            <div id="paswoordFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paswoordBevestiging">Herhaal wachtwoord: <span class="required">*</span></label>
                            <input 
                                type="password" 
                                id="paswoordBevestiging" 
                                name="paswoordBevestiging" 
                                class="form-control" 
                                minlength="8"
                                placeholder="Typ het wachtwoord opnieuw"
                            >
                            <div id="paswoordMatchFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== ACCOUNT PROMO (ALLEEN BIJ GAST) ========== -->
            <div id="accountPromo" class="form-section account-promo-highlight" style="display: none;">
                <div class="form-group mb-0">
                    <label class="d-flex align-items-center mb-2">
                        <input type="checkbox" id="maakAccountAan" name="maakAccountAan" value="1" class="account-promo-checkbox me-2">
                        <span>
                            <strong>🎁 Je bent slechts 1 veld verwijderd van een account!</strong>
                            <small class="text-muted d-block">
                                Vink dit aan om je wachtwoord in te vullen en te genieten van onze kortingen als klant.
                            </small>
                        </span>
                    </label>

                    <!-- Wachtwoord velden (verborgen tot checkbox aangevinkt) -->
                    <div id="gastWachtwoordVelden" style="display: none;">
                        <!-- Wachtwoord Requirements Info -->
                        <div class="alert alert-info mb-3">
                            <strong>ℹ️ Wachtwoord vereisten:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Minimaal 8 karakters</li>
                                <li>Minimaal 1 hoofdletter (A-Z)</li>
                                <li>Minimaal 1 cijfer (0-9)</li>
                            </ul>
                        </div>
                        
                        <div class="form-group">
                            <label for="gastPaswoord">Wachtwoord: <span class="required">*</span></label>
                            <input 
                                type="password" 
                                id="gastPaswoord" 
                                name="gastPaswoord" 
                                class="form-control" 
                                minlength="8"
                                pattern="^(?=.*[A-Z])(?=.*[0-9]).{8,}$"
                                title="Minimaal 8 karakters, 1 hoofdletter en 1 cijfer"
                                placeholder="Bijv. Welkom2026"
                            >
                            <div id="gastPaswoordFeedback" class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="gastPaswoordBevestiging">Herhaal wachtwoord: <span class="required">*</span></label>
                            <input 
                                type="password" 
                                id="gastPaswoordBevestiging" 
                                name="gastPaswoordBevestiging" 
                                class="form-control" 
                                minlength="8"
                                placeholder="Typ het wachtwoord opnieuw"
                            >
                            <div id="gastPaswoordMatchFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== PERSOONLIJKE GEGEVENS (PARTICULIER) ========== -->
            <div class="form-section" id="sectieParticulier">
                <h2>Persoonlijke gegevens</h2>
                
                <div class="form-group">
                    <label for="voornaam">Voornaam: <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="voornaam" 
                        name="voornaam" 
                        class="form-control" 
                        maxlength="45"
                        placeholder="Jan"
                        value="<?= htmlspecialchars($prefill['voornaam'] ?? $_POST["voornaam"] ?? "") ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="familienaam">Familienaam: <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="familienaam" 
                        name="familienaam" 
                        class="form-control" 
                        maxlength="45"
                        placeholder="Janssen"
                        value="<?= htmlspecialchars($prefill['familienaam'] ?? $_POST["familienaam"] ?? "") ?>"
                    >
                </div>
            </div>

            <!-- ========== BEDRIJFSGEGEVENS (RECHTSPERSOON) ========== -->
            <div class="form-section" id="sectieBedrijf" style="display: none;">
                <h2>Bedrijfsgegevens</h2>
                
                <div class="form-group">
                    <label for="bedrijfsnaam">Bedrijfsnaam: <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="bedrijfsnaam" 
                        name="bedrijfsnaam" 
                        class="form-control" 
                        maxlength="45"
                        placeholder="Bedrijf BV"
                        value="<?= htmlspecialchars($_POST["bedrijfsnaam"] ?? "") ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="btwNummer">BTW-nummer: <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="btwNummer" 
                        name="btwNummer" 
                        class="form-control" 
                        maxlength="10"
                        placeholder="0123456789"
                        pattern="[0-9]{10}"
                        title="BTW-nummer moet 10 cijfers zijn"
                        value="<?= htmlspecialchars($_POST["btwNummer"] ?? "") ?>"
                    >
                    <small class="form-text">10 cijfers zonder spaties of punten</small>
                </div>

                <h3>Contactpersoon</h3>
                
                <div class="form-group">
                    <label for="contactVoornaam">Voornaam: <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="contactVoornaam" 
                        name="contactVoornaam" 
                        class="form-control" 
                        maxlength="45"
                        placeholder="Jan"
                        value="<?= htmlspecialchars($_POST["contactVoornaam"] ?? "") ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="contactFamilienaam">Familienaam: <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="contactFamilienaam" 
                        name="contactFamilienaam" 
                        class="form-control" 
                        maxlength="45"
                        placeholder="Janssen"
                        value="<?= htmlspecialchars($_POST["contactFamilienaam"] ?? "") ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="functie">Functie: <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="functie" 
                        name="functie" 
                        class="form-control" 
                        maxlength="45"
                        placeholder="Manager, Inkoper, ..."
                        value="<?= htmlspecialchars($_POST["functie"] ?? "") ?>"
                    >
                </div>
            </div>

            <!-- ========== FACTURATIEADRES ========== -->
            <div class="form-section">
                <h2>Facturatieadres</h2>
                
                <div class="row g-2">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="straat">Straat: <span class="required">*</span></label>
                            <input 
                                type="text" 
                                id="straat" 
                                name="straat" 
                                class="form-control" 
                                required
                                placeholder="Hoofdstraat"
                                value="<?= htmlspecialchars($prefill['straat'] ?? $_POST["straat"] ?? "") ?>"
                            >
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="huisNummer">Huisnr: <span class="required">*</span></label>
                            <input 
                                type="text" 
                                id="huisNummer" 
                                name="huisNummer" 
                                class="form-control" 
                                required
                                placeholder="123"
                                value="<?= htmlspecialchars($prefill['huisnummer'] ?? $_POST["huisNummer"] ?? "") ?>"
                            >
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="bus">Bus:</label>
                            <input 
                                type="text" 
                                id="bus" 
                                name="bus" 
                                class="form-control" 
                                placeholder="A"
                                value="<?= htmlspecialchars($prefill['bus'] ?? $_POST["bus"] ?? "") ?>"
                            >
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="postcode">Postcode: <span class="required">*</span></label>
                            <input 
                                type="text" 
                                id="postcode" 
                                name="postcode" 
                                class="form-control" 
                                required
                                pattern="[0-9]{4}"
                                placeholder="1000"
                                value="<?= htmlspecialchars($prefill['postcode'] ?? $_POST["postcode"] ?? "") ?>"
                            >
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="plaats">Plaats: <span class="required">*</span></label>
                            <input 
                                type="text" 
                                id="plaats" 
                                name="plaats" 
                                class="form-control" 
                                required
                                placeholder="Brussel"
                                value="<?= htmlspecialchars($prefill['plaats'] ?? $_POST["plaats"] ?? "") ?>"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== LEVERINGSADRES ========== -->
            <div class="form-section">
                <h2>Leveringsadres</h2>
                
                <div class="form-group">
                    <label class="d-flex align-items-center">
                        <input 
                            type="checkbox" 
                            id="verschillendAdres" 
                            name="verschillendAdres" 
                            value="1"
                            class="me-2"
                            <?= isset($_POST["verschillendAdres"]) ? "checked" : "" ?>
                        >
                        <span>Leveringsadres is verschillend van facturatieadres</span>
                    </label>
                </div>

                <div id="leveringsadresVelden" style="display: none;">
                    <div class="row g-2">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="leverStraat">Straat:</label>
                                <input 
                                    type="text" 
                                    id="leverStraat" 
                                    name="leverStraat" 
                                    class="form-control" 
                                    placeholder="Andere straat"
                                    value="<?= htmlspecialchars($_POST["leverStraat"] ?? "") ?>"
                                >
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="leverHuisNummer">Huisnr:</label>
                                <input 
                                    type="text" 
                                    id="leverHuisNummer" 
                                    name="leverHuisNummer" 
                                    class="form-control" 
                                    placeholder="456"
                                    value="<?= htmlspecialchars($_POST["leverHuisNummer"] ?? "") ?>"
                                >
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="leverBus">Bus:</label>
                                <input 
                                    type="text" 
                                    id="leverBus" 
                                    name="leverBus" 
                                    class="form-control" 
                                    placeholder="B"
                                    value="<?= htmlspecialchars($_POST["leverBus"] ?? "") ?>"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leverPostcode">Postcode:</label>
                                <input 
                                    type="text" 
                                    id="leverPostcode" 
                                    name="leverPostcode" 
                                    class="form-control" 
                                    pattern="[0-9]{4}"
                                    placeholder="2000"
                                    value="<?= htmlspecialchars($_POST["leverPostcode"] ?? "") ?>"
                                >
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="leverPlaats">Plaats:</label>
                                <input 
                                    type="text" 
                                    id="leverPlaats" 
                                    name="leverPlaats" 
                                    class="form-control" 
                                    placeholder="Antwerpen"
                                    value="<?= htmlspecialchars($_POST["leverPlaats"] ?? "") ?>"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== VOORWAARDEN ========== -->
            <div class="form-section">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="accepteerVoorwaarden" required>
                        <span>Ik ga akkoord met de <a href="index.php?action=algemenevoorwaarden" target="_blank" class="form-link">algemene voorwaarden</a> en het <a href="index.php?action=privacybeleid" target="_blank" class="form-link">privacybeleid</a> <span class="required">*</span></span>
                    </label>
                </div>
            </div>

            <!-- ========== SUBMIT ========== -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-lg" id="submitButton">
                    <span id="submitTextAccount">Account aanmaken</span>
                    <span id="submitTextGast" style="display: none;">Doorgaan naar bestelling</span>
                </button>
                <a href="index.php?action=loginformulier" class="btn btn-link">Al een account? Inloggen</a>
            </div>

            <p class="form-note">
                <span class="required">*</span> = verplichte velden
            </p>
        </form>
    </div>
</main>

<!-- Dynamische formulier logica -->
<script src="Public/Js/registratieformulier.js"></script>
