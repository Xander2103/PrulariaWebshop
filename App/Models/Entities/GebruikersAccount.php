<?php
// GebruikersAccount.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

class GebruikersAccount
{
    private ?int $gebruikersAccountId = null;
    private string $emailadres;
    private string $paswoord;
    private bool $disabled = false;

    public function __construct(?int $gebruikersAccountId, string $emailadres, string $paswoord, bool $disabled = false)
    {
        $this->gebruikersAccountId = $gebruikersAccountId;
        $this->emailadres = $emailadres;
        $this->paswoord = $paswoord;
        $this->disabled = $disabled;
    }

    public function getGebruikersAccountId(): ?int
    {
        return $this->gebruikersAccountId;
    }

    public function setGebruikersAccountId(?int $gebruikersAccountId): void
    {
        $this->gebruikersAccountId = $gebruikersAccountId;
    }

    public function getEmailadres(): string
    {
        return $this->emailadres;
    }

    public function setEmailadres(string $emailadres): void
    {
        $this->emailadres = $emailadres;
    }

    public function getPaswoord(): string
    {
        return $this->paswoord;
    }

    public function setPaswoord(string $paswoord): void
    {
        $this->paswoord = $paswoord;
    }

    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    public function setDisabled(bool $disabled): void
    {
        $this->disabled = $disabled;
    }

    public function isActief(): bool
    {
        return !$this->disabled;
    }
}
