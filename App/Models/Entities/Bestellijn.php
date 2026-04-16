<?php
// Bestellijn.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Bestellijn
{
    private ?int $bestellijnId = null;
    private int $bestelId;
    private int $artikelId;
    private int $aantalBesteld;
    private int $aantalGeannuleerd = 0;

    public function getBestellijnId(): ?int
    {
        return $this->bestellijnId;
    }

    public function setBestellijnId(?int $bestellijnId): void
    {
        $this->bestellijnId = $bestellijnId;
    }

    public function getBestelId(): int
    {
        return $this->bestelId;
    }

    public function setBestelId(int $bestelId): void
    {
        $this->bestelId = $bestelId;
    }

    public function getArtikelId(): int
    {
        return $this->artikelId;
    }

    public function setArtikelId(int $artikelId): void
    {
        $this->artikelId = $artikelId;
    }

    public function getAantalBesteld(): int
    {
        return $this->aantalBesteld;
    }

    public function setAantalBesteld(int $aantalBesteld): void
    {
        $this->aantalBesteld = $aantalBesteld;
    }

    public function getAantalGeannuleerd(): int
    {
        return $this->aantalGeannuleerd;
    }

    public function setAantalGeannuleerd(int $aantalGeannuleerd): void
    {
        $this->aantalGeannuleerd = $aantalGeannuleerd;
    }

    public function getAantalActief(): int
    {
        return $this->aantalBesteld - $this->aantalGeannuleerd;
    }
}
