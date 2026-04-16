<?php
// Actiecode.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

use DateTime;

class Actiecode
{
    private ?int $actiecodeId = null;
    private string $naam;
    private DateTime $geldigVanDatum;
    private DateTime $geldigTotDatum;
    private bool $isEenmalig;

    public function getActiecodeId(): ?int
    {
        return $this->actiecodeId;
    }

    public function setActiecodeId(?int $actiecodeId): void
    {
        $this->actiecodeId = $actiecodeId;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    public function getGeldigVanDatum(): DateTime
    {
        return $this->geldigVanDatum;
    }

    public function setGeldigVanDatum(DateTime $geldigVanDatum): void
    {
        $this->geldigVanDatum = $geldigVanDatum;
    }

    public function getGeldigTotDatum(): DateTime
    {
        return $this->geldigTotDatum;
    }

    public function setGeldigTotDatum(DateTime $geldigTotDatum): void
    {
        $this->geldigTotDatum = $geldigTotDatum;
    }

    public function isEenmalig(): bool
    {
        return $this->isEenmalig;
    }

    public function setIsEenmalig(bool $isEenmalig): void
    {
        $this->isEenmalig = $isEenmalig;
    }

    public function isGeldig(): bool
    {
        $now = new DateTime();
        return $now >= $this->geldigVanDatum && $now <= $this->geldigTotDatum;
    }
}
