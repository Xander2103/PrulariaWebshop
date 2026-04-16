<?php
// Bestelling.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

use DateTime;

class Bestelling
{
    private ?int $bestelId = null;
    private ?DateTime $besteldatum = null;
    private int $klantId;
    private bool $betaald = false;
    private ?string $betalingscode = null;
    private ?int $betaalwijzeId = null;
    private bool $annulatie = false;
    private ?DateTime $annulatiedatum = null;
    private ?string $terugbetalingscode = null;
    private ?int $bestellingsStatusId = null;
    private bool $actiecodeGebruikt = false;
    private ?string $bedrijfsnaam = null;
    private ?string $btwNummer = null;
    private ?string $voornaam = null;
    private ?string $familienaam = null;
    private ?int $facturatieAdresId = null;
    private ?int $leveringsAdresId = null;

    public function getBestelId(): ?int
    {
        return $this->bestelId;
    }

    public function setBestelId(?int $bestelId): void
    {
        $this->bestelId = $bestelId;
    }

    public function getBesteldatum(): ?DateTime
    {
        return $this->besteldatum;
    }

    public function setBesteldatum(?DateTime $besteldatum): void
    {
        $this->besteldatum = $besteldatum;
    }

    public function getKlantId(): int
    {
        return $this->klantId;
    }

    public function setKlantId(int $klantId): void
    {
        $this->klantId = $klantId;
    }

    public function isBetaald(): bool
    {
        return $this->betaald;
    }

    public function setBetaald(bool $betaald): void
    {
        $this->betaald = $betaald;
    }

    public function getBetalingscode(): ?string
    {
        return $this->betalingscode;
    }

    public function setBetalingscode(?string $betalingscode): void
    {
        $this->betalingscode = $betalingscode;
    }

    public function getBetaalwijzeId(): ?int
    {
        return $this->betaalwijzeId;
    }

    public function setBetaalwijzeId(?int $betaalwijzeId): void
    {
        $this->betaalwijzeId = $betaalwijzeId;
    }

    public function isAnnulatie(): bool
    {
        return $this->annulatie;
    }

    public function setAnnulatie(bool $annulatie): void
    {
        $this->annulatie = $annulatie;
    }

    public function getAnnulatiedatum(): ?DateTime
    {
        return $this->annulatiedatum;
    }

    public function setAnnulatiedatum(?DateTime $annulatiedatum): void
    {
        $this->annulatiedatum = $annulatiedatum;
    }

    public function getTerugbetalingscode(): ?string
    {
        return $this->terugbetalingscode;
    }

    public function setTerugbetalingscode(?string $terugbetalingscode): void
    {
        $this->terugbetalingscode = $terugbetalingscode;
    }

    public function getBestellingsStatusId(): ?int
    {
        return $this->bestellingsStatusId;
    }

    public function setBestellingsStatusId(?int $bestellingsStatusId): void
    {
        $this->bestellingsStatusId = $bestellingsStatusId;
    }

    public function isActiecodeGebruikt(): bool
    {
        return $this->actiecodeGebruikt;
    }

    public function setActiecodeGebruikt(bool $actiecodeGebruikt): void
    {
        $this->actiecodeGebruikt = $actiecodeGebruikt;
    }

    public function getBedrijfsnaam(): ?string
    {
        return $this->bedrijfsnaam;
    }

    public function setBedrijfsnaam(?string $bedrijfsnaam): void
    {
        $this->bedrijfsnaam = $bedrijfsnaam;
    }

    public function getBtwNummer(): ?string
    {
        return $this->btwNummer;
    }

    public function setBtwNummer(?string $btwNummer): void
    {
        $this->btwNummer = $btwNummer;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(?string $voornaam): void
    {
        $this->voornaam = $voornaam;
    }

    public function getFamilienaam(): ?string
    {
        return $this->familienaam;
    }

    public function setFamilienaam(?string $familienaam): void
    {
        $this->familienaam = $familienaam;
    }

    public function getFacturatieAdresId(): ?int
    {
        return $this->facturatieAdresId;
    }

    public function setFacturatieAdresId(?int $facturatieAdresId): void
    {
        $this->facturatieAdresId = $facturatieAdresId;
    }

    public function getLeveringsAdresId(): ?int
    {
        return $this->leveringsAdresId;
    }

    public function setLeveringsAdresId(?int $leveringsAdresId): void
    {
        $this->leveringsAdresId = $leveringsAdresId;
    }
}
