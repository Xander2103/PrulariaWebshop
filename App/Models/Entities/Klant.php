<?php
// Klant.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Klant
{
    private ?int $klantId = null;
    private ?int $facturatieAdresId = null;
    private ?int $leveringsAdresId = null;

    public function getKlantId(): ?int
    {
        return $this->klantId;
    }

    public function setKlantId(?int $klantId): void
    {
        $this->klantId = $klantId;
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
