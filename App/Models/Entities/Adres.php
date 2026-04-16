<?php
// Adres.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Adres
{
    private ?int $adresId = null;
    private string $straat;
    private string $huisNummer;
    private ?string $bus = null;
    private int $plaatsId;
    private bool $actief = true;
    private ?string $plaatsNaam = null;
    private ?string $postcode = null;

    public function getAdresId(): ?int
    {
        return $this->adresId;
    }

    public function setAdresId(?int $adresId): void
    {
        $this->adresId = $adresId;
    }

    public function getStraat(): string
    {
        return $this->straat;
    }

    public function setStraat(string $straat): void
    {
        $this->straat = $straat;
    }

    public function getHuisNummer(): string
    {
        return $this->huisNummer;
    }

    public function setHuisNummer(string $huisNummer): void
    {
        $this->huisNummer = $huisNummer;
    }

    public function getBus(): ?string
    {
        return $this->bus;
    }

    public function setBus(?string $bus): void
    {
        $this->bus = $bus;
    }

    public function getPlaatsId(): int
    {
        return $this->plaatsId;
    }

    public function setPlaatsId(int $plaatsId): void
    {
        $this->plaatsId = $plaatsId;
    }

    public function isActief(): bool
    {
        return $this->actief;
    }

    public function setActief(bool $actief): void
    {
        $this->actief = $actief;
    }

    public function getPlaatsNaam(): ?string
    {
        return $this->plaatsNaam;
    }

    public function setPlaatsNaam(?string $plaatsNaam): void
    {
        $this->plaatsNaam = $plaatsNaam;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): void
    {
        $this->postcode = $postcode;
    }

    public function getVolledigAdres(): string
    {
        $adres = $this->straat . " " . $this->huisNummer;
        if (null !== $this->bus) $adres .= " bus " . $this->bus;
        if (null !== $this->postcode && null !== $this->plaatsNaam) {
            $adres .= ", " . $this->postcode . " " . $this->plaatsNaam;
        }
        return $adres;
    }
}
