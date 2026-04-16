<?php

declare(strict_types=1);

namespace App\Models\Entities;

use DateTime;

class WishlistItem
{
    private ?int $wishlistItemId;
    private int $gebruikersAccountId;
    private int $artikelId;
    private ?DateTime $aanvraagDatum;
    private int $aantal;
    private ?DateTime $emailGestuurdDatum;

    public function __construct(
        ?int $wishlistItemId,
        int $gebruikersAccountId,
        int $artikelId,
        ?DateTime $aanvraagDatum = null,
        int $aantal = 1,
        ?DateTime $emailGestuurdDatum = null
    ) {
        $this->wishlistItemId = $wishlistItemId;
        $this->gebruikersAccountId = $gebruikersAccountId;
        $this->artikelId = $artikelId;
        $this->aanvraagDatum = $aanvraagDatum;
        $this->aantal = $aantal;
        $this->emailGestuurdDatum = $emailGestuurdDatum;
    }

    public function getWishlistItemId(): ?int
    {
        return $this->wishlistItemId;
    }

    public function setWishlistItemId(?int $wishlistItemId): void
    {
        $this->wishlistItemId = $wishlistItemId;
    }

    public function getGebruikersAccountId(): int
    {
        return $this->gebruikersAccountId;
    }

    public function setGebruikersAccountId(int $gebruikersAccountId): void
    {
        $this->gebruikersAccountId = $gebruikersAccountId;
    }

    public function getArtikelId(): int
    {
        return $this->artikelId;
    }

    public function setArtikelId(int $artikelId): void
    {
        $this->artikelId = $artikelId;
    }

    public function getAanvraagDatum(): ?DateTime
    {
        return $this->aanvraagDatum;
    }

    public function setAanvraagDatum(?DateTime $aanvraagDatum): void
    {
        $this->aanvraagDatum = $aanvraagDatum;
    }

    public function getAantal(): int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): void
    {
        $this->aantal = $aantal;
    }

    public function getEmailGestuurdDatum(): ?DateTime
    {
        return $this->emailGestuurdDatum;
    }

    public function setEmailGestuurdDatum(?DateTime $emailGestuurdDatum): void
    {
        $this->emailGestuurdDatum = $emailGestuurdDatum;
    }
}
