<?php
//Controller voor authenticatie

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthenticatieService;

class AuthController extends BaseController
{
    private AuthenticatieService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthenticatieService();
    }

    public function loginformulierAction(): void
    {
        $this->renderAction("Pages/login");
    }

    public function loginAction(): void
    {
        $emailadres = $this->getStringFromPostAction("emailadres");
        $paswoord = $this->getStringFromPostAction("paswoord");

        // Validatie
        if (empty($emailadres) || empty($paswoord)) {
            $this->redirectAction("loginformulier", "Vul alle velden in.");
            return;
        }

        // Email format validatie (generieke fout om bots te weren)
        if (!$this->authService->validateEmailFormat($emailadres)) {
            $this->redirectAction("loginformulier", "Ongeldige inloggegevens.");
            return;
        }

        // Gebruik service voor login
        $success = $this->authService->login($emailadres, $paswoord);

        if (!$success) {
            $this->redirectAction("loginformulier", "Ongeldig emailadres of wachtwoord.");
            return;
        }

        // Gast-wishlist samenvoegen met account wishlist na login
        if (!empty($_SESSION["wishlist"]) && is_array($_SESSION["wishlist"])) {
            $wishlistService = new \App\Services\WishlistService();
            $gebruikersAccountId = (int)($_SESSION["gebruiker"]["gebruikersAccountId"] ?? 0);
            if ($gebruikersAccountId > 0) {
                foreach ($_SESSION["wishlist"] as $artikelId) {
                    $wishlistService->addArtikel($gebruikersAccountId, (int)$artikelId);
                }
            }
            unset($_SESSION["wishlist"]);
        }

        // Login succesvol - redirect naar oorspronkelijke pagina of home
        $redirectAction = $this->getAndClearRedirectAction();
        $voornaam = $_SESSION["gebruiker"]["voornaam"] ?? "daar";
        
        $this->redirectAction($redirectAction, null, "Welkom terug, {$voornaam}!");
    }

    public function registratieformulierAction(): void
    {
        $prefill = $_SESSION['checkout_prefill'] ?? [];
        unset($_SESSION['checkout_prefill']);
        $this->renderAction("Pages/registratie", ['prefill' => $prefill]);
    }

    public function registratieAction(): void
    {
        // Bepaal klanttype (particulier of bedrijf)
        $klantType = $this->getStringFromPostAction("klantType");

        if ("bedrijf" === $klantType) {
            $this->rechtspersoonRegistratie();
        } else {
            $this->natuurlijkPersoonRegistratie();
        }
    }

    public function logoutAction(): void
    {
        $this->authService->logout();
        $this->redirectAction("home", null, "U bent uitgelogd.");
    }

    public function gastregistratieAction(): void
    {
        // Blokkeer toegang als gebruiker al ingelogd is
        if ($this->authService->isAuthenticated()) {
            $this->redirectAction("home", "U bent al ingelogd.");
            return;
        }
        
        // Bepaal type (particulier of bedrijf)
        $klantType = $this->getStringFromPostAction("klantType");

        if ("bedrijf" === $klantType) {
            $this->handleGastRechtspersoonRegistratie();
        } else {
            $this->handleGastNatuurlijkPersoonRegistratie();
        }
    }

    private function handleGastNatuurlijkPersoonRegistratie(): void
    {
        // Haal POST data op
        $email = trim($this->getStringFromPostAction("emailadres"));
        $voornaam = trim($this->getStringFromPostAction("voornaam"));
        $familienaam = trim($this->getStringFromPostAction("familienaam"));
        $maakAccountAan = $this->getStringFromPostAction("maakAccountAan");

        // Validatie: verplichte velden
        if (empty($email) || empty($voornaam) || empty($familienaam)) {
            $this->redirectAction("registratieformulier", "Vul alle verplichte velden in.");
            return;
        }

        // Validatie: email format (via service)
        if (!$this->authService->validateEmailFormat($email)) {
            $this->redirectAction("registratieformulier", "Controleer uw gegevens en probeer opnieuw.");
            return;
        }

        // Haal adresgegevens op
        $adresData = $this->getAdresDataFromPost(false);
        if (null === $adresData) {
            $this->redirectAction("registratieformulier", "Vul alle adresvelden in.");
            return;
        }

        // Check voor apart leveringsadres
        $leveringsAdresData = null;
        $zelfdeAdres = $this->getStringFromPostAction("zelfdeAdres");
        if (empty($zelfdeAdres)) {
            $leveringsAdresData = $this->getAdresDataFromPost(true);
        }

        // Check of gebruiker een account wil aanmaken
        if (!empty($maakAccountAan)) {
            // Gebruiker wil account aanmaken - volledige registratie
            $paswoord = $this->getStringFromPostAction("paswoord");
            $paswoordBevestiging = $this->getStringFromPostAction("paswoordBevestiging");

            // Validatie: wachtwoord velden
            if (empty($paswoord) || empty($paswoordBevestiging)) {
                $this->redirectAction("registratieformulier", "Vul alle wachtwoordvelden in.");
                return;
            }

            // Validatie: wachtwoorden komen overeen
            if ($paswoord !== $paswoordBevestiging) {
                $this->redirectAction("registratieformulier", "De wachtwoorden komen niet overeen.");
                return;
            }

            // Validatie: wachtwoord sterkte
            $passwordValidatie = $this->authService->validatePassword($paswoord);
            if (!$passwordValidatie["valid"]) {
                $this->redirectAction("registratieformulier", $passwordValidatie["error"]);
                return;
            }

            // Registreer als volledige klant
            $gebruikersAccountId = $this->authService->registerNatuurlijkPersoon(
                $voornaam,
                $familienaam,
                $email,
                $paswoord,
                $adresData,
                $leveringsAdresData
            );

            if (null === $gebruikersAccountId) {
                $this->redirectAction("registratieformulier", "Account aanmaken mislukt. Mogelijk bestaat dit e-mailadres al.");
                return;
            }

            // Log automatisch in na registratie
            $loginSuccess = $this->authService->login($email, $paswoord);
            if (!$loginSuccess) {
                $this->redirectAction("loginformulier", null, "Account aangemaakt! Log nu in.");
                return;
            }

            // Gast-wishlist samenvoegen met account wishlist na registratie
            if (!empty($_SESSION["wishlist"]) && is_array($_SESSION["wishlist"])) {
                $wishlistService = new \App\Services\WishlistService();
                $wlAccountId = (int)($_SESSION["gebruiker"]["gebruikersAccountId"] ?? 0);
                if ($wlAccountId > 0) {
                    foreach ($_SESSION["wishlist"] as $wlArtikelId) {
                        $wishlistService->addArtikel($wlAccountId, (int)$wlArtikelId);
                    }
                }
                unset($_SESSION["wishlist"]);
            }

            // Redirect naar winkelmandje
            $this->redirectAction("winkelmandje", null, "Account aangemaakt en ingelogd! U kunt nu bestellen.");
            return;
        }

        // Geen account - gewone gastregistratie
        $gastData = [
            "type" => "particulier",
            "email" => $email,
            "voornaam" => $voornaam,
            "familienaam" => $familienaam,
            "adres" => $adresData,
            "leveringsAdres" => $leveringsAdresData
        ];

        // Registreer gast via service
        $success = $this->authService->registerGast($gastData);

        if (!$success) {
            $this->redirectAction("registratieformulier", "Er is een fout opgetreden.");
            return;
        }

        // Redirect naar checkout/winkelmandje
        $this->redirectAction("winkelmandje", null, "Gastgegevens opgeslagen. U kunt nu bestellen.");
    }

    private function handleGastRechtspersoonRegistratie(): void
    {
        // Haal POST data op
        $email = trim($this->getStringFromPostAction("emailadres"));
        $bedrijfsnaam = trim($this->getStringFromPostAction("bedrijfsnaam"));
        $btwNummer = trim($this->getStringFromPostAction("btwNummer"));
        $contactVoornaam = trim($this->getStringFromPostAction("contactVoornaam"));
        $contactFamilienaam = trim($this->getStringFromPostAction("contactFamilienaam"));
        $functie = trim($this->getStringFromPostAction("functie"));

        // Validatie: verplichte velden
        if (empty($email) || empty($bedrijfsnaam) || empty($btwNummer) || 
            empty($contactVoornaam) || empty($contactFamilienaam)) {
            $this->redirectAction("registratieformulier", "Vul alle verplichte velden in.");
            return;
        }

        // Validatie: email format (via service)
        if (!$this->authService->validateEmailFormat($email)) {
            $this->redirectAction("registratieformulier", "Controleer uw gegevens en probeer opnieuw.");
            return;
        }

        // Validatie: BTW-nummer via service
        $btwValidatie = $this->authService->validateBtwNummer($btwNummer);
        if (!$btwValidatie["valid"]) {
            $this->redirectAction("registratieformulier", $btwValidatie["error"]);
            return;
        }

        // Haal adresgegevens op
        $adresData = $this->getAdresDataFromPost(false);
        if (null === $adresData) {
            $this->redirectAction("registratieformulier", "Vul alle adresvelden in.");
            return;
        }

        // Check voor apart leveringsadres
        $leveringsAdresData = null;
        $zelfdeAdres = $this->getStringFromPostAction("zelfdeAdres");
        if (empty($zelfdeAdres)) {
            $leveringsAdresData = $this->getAdresDataFromPost(true);
        }

        // Bouw gastdata array
        $gastData = [
            "type" => "bedrijf",
            "email" => $email,
            "bedrijfsnaam" => $bedrijfsnaam,
            "btwNummer" => $btwNummer,
            "voornaam" => $contactVoornaam,
            "familienaam" => $contactFamilienaam,
            "functie" => $functie,
            "adres" => $adresData,
            "leveringsAdres" => $leveringsAdresData
        ];

        // Registreer gast via service
        $success = $this->authService->registerGast($gastData);

        if (!$success) {
            $this->redirectAction("registratieformulier", "Er is een fout opgetreden.");
            return;
        }

        // Redirect naar checkout/winkelmandje
        $this->redirectAction("winkelmandje", null, "Gastgegevens opgeslagen. U kunt nu bestellen.");
    }

    private function natuurlijkPersoonRegistratie(): void
    {
        // Haal POST data op
        $emailadres = trim($this->getStringFromPostAction("emailadres"));
        $paswoord = $this->getStringFromPostAction("paswoord");
        $paswoordHerhaal = $this->getStringFromPostAction("paswoordBevestiging");
        $voornaam = trim($this->getStringFromPostAction("voornaam"));
        $familienaam = trim($this->getStringFromPostAction("familienaam"));

        // Validatie: verplichte velden
        if (empty($emailadres) || empty($paswoord) || empty($paswoordHerhaal) || empty($voornaam) || empty($familienaam)) {
            $this->redirectAction("registratieformulier", "Vul alle verplichte velden in.");
            return;
        }

        // Validatie: wachtwoorden matchen
        if ($paswoord !== $paswoordHerhaal) {
            $this->redirectAction("registratieformulier", "Wachtwoorden komen niet overeen.");
            return;
        }

        // Validatie: email (via service)
        $emailValidatie = $this->authService->validateEmail($emailadres);
        if (!$emailValidatie["valid"]) {
            $this->redirectAction("registratieformulier", $emailValidatie["error"]);
            return;
        }

        // Validatie: wachtwoord sterkte (via service)
        $passwordValidatie = $this->authService->validatePassword($paswoord);
        if (!$passwordValidatie["valid"]) {
            $this->redirectAction("registratieformulier", $passwordValidatie["error"]);
            return;
        }

        // Haal adresgegevens op
        $adresData = $this->getAdresDataFromPost(false);
        if (null === $adresData) {
            $this->redirectAction("registratieformulier", "Vul alle adresvelden in.");
            return;
        }

        // Check voor apart leveringsadres
        $leveringsAdresData = null;
        $zelfdeAdres = $this->getStringFromPostAction("zelfdeAdres");
        if (empty($zelfdeAdres)) {
            $leveringsAdresData = $this->getAdresDataFromPost(true);
        }

        // Registreer via service
        $gebruikersAccountId = $this->authService->registerNatuurlijkPersoon(
            $voornaam,
            $familienaam,
            $emailadres,
            $paswoord,
            $adresData,
            $leveringsAdresData
        );

        if (null === $gebruikersAccountId) {
            $this->redirectAction("registratieformulier", "Er is een fout opgetreden. Controleer de postcode.");
            return;
        }

        // Log automatisch in na registratie
        $loginSuccess = $this->authService->login($emailadres, $paswoord);
        if (!$loginSuccess) {
            $this->redirectAction("loginformulier", null, "Account aangemaakt! Log nu in.");
            return;
        }

        // Gast-wishlist samenvoegen met account wishlist na registratie
        if (!empty($_SESSION["wishlist"]) && is_array($_SESSION["wishlist"])) {
            $wishlistService = new \App\Services\WishlistService();
            $wlAccountId = (int)($_SESSION["gebruiker"]["gebruikersAccountId"] ?? 0);
            if ($wlAccountId > 0) {
                foreach ($_SESSION["wishlist"] as $wlArtikelId) {
                    $wishlistService->addArtikel($wlAccountId, (int)$wlArtikelId);
                }
            }
            unset($_SESSION["wishlist"]);
        }

        $volledigeNaam = $voornaam . " " . $familienaam;

        // Als er checkout data in sessie staat: bestelling nu plaatsen met het echte klantId
        if (isset($_SESSION['checkout_data'])) {
            $checkoutData = $_SESSION['checkout_data'];
            unset($_SESSION['checkout_data']);
            $this->getAndClearRedirectAction();
            $bestellingService = new \App\Services\BestellingService();
            $klantId = (int)($_SESSION['gebruiker']['klantId'] ?? 0);
            try {
                $bestelId = $bestellingService->plaatsBestelling($checkoutData, $klantId);
            } catch (\App\Exceptions\InsufficientStockException $e) {
                $bestelId = null;
            }
            if ($bestelId) {
                $this->redirectAction("bedankt&order=" . $bestelId, null, "Welkom {$volledigeNaam}! Je account is succesvol aangemaakt en je bent ingelogd.");
                return;
            }
        }

        // Registratie succesvol - redirect
        $redirectAction = $this->getAndClearRedirectAction();
        $this->redirectAction($redirectAction, null, "Welkom {$volledigeNaam}! Je account is succesvol aangemaakt en je bent ingelogd.");
    }


    private function rechtspersoonRegistratie(): void
    {
        // Haal POST data op
        $emailadres = trim($this->getStringFromPostAction("emailadres"));
        $paswoord = $this->getStringFromPostAction("paswoord");
        $paswoordHerhaal = $this->getStringFromPostAction("paswoordBevestiging");
        $bedrijfsnaam = trim($this->getStringFromPostAction("bedrijfsnaam"));
        $btwNummer = trim($this->getStringFromPostAction("btwNummer"));
        $contactVoornaam = trim($this->getStringFromPostAction("contactVoornaam"));
        $contactFamilienaam = trim($this->getStringFromPostAction("contactFamilienaam"));
        $functie = trim($this->getStringFromPostAction("functie"));

        // Validatie: verplichte velden
        if (empty($emailadres) || empty($paswoord) || empty($paswoordHerhaal) || 
            empty($bedrijfsnaam) || empty($btwNummer) || 
            empty($contactVoornaam) || empty($contactFamilienaam) || empty($functie)) {
            $this->redirectAction("registratieformulier", "Vul alle verplichte velden in.");
            return;
        }

        // Validatie: wachtwoorden matchen
        if ($paswoord !== $paswoordHerhaal) {
            $this->redirectAction("registratieformulier", "Wachtwoorden komen niet overeen.");
            return;
        }

        // Validatie: email (via service)
        $emailValidatie = $this->authService->validateEmail($emailadres);
        if (!$emailValidatie["valid"]) {
            $this->redirectAction("registratieformulier", $emailValidatie["error"]);
            return;
        }

        // Validatie: wachtwoord sterkte (via service)
        $passwordValidatie = $this->authService->validatePassword($paswoord);
        if (!$passwordValidatie["valid"]) {
            $this->redirectAction("registratieformulier", $passwordValidatie["error"]);
            return;
        }

        // Validatie: BTW-nummer (via service)
        $btwValidatie = $this->authService->validateBtwNummer($btwNummer);
        if (!$btwValidatie["valid"]) {
            $this->redirectAction("registratieformulier", $btwValidatie["error"]);
            return;
        }

        // Haal adresgegevens op
        $adresData = $this->getAdresDataFromPost(false);
        if (null === $adresData) {
            $this->redirectAction("registratieformulier", "Vul alle adresvelden in.");
            return;
        }

        // Check voor apart leveringsadres
        $leveringsAdresData = null;
        $zelfdeAdres = $this->getStringFromPostAction("zelfdeAdres");
        if (empty($zelfdeAdres)) {
            $leveringsAdresData = $this->getAdresDataFromPost(true);
        }

        // Registreer via service
        $gebruikersAccountId = $this->authService->registerRechtspersoon(
            $bedrijfsnaam,
            $btwNummer,
            $emailadres,
            $paswoord,
            $contactVoornaam,
            $contactFamilienaam,
            $functie,
            $adresData,
            $leveringsAdresData
        );

        if (null === $gebruikersAccountId) {
            $this->redirectAction("registratieformulier", "Er is een fout opgetreden. Controleer de postcode.");
            return;
        }

        // Log automatisch in na registratie
        $loginSuccess = $this->authService->login($emailadres, $paswoord);
        if (!$loginSuccess) {
            $this->redirectAction("loginformulier", null, "Account aangemaakt! Log nu in.");
            return;
        }

        // Gast-wishlist samenvoegen met account wishlist na registratie
        if (!empty($_SESSION["wishlist"]) && is_array($_SESSION["wishlist"])) {
            $wishlistService = new \App\Services\WishlistService();
            $wlAccountId = (int)($_SESSION["gebruiker"]["gebruikersAccountId"] ?? 0);
            if ($wlAccountId > 0) {
                foreach ($_SESSION["wishlist"] as $wlArtikelId) {
                    $wishlistService->addArtikel($wlAccountId, (int)$wlArtikelId);
                }
            }
            unset($_SESSION["wishlist"]);
        }

        // Registratie succesvol - redirect
        $redirectAction = $this->getAndClearRedirectAction();
        $this->redirectAction($redirectAction, null, "Welkom {$contactVoornaam} ({$bedrijfsnaam})! Je account is succesvol aangemaakt en je bent ingelogd.");
    }

    private function getAdresDataFromPost(bool $isLeveringsAdres): ?array
    {
        $prefix = $isLeveringsAdres ? "lever" : "";
        
        $straat = trim($this->getStringFromPostAction($prefix . "straat"));
        $huisNummer = trim($this->getStringFromPostAction($prefix . "huisNummer"));
        $bus = trim($this->getStringFromPostAction($prefix . "bus"));
        $postcode = trim($this->getStringFromPostAction($prefix . "postcode"));
        $plaats = trim($this->getStringFromPostAction($prefix . "plaats"));

        // Als leveringsadres en velden zijn leeg, return null (want optioneel)
        if ($isLeveringsAdres && empty($straat)) {
            return null;
        }

        // Check verplichte velden
        if (empty($straat) || empty($huisNummer) || empty($postcode) || empty($plaats)) {
            return null;
        }

        return [
            "straat" => $straat,
            "huisNummer" => $huisNummer,
            "bus" => $bus ?: null,
            "postcode" => $postcode,
            "plaats" => $plaats
        ];
    }

    /**
     * Na succesvolle login/registratie --> redirect
     * @return string De actie waarnaar moet worden geredirect (default = "home")
     */
    private function getAndClearRedirectAction(): string
    {
        // Check of er een redirect action is opgeslagen in de sessie
        if (isset($_SESSION["redirect"]) && !empty($_SESSION["redirect"])) {
            $redirectAction = $_SESSION["redirect"];
            
            // Verwijder de redirect uit sessie (use once)
            unset($_SESSION["redirect"]);
            
            return $redirectAction;
        }

        // Geen redirect opgeslagen - ga naar home
        return "home";
    }
}
