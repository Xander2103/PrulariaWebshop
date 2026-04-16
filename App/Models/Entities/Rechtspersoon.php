<?php
// Rechtspersoon.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Rechtspersoon
{
    private ?int $klantId = null;
    private string $naam;
    private string $btwNummer;

    public function getKlantId(): ?int
    {
        return $this->klantId;
    }

    public function setKlantId(?int $klantId): void
    {
        $this->klantId = $klantId;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    public function getBtwNummer(): string
    {
        return $this->btwNummer;
    }

    public function setBtwNummer(string $btwNummer): void
    {
        $this->btwNummer = $btwNummer;
    }
}
