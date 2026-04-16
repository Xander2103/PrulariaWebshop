<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\DAOs\BestellingDAO;
use App\Models\DAOs\BestellijnDAO;
use App\Models\DAOs\BestellingsStatusDAO;
use App\Models\DAOs\KlantDAO;
use App\Models\DAOs\NatuurlijkePersoonDAO;
use App\Models\DAOs\AdresDAO;
use App\Models\DAOs\PlaatsDAO;
use App\Models\DAOs\ArtikelDAO;
use App\Models\DAOs\ActiecodeDAO;
use App\Models\Entities\Bestelling;
use App\Models\Entities\Bestellijn;
use App\Exceptions\InsufficientStockException;

class BestellingService
{
    private BestellingDAO $bestellingDAO;
    private BestellijnDAO $bestellijnDAO;
    private KlantDAO $klantDAO;
    private NatuurlijkePersoonDAO $natuurlijkePersoonDAO;
    private AdresDAO $adresDAO;
    private PlaatsDAO $plaatsDAO;
    private ArtikelDAO $artikelDAO;
    private WinkelmandjeService $winkelmandjeService;
    private ActiecodeDAO $actiecodeDAO;
    private BestellingsStatusDAO $bestellingsStatusDAO;

    public function __construct()
    {
        $this->bestellingDAO = new BestellingDAO();
        $this->bestellijnDAO = new BestellijnDAO();
        $this->klantDAO = new KlantDAO();
        $this->natuurlijkePersoonDAO = new NatuurlijkePersoonDAO();
        $this->adresDAO = new AdresDAO();
        $this->plaatsDAO = new PlaatsDAO();
        $this->artikelDAO = new ArtikelDAO();
        $this->winkelmandjeService = new WinkelmandjeService();
        $this->actiecodeDAO = new ActiecodeDAO();
        $this->bestellingsStatusDAO = new BestellingsStatusDAO();
    }

    public function plaatsBestelling(array $data, ?int $ingelogdeKlantId = null): ?int
    {
        // 0. Valideer voorraad voor alle artikelen
        $winkelmandregels = $this->winkelmandjeService->getWinkelmandregels();
        foreach ($winkelmandregels as $regel) {
            $artikelId = $regel['artikel']->getArtikelId();
            $aantalBesteld = $regel['aantal'];
            $artikelData = $this->artikelDAO->findById($artikelId);

            if (!$artikelData || $artikelData->getVoorraad() < $aantalBesteld) {
                $artikelNaam = $artikelData ? $artikelData->getNaam() : 'Onbekend artikel';
                throw new InsufficientStockException("Onvoldoende voorraad voor artikel: {$artikelNaam}.");
            }
        }

        // 1. Zoek plaatsID op basis van postcode en plaatsnaam. Als niet gevonden, maak nieuwe Plaats aan.
        $bestaandePlaats = $this->plaatsDAO->findByPostcodeAndPlaats($data['postcode'], $data['plaats']);
        if ($bestaandePlaats !== null) {
            $plaatsId = $bestaandePlaats->getPlaatsId();
        } else {
            $plaatsId = $this->plaatsDAO->createPlaats($data['postcode'], $data['plaats']);
            if (!$plaatsId) {
                return null;
            }
        }

        // 2. Leveringsadres aanmaken
        $adresId = $this->adresDAO->createAdres(
            $data['straat'], 
            $data['huisnummer'], 
            $data['bus'] ?? null, 
            $plaatsId
        );

        if (!$adresId) {
            return null; // Fout bij adres creatie
        }

        // 3. Bepaal de KlantId
        $klantId = $ingelogdeKlantId;
        if (!$klantId) {
            // Maak een gloednieuwe Gast-klant aan
            $klantId = $this->klantDAO->createKlant($adresId, $adresId);
            
            // Registreer als Natuurlijke Persoon zonder account (Gast) -> NULL account ID
            $this->natuurlijkePersoonDAO->createPersoon($klantId, $data['voornaam'], $data['familienaam'], null);
        } else {
            // Update evt het leveringsadres voor de bestaande klant 
            $bestaandeKlant = $this->klantDAO->findById($klantId);
            if ($bestaandeKlant !== null) {
               $this->klantDAO->updateAdressen($klantId, $bestaandeKlant->getFacturatieAdresId(), $adresId);
            }
        }

        // 4. Maak de Bestelling aan
        $betaalwijzeId = (int)$data['betaalwijzeId'];

        // Betaalstatus bepalen op basis van betaalwijze
        // Kredietkaart (ID 2) = direct betaald, Overschrijving (ID 3) = nog niet betaald
        if ($betaalwijzeId === 2) {
            $bestellingsStatusId = 2; // Betaald
            $betaald = true;
        } else {
            $bestellingsStatusId = 1; // Lopend
            $betaald = false;
        }

        $bestelId = $this->bestellingDAO->createBestelling(
            $klantId,
            $betaalwijzeId,
            $bestellingsStatusId,
            $data['voornaam'],
            $data['familienaam'],
            $adresId, // Facturatie
            $adresId, // Levering
            $betaald
        );

        if ($bestelId) {
            // 4.5. Actiecode verwerken
            $actiecodeGebruikt = false;
            if (isset($_SESSION['actiecode'])) {
                $code = $_SESSION['actiecode'];
                if ($this->actiecodeDAO->isGeldig($code)) {
                    $actiecodeGebruikt = true;
                    // Eenmalige actiecodes verwijderen na succesvolle bestelling
                    if ($this->actiecodeDAO->findByNaam($code)?->isEenmalig()) {
                        $this->actiecodeDAO->verwijderEenmalige($code);
                    }
                }
            }

            // Update de actiecode status
            if ($actiecodeGebruikt) {
                $this->bestellingDAO->updateActiecodeGebruikt($bestelId, true);
            }

            // 5. Bestellijnen toevoegen op basis van mandje
            foreach ($winkelmandregels as $regel) {
                $artikelId = $regel['artikel']->getArtikelId();
                $aantalBesteld = $regel['aantal'];

                // Als er korting was, zouden de prijzen theoretisch 10% verlaagd moeten zijn.
                // We houden de standaard artikelprijs in dit project aan en verrekenen het als bestellingstotaal-korting,
                // aangezien er geen aparte order_totaal of korting_regel staat gedefinieerd in BestellingDAO.

                // createBestellijn(bestelId, artikelId, aantalBesteld)
                $this->bestellijnDAO->createBestellijn($bestelId, $artikelId, $aantalBesteld);

                // Verminder de voorraad
                $artikelData = $this->artikelDAO->findById($artikelId);
                $nieuweVoorraad = $artikelData->getVoorraad() - $aantalBesteld;
                $this->artikelDAO->updateVoorraad($artikelId, $nieuweVoorraad);
            }

            // 6. Maak winkelmandje en actiecode sessie schoon
            if (isset($_SESSION['winkelmand'])) {
                unset($_SESSION['winkelmand']);
            }
            if (isset($_SESSION['actiecode'])) {
                unset($_SESSION['actiecode']);
            }
            if (isset($_SESSION['actiecode_success'])) unset($_SESSION['actiecode_success']);
            
            return $bestelId;
        }

        return null;
    }


    public function getBestellingenMetDetails(int $klantId): ?array
    {
        // Haal alle bestellingen op voor deze klant
        $bestellingen = $this->bestellingDAO->findByKlantId($klantId);
        
        if (!$bestellingen) {
            return [];
        }

        $bestellingenMetDetails = [];

        foreach ($bestellingen as $bestelling) {
            $bestelId = $bestelling->getBestelId();
            
            // Haal bestellijnen op
            $bestellijnen = $this->bestellijnDAO->findByBestelId($bestelId);
            
            // Bereken totaalbedrag
            $totaalbedrag = 0.0;
            $artikelen = [];
            
            if ($bestellijnen) {
                foreach ($bestellijnen as $bestellijn) {
                    $artikel = $this->artikelDAO->findById($bestellijn->getArtikelId());
                    if ($artikel) {
                        $prijs = $artikel->getPrijs();
                        $aantal = $bestellijn->getAantalBesteld();
                        $subtotaal = $prijs * $aantal;
                        $totaalbedrag += $subtotaal;
                        
                        $artikelen[] = [
                            'naam' => $artikel->getNaam(),
                            'aantal' => $aantal,
                            'prijs' => $prijs,
                            'subtotaal' => $subtotaal
                        ];
                    }
                }
            }

            // Haal status op
            $statusObj = $this->bestellingsStatusDAO->findById($bestelling->getBestellingsStatusId());
            $statusNaam = $statusObj ? $statusObj->getNaam() : 'Onbekend';

            $bestellingenMetDetails[] = [
                'bestelling' => $bestelling,
                'statusNaam' => $statusNaam,
                'totaalbedrag' => $totaalbedrag,
                'artikelen' => $artikelen,
                'aantalArtikelen' => count($artikelen)
            ];
        }

        return $bestellingenMetDetails;
    }
}
