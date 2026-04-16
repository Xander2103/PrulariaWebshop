<?php
// Artikel.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Artikel
{
    private ?int $artikelId = null;
    private ?string $ean = null;
    private string $naam;
    private ?string $beschrijving = null;
    private float $prijs;
    private int $gewichtInGram;
    private int $bestelpeil;
    private int $voorraad;
    private int $minimumVoorraad;
    private int $maximumVoorraad;
    private int $levertijd;
    private int $aantalBesteldLeverancier;
    private int $maxAantalInMagazijnPlaats;
    private ?int $leveranciersId = null;
    private ?array $categorieen = null;
    private ?string $afbeeldingUrl = null;

    public function __construct(
    ?int $artikelId,
    ?string $ean,
    string $naam,
    ?string $beschrijving,
    float $prijs,
    int $gewichtInGram,
    int $bestelpeil,
    int $voorraad,
    int $minimumVoorraad,
    int $maximumVoorraad,
    int $levertijd,
    int $aantalBesteldLeverancier,
    int $maxAantalInMagazijnPlaats,
    ?int $leveranciersId
) {
    $this->artikelId = $artikelId;
    $this->ean = $ean;
    $this->naam = $naam;
    $this->beschrijving = $beschrijving;
    $this->prijs = $prijs;
    $this->gewichtInGram = $gewichtInGram;
    $this->bestelpeil = $bestelpeil;
    $this->voorraad = $voorraad;
    $this->minimumVoorraad = $minimumVoorraad;
    $this->maximumVoorraad = $maximumVoorraad;
    $this->levertijd = $levertijd;
    $this->aantalBesteldLeverancier = $aantalBesteldLeverancier;
    $this->maxAantalInMagazijnPlaats = $maxAantalInMagazijnPlaats;
    $this->leveranciersId = $leveranciersId;
}

    public function getArtikelId(): ?int
    {
        return $this->artikelId;
    }

    public function setArtikelId(?int $artikelId): void
    {
        $this->artikelId = $artikelId;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): void
    {
        $this->ean = $ean;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(?string $beschrijving): void
    {
        $this->beschrijving = $beschrijving;
    }

    public function getPrijs(): float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): void
    {
        $this->prijs = $prijs;
    }

    public function getPrijsInclBtw(): float
    {
        return $this->prijs * 1.21;
    }

    public function getGewichtInGram(): int
    {
        return $this->gewichtInGram;
    }

    public function setGewichtInGram(int $gewichtInGram): void
    {
        $this->gewichtInGram = $gewichtInGram;
    }

    public function getBestelpeil(): int
    {
        return $this->bestelpeil;
    }

    public function setBestelpeil(int $bestelpeil): void
    {
        $this->bestelpeil = $bestelpeil;
    }

    public function getVoorraad(): int
    {
        return $this->voorraad;
    }

    public function setVoorraad(int $voorraad): void
    {
        $this->voorraad = $voorraad;
    }

    public function isOpVoorraad(): bool
    {
        return $this->voorraad > 0;
    }

    public function isLaagVoorraad(): bool
    {
        return $this->voorraad > 0 && $this->voorraad < 6;
    }

    public function getMinimumVoorraad(): int
    {
        return $this->minimumVoorraad;
    }

    public function setMinimumVoorraad(int $minimumVoorraad): void
    {
        $this->minimumVoorraad = $minimumVoorraad;
    }

    public function getMaximumVoorraad(): int
    {
        return $this->maximumVoorraad;
    }

    public function setMaximumVoorraad(int $maximumVoorraad): void
    {
        $this->maximumVoorraad = $maximumVoorraad;
    }

    public function getLevertijd(): int
    {
        return $this->levertijd;
    }

    public function setLevertijd(int $levertijd): void
    {
        $this->levertijd = $levertijd;
    }

    public function getAantalBesteldLeverancier(): int
    {
        return $this->aantalBesteldLeverancier;
    }

    public function setAantalBesteldLeverancier(int $aantalBesteldLeverancier): void
    {
        $this->aantalBesteldLeverancier = $aantalBesteldLeverancier;
    }

    public function getMaxAantalInMagazijnPlaats(): int
    {
        return $this->maxAantalInMagazijnPlaats;
    }

    public function setMaxAantalInMagazijnPlaats(int $maxAantalInMagazijnPlaats): void
    {
        $this->maxAantalInMagazijnPlaats = $maxAantalInMagazijnPlaats;
    }

    public function getLeveranciersId(): ?int
    {
        return $this->leveranciersId;
    }

    public function setLeveranciersId(?int $leveranciersId): void
    {
        $this->leveranciersId = $leveranciersId;
    }

    public function getCategorieen(): ?array
    {
        return $this->categorieen;
    }

    public function setCategorieen(?array $categorieen): void
    {
        $this->categorieen = $categorieen;
    }

    public function getAfbeeldingUrl(): ?string
    {
        return $this->afbeeldingUrl;
    }

    public function setAfbeeldingUrl(?string $afbeeldingUrl): void
    {
        $this->afbeeldingUrl = $afbeeldingUrl;
    }

}
