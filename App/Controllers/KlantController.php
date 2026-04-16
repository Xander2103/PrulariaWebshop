<?php
// KlantController.php - Controller voor klantgerelateerde acties

declare(strict_types=1);

namespace App\Controllers;

use App\Models\DAOs\KlantDAO;
use App\Models\DAOs\NatuurlijkePersoonDAO;
use App\Models\DAOs\RechtspersoonDAO;
use App\Models\DAOs\AdresDAO;
use App\Models\DAOs\PlaatsDAO;
use App\Models\DAOs\GebruikersAccountDAO;
use App\Models\DAOs\ActiecodeDAO;
use App\Models\DAOs\BestellingDAO;
use App\Services\BestellingService;

class KlantController extends BaseController
{
    private KlantDAO $klantDAO;
    private NatuurlijkePersoonDAO $natuurlijkePersoonDAO;
    private RechtspersoonDAO $rechtspersoonDAO;
    private AdresDAO $adresDAO;
    private PlaatsDAO $plaatsDAO;
    private GebruikersAccountDAO $gebruikersAccountDAO;
    private ActiecodeDAO $actiecodeDAO;
    private BestellingDAO $bestellingDAO;
    private BestellingService $bestellingService;

    public function __construct()
    {
        parent::__construct();
        $this->klantDAO = new KlantDAO();
        $this->natuurlijkePersoonDAO = new NatuurlijkePersoonDAO();
        $this->rechtspersoonDAO = new RechtspersoonDAO();
        $this->adresDAO = new AdresDAO();
        $this->plaatsDAO = new PlaatsDAO();
        $this->gebruikersAccountDAO = new GebruikersAccountDAO();
        $this->actiecodeDAO = new ActiecodeDAO();
        $this->bestellingDAO = new BestellingDAO();
        $this->bestellingService = new BestellingService();
    }

    public function profielAction(): void
    {
        // Check of gebruiker ingelogd is
        $this->requireLogin();

        $gebruiker = $this->getIngelogdeGebruiker();
        $klantId = (int) $gebruiker["klantId"];

        // Haal klantgegevens op
        $klant = $this->klantDAO->findById($klantId);

        if (null === $klant) {
            $this->redirectAction("home", "Klantgegevens niet gevonden.");
            return;
        }

        // Haal adresgegevens op
        $facturatieAdres = null;
        $leveringsAdres = null;
        
        if (null !== $klant->getFacturatieAdresId()) {
            $facturatieAdres = $this->adresDAO->findById($klant->getFacturatieAdresId());
        }
        
        if (null !== $klant->getLeveringsAdresId()) {
            $leveringsAdres = $this->adresDAO->findById($klant->getLeveringsAdresId());
        }

        // Haal specifieke gegevens op basis van type
        $klantDetails = null;
        if ($gebruiker["type"] === "natuurlijk_persoon") {
            $klantDetails = $this->natuurlijkePersoonDAO->findByKlantId($klantId);
        } else {
            $klantDetails = $this->rechtspersoonDAO->findRechtspersoonByKlantId($klantId);
        }

        $this->renderAction("Pages/profiel", [
            "klant" => $klant,
            "klantDetails" => $klantDetails,
            "gebruiker" => $gebruiker,
            "facturatieAdres" => $facturatieAdres,
            "leveringsAdres" => $leveringsAdres
        ]);
    }

    public function updateProfielAction(): void
    {
        // Check of gebruiker ingelogd is
        $this->requireLogin();

        $gebruiker = $this->getIngelogdeGebruiker();
        $klantId = (int) $gebruiker["klantId"];

        // Haal POST data op
        $voornaam = trim($this->getStringFromPostAction("voornaam"));
        $familienaam = trim($this->getStringFromPostAction("familienaam"));

        // Validatie
        if (empty($voornaam) || empty($familienaam)) {
            $this->redirectAction("profiel", "Vul alle verplichte velden in.");
            return;
        }

        // Update natuurlijk persoon gegevens
        if ($gebruiker["type"] === "natuurlijk_persoon") {
            $result = $this->natuurlijkePersoonDAO->updatePersoon($klantId, $voornaam, $familienaam);
            
            if (null === $result || 0 === $result) {
                $this->redirectAction("profiel", "Kon gegevens niet updaten.");
                return;
            }

            // Update sessie gegevens
            $_SESSION["gebruiker"]["voornaam"] = $voornaam;
            $_SESSION["gebruiker"]["familienaam"] = $familienaam;

            $this->redirectAction("profiel", null, "Profiel succesvol bijgewerkt!");
        } else {
            // Voor rechtspersonen - update bedrijfsgegevens
            $bedrijfsnaam = trim($this->getStringFromPostAction("bedrijfsnaam"));
            $btwNummer = trim($this->getStringFromPostAction("btwNummer"));

            if (empty($bedrijfsnaam) || empty($btwNummer)) {
                $this->redirectAction("profiel", "Vul alle verplichte velden in.");
                return;
            }

            $result = $this->rechtspersoonDAO->updateRechtspersoon($klantId, $bedrijfsnaam, $btwNummer);
            
            if (null === $result || 0 === $result) {
                $this->redirectAction("profiel", "Kon bedrijfsgegevens niet updaten.");
                return;
            }

            // Update sessie gegevens indien aanwezig
            if (isset($_SESSION["gebruiker"]["bedrijfsnaam"])) {
                $_SESSION["gebruiker"]["bedrijfsnaam"] = $bedrijfsnaam;
            }
            if (isset($_SESSION["gebruiker"]["btwNummer"])) {
                $_SESSION["gebruiker"]["btwNummer"] = $btwNummer;
            }

            $this->redirectAction("profiel", null, "Bedrijfsgegevens succesvol bijgewerkt!");
        }
    }

    public function updateAdresAction(): void
    {
        // Check of gebruiker ingelogd is
        $this->requireLogin();

        $gebruiker = $this->getIngelogdeGebruiker();
        $klantId = (int) $gebruiker["klantId"];

        // Bepaal welk adres wordt geupdate
        $adresType = $this->getStringFromPostAction("adresType"); // "facturatie" of "levering"
        
        // Haal adresgegevens op uit POST
        $straat = trim($this->getStringFromPostAction("straat"));
        $huisNummer = trim($this->getStringFromPostAction("huisNummer"));
        $bus = trim($this->getStringFromPostAction("bus"));
        $postcode = trim($this->getStringFromPostAction("postcode"));
        $plaatsNaam = trim($this->getStringFromPostAction("plaats"));

        // Validatie
        if (empty($straat) || empty($huisNummer) || empty($postcode) || empty($plaatsNaam)) {
            $this->redirectAction("profiel", "Vul alle verplichte adresvelden in.");
            return;
        }

        // Zoek plaatsId op basis van postcode en plaatsnaam
        $plaats = $this->plaatsDAO->findByPostcodeAndPlaats($postcode, $plaatsNaam);
        if (null === $plaats) {
            $this->redirectAction("profiel", "Ongeldige postcode.");
            return;
        }

        $klant = $this->klantDAO->findById($klantId);
        if (null === $klant) {
            $this->redirectAction("profiel", "Klant niet gevonden.");
            return;
        }

        // Bepaal welk adresId moet worden geupdate
        $adresId = null;
        if ("facturatie" === $adresType) {
            $adresId = $klant->getFacturatieAdresId();
        } elseif ("levering" === $adresType) {
            $adresId = $klant->getLeveringsAdresId();
        } else {
            $this->redirectAction("profiel", "Ongeldig adres type.");
            return;
        }

        if (null === $adresId) {
            $this->redirectAction("profiel", "Adres niet gevonden.");
            return;
        }

        // Update adres
        $result = $this->adresDAO->updateAdres(
            $adresId,
            $straat,
            $huisNummer,
            empty($bus) ? null : $bus,
            $plaats->getPlaatsId()
        );

        if (null === $result || 0 === $result) {
            $this->redirectAction("profiel", "Kon adres niet updaten.");
            return;
        }

        $adresTypeNaam = ("facturatie" === $adresType) ? "Facturatie" : "Levering";
        $this->redirectAction("profiel", null, "{$adresTypeNaam}adres succesvol bijgewerkt!");
    }

    public function bestellingenAction(): void
    {
        // Check of gebruiker ingelogd is
        $this->requireLogin();

        $gebruiker = $this->getIngelogdeGebruiker();
        $klantId = (int) $gebruiker["klantId"];

        // Haal bestellingen op met alle details via de service
        $bestellingen = $this->bestellingService->getBestellingenMetDetails($klantId);

        $this->renderAction("Pages/bestellingen", [
            "bestellingen" => $bestellingen,
            "gebruiker" => $gebruiker
        ]);
    }

    public function actiecodesAction(): void
    {
        // Check of gebruiker ingelogd is
        $this->requireLogin();

        $gebruiker = $this->getIngelogdeGebruiker();
        $klantId = (int) $gebruiker["klantId"];

        // Haal actiecodes van afgelopen 6 maanden op
        $actiecodes = $this->actiecodeDAO->findActiecodesVanAfgelopenMaanden(6);
        
        // Tel hoeveel bestellingen met actiecodes de klant heeft
        $aantalBestellingenMetActiecodes = $this->bestellingDAO->countBestellingenMetActiecodesByKlantId($klantId);

        $this->renderAction("Pages/actiecodes", [
            "actiecodes" => $actiecodes ?? [],
            "aantalBestellingenMetActiecodes" => $aantalBestellingenMetActiecodes,
            "gebruiker" => $gebruiker
        ]);
    }

    public function deactiveerAccountAction(): void
    {
        // Check of gebruiker ingelogd is
        $this->requireLogin();

        $gebruiker = $this->getIngelogdeGebruiker();
        $gebruikersAccountId = (int) $gebruiker["gebruikersAccountId"];

        // Deactiveer account in database
        $result = $this->gebruikersAccountDAO->deactivateAccount($gebruikersAccountId);

        if (null === $result || 0 === $result) {
            $this->redirectAction("profiel", "Kon account niet deactiveren.");
            return;
        }

        // Vernietig volledige sessie 
        session_unset();
        session_destroy();

        // Start nieuwe sessie voor flash message
        session_start();
        $_SESSION["success"] = "Uw account is succesvol gedeactiveerd.";

        // Redirect naar home
        $this->redirectAction("home");
    }
}
