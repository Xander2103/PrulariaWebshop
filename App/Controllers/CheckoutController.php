<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\WinkelmandjeService;
use App\Services\AuthenticatieService;
use App\Services\BestellingService;
use App\Models\DAOs\BetaalwijzeDAO;
use App\Models\DAOs\NatuurlijkePersoonDAO;
use App\Models\DAOs\AdresDAO;
use App\Models\DAOs\PlaatsDAO;
use App\Exceptions\InsufficientStockException;

class CheckoutController extends BaseController
{
    public function startAction(): void
    {
        $winkelmandjeService = new WinkelmandjeService();
        $authService = new AuthenticatieService();
        $betaalwijzeDAO = new BetaalwijzeDAO();

        $winkelmandregels = $winkelmandjeService->getWinkelmandregels();
        if (empty($winkelmandregels)) {
            header('Location: index.php?action=winkelmandje');
            exit;
        }

        $isLoggedIn = $authService->isAuthenticated();
        $persoon = null;
        $adres = null;
        $plaats = null;

        if ($isLoggedIn) {
            $gebruiker = $_SESSION['gebruiker'] ?? null;
            if ($gebruiker && isset($gebruiker['klantId'])) {
                // Haal klantgegevens op
                $klantDAO = new \App\Models\DAOs\KlantDAO();
                $klant = $klantDAO->findById((int)$gebruiker['klantId']);
                
                // Haal persoonlijke gegevens op
                if ($gebruiker['type'] === 'natuurlijk_persoon') {
                    $npDAO = new NatuurlijkePersoonDAO();
                    $persoon = $npDAO->findByKlantId((int)$gebruiker['klantId']);
                } else {
                    // Voor rechtspersoon, maak een object met de contactpersoongegevens
                    $persoon = new class($gebruiker['voornaam'], $gebruiker['familienaam']) {
                        private string $voornaam;
                        private string $familienaam;
                        
                        public function __construct(string $voornaam, string $familienaam) {
                            $this->voornaam = $voornaam;
                            $this->familienaam = $familienaam;
                        }
                        
                        public function getVoornaam(): string { return $this->voornaam; }
                        public function getFamilienaam(): string { return $this->familienaam; }
                    };
                }
                
                // Haal leveringsadres op via klant
                if ($klant && $klant->getLeveringsAdresId()) {
                    $adresDAO = new AdresDAO();
                    $adres = $adresDAO->findById($klant->getLeveringsAdresId());
                    if ($adres) {
                        $plaatsDAO = new PlaatsDAO();
                        $plaats = $plaatsDAO->findById($adres->getPlaatsId());
                    }
                }
            }
        }

        $betaalwijzes = $betaalwijzeDAO->findAll();
        $totaalPrijs = $winkelmandjeService->getTotaalPrijs();
        $korting = 0.0;

        if (isset($_SESSION['actiecode'])) {
            $korting = $totaalPrijs * 0.10; // 10% korting
            $totaalPrijs -= $korting;
        }

        $errors = $_SESSION['checkout_errors'] ?? [];
        unset($_SESSION['checkout_errors']);

        $subLayout = __DIR__ . '/../Views/Pages/checkout.php';
        require_once __DIR__ . '/../Views/Template/layout.php';
    }

    public function processAction(): void
    {
        $authService = new AuthenticatieService();
        $winkelmandjeService = new WinkelmandjeService();

        if (empty($winkelmandjeService->getWinkelmandregels())) {
            header('Location: index.php?action=winkelmandje');
            exit;
        }

        $data = [
            'voornaam' => trim($_POST['voornaam'] ?? ''),
            'familienaam' => trim($_POST['familienaam'] ?? ''),
            'straat' => trim($_POST['straat'] ?? ''),
            'huisnummer' => trim($_POST['huisnummer'] ?? ''),
            'bus' => trim($_POST['bus'] ?? '') ?: null,
            'postcode' => trim($_POST['postcode'] ?? ''),
            'plaats' => trim($_POST['plaats'] ?? ''),
            'betaalwijzeId' => $_POST['betaalwijzeId'] ?? null,
            'email' => trim($_POST['email'] ?? '')
        ];

        $errors = [];
        if (empty($data['voornaam'])) $errors[] = 'Voornaam is verplicht.';
        if (empty($data['familienaam'])) $errors[] = 'Familienaam is verplicht.';
        if (empty($data['straat'])) $errors[] = 'Straat is verplicht.';
        if (empty($data['huisnummer'])) $errors[] = 'Huisnummer is verplicht.';
        if (empty($data['postcode'])) $errors[] = 'Postcode is verplicht.';
        if (empty($data['plaats'])) $errors[] = 'Plaats is verplicht.';
        if (empty($data['betaalwijzeId'])) $errors[] = 'Kies een betaalwijze.';
        if (!$authService->isAuthenticated() && empty($data['email'])) {
            $errors[] = 'E-mailadres is verplicht voor gasten.';
        }

        if (!empty($errors)) {
            $_SESSION['checkout_errors'] = $errors;
            header('Location: index.php?action=checkout');
            exit;
        }

        // Als gast een account wil aanmaken: bewaar data in sessie en registreer eerst.
        // De bestelling wordt NA registratie geplaatst met het echte klantId.
        if (isset($_POST['create_account']) && !$authService->isAuthenticated()) {
            $_SESSION['register_email'] = $data['email'];
            $_SESSION['checkout_data'] = $data;
            $_SESSION['checkout_prefill'] = [
                'voornaam'    => $data['voornaam'],
                'familienaam' => $data['familienaam'],
                'email'       => $data['email'],
                'straat'      => $data['straat'],
                'huisnummer'  => $data['huisnummer'],
                'bus'         => $data['bus'] ?? '',
                'postcode'    => $data['postcode'],
                'plaats'      => $data['plaats'],
            ];
            header('Location: index.php?action=registratieformulier');
            exit;
        }

        $bestellingService = new BestellingService();
        $ingelogdeKlantId = null;
        if ($authService->isAuthenticated() && isset($_SESSION['gebruiker']['klantId'])) {
            $ingelogdeKlantId = (int)$_SESSION['gebruiker']['klantId'];
        }

        try {
            $bestelId = $bestellingService->plaatsBestelling($data, $ingelogdeKlantId);
        } catch (InsufficientStockException $e) {
            $_SESSION['checkout_errors'][] = $e->getMessage();
            header('Location: index.php?action=checkout');
            exit;
        }

        if ($bestelId) {
            header('Location: index.php?action=bedankt&order=' . $bestelId);
            exit;
        } else {
            $_SESSION['checkout_errors'] = ['Er is een probleem opgetreden bij het plaatsen van uw bestelling. Controleer uw gegevens of de postcode klopt.'];
            header('Location: index.php?action=checkout');
            exit;
        }
    }

    public function bedanktAction(): void
    {
        $orderId = filter_input(INPUT_GET, 'order', FILTER_VALIDATE_INT);
        $bestelling = null;
        $bestellijnDetails = [];
        $totaalPrijs = 0.0;
        $leverdatum = null;

        if ($orderId && $orderId > 0) {
            $bestellingDAO = new \App\Models\DAOs\BestellingDAO();
            $bestellijnDAO = new \App\Models\DAOs\BestellijnDAO();
            $artikelDAO = new \App\Models\DAOs\ArtikelDAO();

            $bestelling = $bestellingDAO->findById($orderId);
            $bestellijnen = $bestellijnDAO->findByBestelId($orderId);

            if ($bestellijnen) {
                foreach ($bestellijnen as $lijn) {
                    $artikel = $artikelDAO->findById($lijn->getArtikelId());
                    $prijs = $artikel ? $artikel->getPrijs() : 0.0;
                    $totaalPrijs += $prijs * $lijn->getAantalBesteld();
                    $bestellijnDetails[] = ['lijn' => $lijn, 'artikel' => $artikel];
                }
                if ($bestelling && $bestelling->isActiecodeGebruikt()) {
                    $totaalPrijs *= 0.90;
                }
            }

            $leverdatum = (new \DateTime())->modify('+1 day');
        }

        $subLayout = __DIR__ . '/../Views/Pages/bedankt.php';
        require_once __DIR__ . '/../Views/Template/layout.php';
    }
}
