<?php
// Contactpersoon.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Contactpersoon
{
    private ?int $contactpersoonId = null;
    private string $voornaam;
    private string $familienaam;
    private string $functie;
    private ?int $klantId = null;
    private ?int $gebruikersAccountId = null;

    public function getContactpersoonId(): ?int
    {
        return $this->contactpersoonId;
    }

    public function setContactpersoonId(?int $contactpersoonId): void
    {
        $this->contactpersoonId = $contactpersoonId;
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

    public function getFunctie(): string
    {
        return $this->functie;
    }

    public function setFunctie(string $functie): void
    {
        $this->functie = $functie;
    }

    public function getKlantId(): ?int
    {
        return $this->klantId;
    }

    public function setKlantId(?int $klantId): void
    {
        $this->klantId = $klantId;
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
