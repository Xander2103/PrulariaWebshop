<?php
// Plaats.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class Plaats
{
    private ?int $plaatsId = null;
    private string $postcode;
    private string $plaats;

    public function getPlaatsId(): ?int
    {
        return $this->plaatsId;
    }

    public function setPlaatsId(?int $plaatsId): void
    {
        $this->plaatsId = $plaatsId;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): void
    {
        $this->postcode = $postcode;
    }

    public function getPlaats(): string
    {
        return $this->plaats;
    }

    public function setPlaats(string $plaats): void
    {
        $this->plaats = $plaats;
    }

    public function getVolledigeNaam(): string
    {
        return $this->postcode . " " . $this->plaats;
    }
}
