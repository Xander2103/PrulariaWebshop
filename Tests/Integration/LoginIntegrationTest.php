<?php
// LoginIntegrationTest.php - Integratietest voor login flow

declare(strict_types=1);

// Bootstrap de applicatie
require_once __DIR__ . '/../../bootstrap.php';

use App\Services\AuthenticatieService;
use App\Models\DAOs\GebruikersAccountDAO;
use App\Models\DAOs\NatuurlijkePersoonDAO;
use App\Models\DAOs\ContactpersoonDAO;
use App\Models\DAOs\KlantDAO;

echo "=== LOGIN INTEGRATION TEST ===\n\n";

// Test credentials
$testEmail = "ad.ministrateur@vdab.be";
$testPassword = "KlantVanPrularia";

echo "Test 1: GebruikersAccountDAO - Zoek gebruiker op email\n";
echo "---------------------------------------------------\n";
$gebruikersAccountDAO = new GebruikersAccountDAO();
$gebruiker = $gebruikersAccountDAO->findByEmail($testEmail);

if ($gebruiker === null) {
    echo "❌ FAILED: Geen gebruiker gevonden met email: {$testEmail}\n";
    exit(1);
}

echo "✓ Gebruiker gevonden:\n";
echo "  - Email: " . $gebruiker->getEmailadres() . "\n";
echo "  - Account ID: " . $gebruiker->getGebruikersAccountId() . "\n";
echo "  - Paswoord hash: " . substr($gebruiker->getPaswoord(), 0, 20) . "...\n";
echo "  - Type: " . get_class($gebruiker) . "\n\n";

echo "Test 2: NatuurlijkePersoonDAO - Haal persoonlijke gegevens op\n";
echo "------------------------------------------------------------\n";
$natuurlijkePersoonDAO = new NatuurlijkePersoonDAO();
$natuurlijkePersoon = $natuurlijkePersoonDAO->findByGebruikersAccountId($gebruiker->getGebruikersAccountId());

if ($natuurlijkePersoon === null) {
    echo "⚠ Geen natuurlijk persoon gevonden, probeer contactpersoon...\n";
    
    echo "\nTest 2b: ContactpersoonDAO - Haal contactpersoon op\n";
    echo "---------------------------------------------------\n";
    $contactpersoonDAO = new ContactpersoonDAO();
    $contactpersoon = $contactpersoonDAO->findByGebruikersAccountId($gebruiker->getGebruikersAccountId());
    
    if ($contactpersoon === null) {
        echo "❌ FAILED: Geen natuurlijk persoon of contactpersoon gevonden\n";
        exit(1);
    }
    
    echo "✓ Contactpersoon gevonden:\n";
    echo "  - Voornaam: " . $contactpersoon->getVoornaam() . "\n";
    echo "  - Familienaam: " . $contactpersoon->getFamilienaam() . "\n";
    echo "  - Functie: " . $contactpersoon->getFunctie() . "\n";
    echo "  - Klant ID: " . $contactpersoon->getKlantId() . "\n";
    echo "  - Type: " . get_class($contactpersoon) . "\n\n";
    
    $klantId = $contactpersoon->getKlantId();
} else {
    echo "✓ Natuurlijk persoon gevonden:\n";
    echo "  - Voornaam: " . $natuurlijkePersoon->getVoornaam() . "\n";
    echo "  - Familienaam: " . $natuurlijkePersoon->getFamilienaam() . "\n";
    echo "  - Geboortedatum: " . $natuurlijkePersoon->getGeboortedatum()->format('Y-m-d') . "\n";
    echo "  - Klant ID: " . $natuurlijkePersoon->getKlantId() . "\n";
    echo "  - Type: " . get_class($natuurlijkePersoon) . "\n\n";
    
    $klantId = $natuurlijkePersoon->getKlantId();
}

echo "Test 3: KlantDAO - Haal klantgegevens op\n";
echo "----------------------------------------\n";
$klantDAO = new KlantDAO();
$klant = $klantDAO->findById($klantId);

if ($klant === null) {
    echo "❌ FAILED: Geen klant gevonden met ID: {$klantId}\n";
    exit(1);
}

echo "✓ Klant gevonden:\n";
echo "  - Klant ID: " . $klant->getKlantId() . "\n";
echo "  - Facturatie Adres ID: " . $klant->getFacturatieAdresId() . "\n";
echo "  - Levering Adres ID: " . $klant->getLeveringsAdresId() . "\n";
echo "  - Type: " . get_class($klant) . "\n\n";

echo "Test 4: AuthenticatieService - Test login methode\n";
echo "--------------------------------------------------\n";

// Start een sessie voor de test
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$authService = new AuthenticatieService();
$loginSuccess = $authService->login($testEmail, $testPassword);

if (!$loginSuccess) {
    echo "❌ FAILED: Login niet succesvol\n";
    echo "Session data:\n";
    print_r($_SESSION);
    exit(1);
}

echo "✓ Login succesvol!\n";
echo "  - Session gebruiker:\n";
if (isset($_SESSION['gebruiker'])) {
    foreach ($_SESSION['gebruiker'] as $key => $value) {
        if (is_object($value) && method_exists($value, 'format')) {
            echo "    - {$key}: " . $value->format('Y-m-d') . "\n";
        } elseif (!is_array($value) && !is_object($value)) {
            echo "    - {$key}: {$value}\n";
        } else {
            echo "    - {$key}: " . gettype($value) . "\n";
        }
    }
}
echo "\n";

echo "Test 5: Controleer authenticatie status\n";
echo "----------------------------------------\n";
if ($authService->isAuthenticated()) {
    echo "✓ Gebruiker is geauthenticeerd\n\n";
} else {
    echo "❌ FAILED: Gebruiker is niet geauthenticeerd na login\n";
    exit(1);
}

echo "=== ALLE TESTS GESLAAGD ===\n";
echo "De login flow werkt correct met entity objects!\n";
