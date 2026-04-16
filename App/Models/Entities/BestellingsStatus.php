<?php
// BestellingsStatus.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class BestellingsStatus
{
    private ?int $bestellingsStatusId = null;
    private string $naam;

    public function getBestellingsStatusId(): ?int
    {
        return $this->bestellingsStatusId;
    }

    public function setBestellingsStatusId(?int $bestellingsStatusId): void
    {
        $this->bestellingsStatusId = $bestellingsStatusId;
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
