<?php
// Categorie.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Categorie
{
    private ?int $categorieId = null;
    private string $naam;
    private ?int $hoofdCategorieId = null;
    private ?array $subcategorieen = null;
    private int $aantalArtikelen = 0;

    public function __construct(?int $categorieId, string $naam, ?int $hoofdCategorieId = null)
    {
        $this->categorieId = $categorieId;
        $this->naam = $naam;
        $this->hoofdCategorieId = $hoofdCategorieId;
    }

    public function getCategorieId(): ?int
    {
        return $this->categorieId;
    }

    public function setCategorieId(?int $categorieId): void
    {
        $this->categorieId = $categorieId;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    public function getHoofdCategorieId(): ?int
    {
        return $this->hoofdCategorieId;
    }

    public function setHoofdCategorieId(?int $hoofdCategorieId): void
    {
        $this->hoofdCategorieId = $hoofdCategorieId;
    }

    public function isHoofdCategorie(): bool
    {
        return null === $this->hoofdCategorieId;
    }

    public function isSubcategorie(): bool
    {
        return null !== $this->hoofdCategorieId;
    }

    public function getSubcategorieen(): ?array
    {
        return $this->subcategorieen;
    }

    public function setSubcategorieen(?array $subcategorieen): void
    {
        $this->subcategorieen = $subcategorieen;
    }

    public function heeftSubcategorieen(): bool
    {
        return null !== $this->subcategorieen && count($this->subcategorieen) > 0;
    }

    public function getAantalArtikelen(): int
    {
        return $this->aantalArtikelen;
    }

    public function setAantalArtikelen(int $aantalArtikelen): void
    {
        $this->aantalArtikelen = $aantalArtikelen;
    }
}
