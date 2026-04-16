<?php
// Betaalwijze.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Betaalwijze
{
    private ?int $betaalwijzeId = null;
    private string $naam;

    public function getBetaalwijzeId(): ?int
    {
        return $this->betaalwijzeId;
    }

    public function setBetaalwijzeId(?int $betaalwijzeId): void
    {
        $this->betaalwijzeId = $betaalwijzeId;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }
}
