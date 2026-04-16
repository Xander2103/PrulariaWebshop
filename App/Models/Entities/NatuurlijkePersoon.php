<?php
// NatuurlijkePersoon.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class NatuurlijkePersoon
{
    private ?int $klantId = null;
    private string $voornaam;
    private string $familienaam;
    private ?int $gebruikersAccountId = null;

    public function getKlantId(): ?int
    {
        return $this->klantId;
    }

    public function setKlantId(?int $klantId): void
    {
        $this->klantId = $klantId;
    }

    public function getVoornaam(): string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): void
    {
        $this->voornaam = $voornaam;
    }

    public function getFamilienaam(): string
    {
        return $this->familienaam;
    }

    public function setFamilienaam(string $familienaam): void
    {
        $this->familienaam = $familienaam;
    }

    public function getGebruikersAccountId(): ?int
    {
        return $this->gebruikersAccountId;
    }

    public function setGebruikersAccountId(?int $gebruikersAccountId): void
    {
        $this->gebruikersAccountId = $gebruikersAccountId;
    }

    public function getVolledigeNaam(): string
    {
        return $this->voornaam . " " . $this->familienaam;
    }
}
