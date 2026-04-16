<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DAOs\GebruikersAccountDAO;
use App\Models\DAOs\KlantDAO;
use App\Models\DAOs\NatuurlijkePersoonDAO;
use App\Models\DAOs\RechtspersoonDAO;
use App\Models\DAOs\ContactpersoonDAO;
use App\Models\DAOs\AdresDAO;
use App\Models\DAOs\PlaatsDAO;

class AuthenticatieService
{
    private GebruikersAccountDAO $gebruikersAccountDAO;
    private KlantDAO $klantDAO;
    private NatuurlijkePersoonDAO $natuurlijkePersoonDAO;
    private RechtspersoonDAO $rechtspersoonDAO;
    private ContactpersoonDAO $contactpersoonDAO;
    private AdresDAO $adresDAO;
    private PlaatsDAO $plaatsDAO;

    public function __construct()
    {
        $this->ensureSessionStarted();
        $this->gebruikersAccountDAO = new GebruikersAccountDAO();
        $this->klantDAO = new KlantDAO();
        $this->natuurlijkePersoonDAO = new NatuurlijkePersoonDAO();
        $this->rechtspersoonDAO = new RechtspersoonDAO();
        $this->contactpersoonDAO = new ContactpersoonDAO();
        $this->adresDAO = new AdresDAO();
        $this->plaatsDAO = new PlaatsDAO();
    }

    private function ensureSessionStarted(): void
    {
        if (PHP_SESSION_NONE === session_status()) session_start();
    }

    public function registerNatuurlijkPersoon(
        string $voornaam,
        string $familienaam,
        string $emailadres,
        string $paswoord,
        array $adresData,
        ?array $leveringsAdresData = null
    ): ?int {
        // Valideer dat email nog niet bestaat
        if ($this->gebruikersAccountDAO->emailExists($emailadres)) {
            return null;
        }

        // Valideer plaats bestaat in database
        $plaats = $this->plaatsDAO->findByPostcodeAndPlaats($adresData["postcode"], $adresData["plaats"]);
        if (null === $plaats) {
            return null;
        }
        $plaatsId = $plaats->getPlaatsId();

        // Stap 1: Maak gebruikersaccount aan (plain text wachtwoord)
        $gebruikersAccountId = $this->gebruikersAccountDAO->createAccount($emailadres, $paswoord);
        if (null === $gebruikersAccountId) {
            return null;
        }

        // Stap 2: Maak facturatieadres aan
        $facturatieAdresId = $this->adresDAO->createAdres(
            $adresData["straat"],
            $adresData["huisNummer"],
            $adresData["bus"] ?? null,
            $plaatsId
        );
        if (null === $facturatieAdresId) {
            return null;
        }

        // Stap 3: Maak leveringsadres aan (of gebruik facturatieadres)
        $leveringsAdresId = $facturatieAdresId;
        if (null !== $leveringsAdresData) {
            $leverPlaats = $this->plaatsDAO->findByPostcodeAndPlaats($leveringsAdresData["postcode"], $leveringsAdresData["plaats"]);
            if (null === $leverPlaats) {
                return null;
            }
            $leverPlaatsId = $leverPlaats->getPlaatsId();

            $leveringsAdresId = $this->adresDAO->createAdres(
                $leveringsAdresData["straat"],
                $leveringsAdresData["huisNummer"],
                $leveringsAdresData["bus"] ?? null,
                $leverPlaatsId
            );
            if (null === $leveringsAdresId) {
                return null;
            }
        }

        // Stap 4: Maak klant aan
        $klantId = $this->klantDAO->createKlant($facturatieAdresId, $leveringsAdresId);
        if (null === $klantId) {
            return null;
        }

        // Stap 5: Maak natuurlijk persoon aan
        $natuurlijkePersoonId = $this->natuurlijkePersoonDAO->createPersoon(
            $klantId,
            $voornaam,
            $familienaam,
            $gebruikersAccountId
        );
        if (null === $natuurlijkePersoonId) {
            return null;
        }

        return $gebruikersAccountId;
    }

    public function registerRechtspersoon(
        string $bedrijfsnaam,
        string $btwNummer,
        string $emailadres,
        string $paswoord,
        string $contactVoornaam,
        string $contactFamilienaam,
        string $functie,
        array $adresData,
        ?array $leveringsAdresData = null
    ): ?int {
        // Valideer dat email nog niet bestaat
        if ($this->gebruikersAccountDAO->emailExists($emailadres)) {
            return null;
        }

        // Valideer plaats bestaat in database
        $plaats = $this->plaatsDAO->findByPostcodeAndPlaats($adresData["postcode"], $adresData["plaats"]);
        if (null === $plaats) {
            return null;
        }
        $plaatsId = $plaats->getPlaatsId();

        // Stap 1: Maak gebruikersaccount aan (plain text wachtwoord)
        $gebruikersAccountId = $this->gebruikersAccountDAO->createAccount($emailadres, $paswoord);
        if (null === $gebruikersAccountId) {
            return null;
        }

        // Stap 2: Maak facturatieadres aan
        $facturatieAdresId = $this->adresDAO->createAdres(
            $adresData["straat"],
            $adresData["huisNummer"],
            $adresData["bus"] ?? null,
            $plaatsId
        );
        if (null === $facturatieAdresId) {
            return null;
        }

        // Stap 3: Maak leveringsadres aan (of gebruik facturatieadres)
        $leveringsAdresId = $facturatieAdresId;
        if (null !== $leveringsAdresData) {
            $leverPlaats = $this->plaatsDAO->findByPostcodeAndPlaats($leveringsAdresData["postcode"], $leveringsAdresData["plaats"]);
            if (null === $leverPlaats) {
                return null;
            }
            $leverPlaatsId = $leverPlaats->getPlaatsId();

            $leveringsAdresId = $this->adresDAO->createAdres(
                $leveringsAdresData["straat"],
                $leveringsAdresData["huisNummer"],
                $leveringsAdresData["bus"] ?? null,
                $leverPlaatsId
            );
            if (null === $leveringsAdresId) {
                return null;
            }
        }

        // Stap 4: Maak klant aan
        $klantId = $this->klantDAO->createKlant($facturatieAdresId, $leveringsAdresId);
        if (null === $klantId) {
            return null;
        }

        // Stap 5: Maak rechtspersoon aan
        $rechtspersoonId = $this->rechtspersoonDAO->createRechtspersoon($klantId, $bedrijfsnaam, $btwNummer);
        if (null === $rechtspersoonId) {
            return null;
        }

        // Stap 6: Maak contactpersoon aan
        $contactpersoonId = $this->contactpersoonDAO->createContactpersoon(
            $contactVoornaam,
            $contactFamilienaam,
            $functie,
            $klantId,
            $gebruikersAccountId
        );
        if (null === $contactpersoonId) {
            return null;
        }

        return $gebruikersAccountId;
    }

    public function login(string $emailadres, string $paswoord): bool
    {
        // Zoek gebruiker op email
        $gebruiker = $this->gebruikersAccountDAO->findByEmail($emailadres);
        if (null === $gebruiker) {
            return false;
        }

        // Check of account disabled is
        if ($gebruiker->isDisabled()) {
            return false;
        }

        // Verifieer wachtwoord (plain text vergelijking voor schoolproject)
        if ($gebruiker->getPaswoord() !== $paswoord) {
            return false;
        }

        $gebruikersAccountId = $gebruiker->getGebruikersAccountId();

        // Probeer eerst als natuurlijk persoon
        $natuurlijkePersoon = $this->natuurlijkePersoonDAO->findByGebruikersAccountId($gebruikersAccountId);
        if (null !== $natuurlijkePersoon) {
            // Haal klantgegevens op voor adressen
            $klant = $this->klantDAO->findById($natuurlijkePersoon->getKlantId());

            $_SESSION["gebruiker"] = [
                "gebruikersAccountId" => $gebruikersAccountId,
                "emailadres" => $emailadres,
                "klantId" => $natuurlijkePersoon->getKlantId(),
                "type" => "natuurlijk_persoon",
                "voornaam" => $natuurlijkePersoon->getVoornaam(),
                "familienaam" => $natuurlijkePersoon->getFamilienaam(),
                "facturatieAdresId" => $klant?->getFacturatieAdresId(),
                "leveringsAdresId" => $klant?->getLeveringsAdresId()
            ];

            // Wis eventuele gastgegevens (ingelogde account heeft prioriteit)
            if (isset($_SESSION["gast"])) {
                unset($_SESSION["gast"]);
            }

            return true;
        }

        // Probeer als rechtspersoon (via contactpersoon)
        $contactpersoon = $this->contactpersoonDAO->findByGebruikersAccountId($gebruikersAccountId);
        if (null !== $contactpersoon) {
            // Haal klantgegevens op voor adressen
            $klant = $this->klantDAO->findById($contactpersoon->getKlantId());
            // Haal rechtspersoongegevens op voor bedrijfsnaam en BTW
            $rechtspersoon = $this->rechtspersoonDAO->findRechtspersoonByKlantId($contactpersoon->getKlantId());

            $_SESSION["gebruiker"] = [
                "gebruikersAccountId" => $gebruikersAccountId,
                "emailadres" => $emailadres,
                "klantId" => $contactpersoon->getKlantId(),
                "contactpersoonId" => $contactpersoon->getContactpersoonId(),
                "type" => "rechtspersoon",
                "voornaam" => $contactpersoon->getVoornaam(),
                "familienaam" => $contactpersoon->getFamilienaam(),
                "functie" => $contactpersoon->getFunctie(),
                "bedrijfsnaam" => $rechtspersoon?->getNaam(),
                "btwNummer" => $rechtspersoon?->getBtwNummer(),
                "facturatieAdresId" => $klant?->getFacturatieAdresId(),
                "leveringsAdresId" => $klant?->getLeveringsAdresId()
            ];

            // Wis eventuele gastgegevens (ingelogde account heeft prioriteit)
            if (isset($_SESSION["gast"])) {
                unset($_SESSION["gast"]);
            }

            return true;
        }

        return false;
    }

    public function logout(): void
    {
        unset($_SESSION["gebruiker"]);

        // Vernietig ook redirect en gastgegevens
        if (isset($_SESSION["redirect"])) unset($_SESSION["redirect"]);
        if (isset($_SESSION["gast"])) unset($_SESSION["gast"]);
    }


    public function isAuthenticated(): bool
    {
        if (!isset($_SESSION["gebruiker"])) return false;

        $gebruiker = $_SESSION["gebruiker"];

        // Verifieer dat essentiële velden aanwezig zijn
        return isset($gebruiker["gebruikersAccountId"], $gebruiker["emailadres"]);
    }

    public function validatePassword(string $paswoord): array
    {
        // Check minimum lengte
        if (strlen($paswoord) < \Config\AppConfig::PASSWORD_MIN_LENGTH) {
            return [
                "valid" => false,
                "error" => "Wachtwoord moet minimaal " . \Config\AppConfig::PASSWORD_MIN_LENGTH . " karakters bevatten."
            ];
        }

        // Check hoofdletter vereiste
        if (\Config\AppConfig::PASSWORD_REQUIRE_UPPERCASE && !preg_match('/[A-Z]/', $paswoord)) {
            return [
                "valid" => false,
                "error" => "Wachtwoord moet minimaal 1 hoofdletter bevatten."
            ];
        }

        // Check cijfer vereiste
        if (\Config\AppConfig::PASSWORD_REQUIRE_DIGIT && !preg_match('/[0-9]/', $paswoord)) {
            return [
                "valid" => false,
                "error" => "Wachtwoord moet minimaal 1 cijfer bevatten."
            ];
        }

        // Check speciaal karakter vereiste
        if (\Config\AppConfig::PASSWORD_REQUIRE_SPECIAL && !preg_match('/[^a-zA-Z0-9]/', $paswoord)) {
            return [
                "valid" => false,
                "error" => "Wachtwoord moet minimaal 1 speciaal karakter bevatten."
            ];
        }

        return ["valid" => true, "error" => null];
    }

    public function validateEmail(string $emailadres): array
    {
        // Check email format
        if (!filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
            return [
                "valid" => false,
                "error" => "Ongeldig emailadres."
            ];
        }

        // Check of email al bestaat
        if ($this->gebruikersAccountDAO->emailExists($emailadres)) {
            return [
                "valid" => false,
                "error" => "Dit emailadres is al in gebruik."
            ];
        }

        return ["valid" => true, "error" => null];
    }

    public function validateEmailFormat(string $emailadres): bool
    {
        return filter_var($emailadres, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function validateBtwNummer(string $btwNummer): array
    {
        if (!preg_match('/^[0-9]{10}$/', $btwNummer)) {
            return [
                "valid" => false,
                "error" => "BTW-nummer moet 10 cijfers zijn."
            ];
        }

        return ["valid" => true, "error" => null];
    }

    // Registreer gastgegevens in sessie (voor checkout zonder account)
    public function registerGast(array $gastData): bool
    {
        // Blokkeer gastregistratie als gebruiker al ingelogd is
        if ($this->isAuthenticated()) {
            return false;
        }

        // Valideer verplichte velden
        if (!isset($gastData["email"], $gastData["voornaam"], $gastData["familienaam"])) {
            return false;
        }

        // Valideer adresgegevens
        if (!isset(
            $gastData["adres"]["straat"],
            $gastData["adres"]["huisNummer"],
            $gastData["adres"]["postcode"],
            $gastData["adres"]["plaats"]
        )) {
            return false;
        }

        // Sla gastgegevens op in sessie
        $_SESSION["gast"] = $gastData;

        return true;
    }

    public function createKlantFromGastData(): ?int
    {
        // Check of gastgegevens aanwezig zijn
        if (!isset($_SESSION["gast"])) {
            return null;
        }

        $gastData = $_SESSION["gast"];
        $isRechtspersoon = isset($gastData["bedrijfsnaam"]) && !empty($gastData["bedrijfsnaam"]);

        // Valideer plaats bestaat in database
        $plaats = $this->plaatsDAO->findByPostcodeAndPlaats($gastData["adres"]["postcode"], $gastData["adres"]["plaats"]);
        if (null === $plaats) {
            return null;
        }
        $plaatsId = $plaats->getPlaatsId();

        // Stap 1: Maak facturatieadres aan
        $facturatieAdresId = $this->adresDAO->createAdres(
            $gastData["adres"]["straat"],
            $gastData["adres"]["huisNummer"],
            $gastData["adres"]["bus"] ?? null,
            $plaatsId
        );
        if (null === $facturatieAdresId) {
            return null;
        }

        // Stap 2: Maak leveringsadres aan (of gebruik facturatieadres)
        $leveringsAdresId = $facturatieAdresId;
        if (isset($gastData["leveringsAdres"]) && !empty($gastData["leveringsAdres"]["straat"])) {
            $leverPlaats = $this->plaatsDAO->findByPostcodeAndPlaats($gastData["leveringsAdres"]["postcode"], $gastData["leveringsAdres"]["plaats"]);
            if (null === $leverPlaats) {
                return null;
            }
            $leverPlaatsId = $leverPlaats->getPlaatsId();

            $leveringsAdresId = $this->adresDAO->createAdres(
                $gastData["leveringsAdres"]["straat"],
                $gastData["leveringsAdres"]["huisNummer"],
                $gastData["leveringsAdres"]["bus"] ?? null,
                $leverPlaatsId
            );
            if (null === $leveringsAdresId) {
                return null;
            }
        }

        // Stap 3: Maak klant aan
        $klantId = $this->klantDAO->createKlant($facturatieAdresId, $leveringsAdresId);
        if (null === $klantId) {
            return null;
        }

        // Stap 4: Maak persoon/rechtspersoon aan zonder GebruikersAccount
        if ($isRechtspersoon) {
            // Rechtspersoon flow: Rechtspersoon → Contactpersoon (geen account)
            $rechtspersoonId = $this->rechtspersoonDAO->createRechtspersoon(
                $klantId,
                $gastData["bedrijfsnaam"],
                $gastData["btwNummer"]
            );
            if (null === $rechtspersoonId) {
                return null;
            }

            // Contactpersoon zonder gebruikersAccountId (NULL = gast)
            $contactpersoonId = $this->contactpersoonDAO->createContactpersoon(
                $gastData["voornaam"],
                $gastData["familienaam"],
                $gastData["functie"] ?? "Contactpersoon",
                $klantId,
                null  // NULL = gastbestelling
            );
            if (null === $contactpersoonId) {
                return null;
            }
        } else {
            // Natuurlijk persoon flow: NatuurlijkePersoon (geen account)
            $natuurlijkePersoonId = $this->natuurlijkePersoonDAO->createPersoon(
                $klantId,
                $gastData["voornaam"],
                $gastData["familienaam"],
                null  // NULL = gastbestelling
            );
            if (null === $natuurlijkePersoonId) {
                return null;
            }
        }

        // Stap 5: Verwijder gastgegevens uit sessie (gebruikt)
        unset($_SESSION["gast"]);

        return $klantId;
    }

    public function hasGast(): bool
    {
        return isset($_SESSION["gast"]);
    }

    public function getGastData(): ?array
    {
        return $_SESSION["gast"] ?? null;
    }

    public function getKlantIdForCheckout(): ?int
    {
        // Prioriteit 1: Ingelogde gebruiker
        if ($this->isAuthenticated()) {
            return $_SESSION["gebruiker"]["klantId"] ?? null;
        }

        // Prioriteit 2: Gastgegevens omzetten naar klant
        if ($this->hasGast()) {
            return $this->createKlantFromGastData();
        }

        // Geen data beschikbaar
        return null;
    }
}
