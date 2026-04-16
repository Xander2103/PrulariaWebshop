<?php
// KlantReview.php - Entity

declare(strict_types=1);

namespace App\Models\Entities;

use DateTime;

class KlantReview
{
    private ?int $klantenReviewId = null;
    private string $nickname;
    private int $score;
    private ?string $commentaar = null;
    private ?DateTime $datum = null;
    private ?int $bestellijnId = null;

    public function getKlantenReviewId(): ?int
    {
        return $this->klantenReviewId;
    }

    public function setKlantenReviewId(?int $klantenReviewId): void
    {
        $this->klantenReviewId = $klantenReviewId;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getCommentaar(): ?string
    {
        return $this->commentaar;
    }

    public function setCommentaar(?string $commentaar): void
    {
        $this->commentaar = $commentaar;
    }

    public function getDatum(): ?DateTime
    {
        return $this->datum;
    }

    public function setDatum(?DateTime $datum): void
    {
        $this->datum = $datum;
    }

    public function getBestellijnId(): ?int
    {
        return $this->bestellijnId;
    }

    public function setBestellijnId(?int $bestellijnId): void
    {
        $this->bestellijnId = $bestellijnId;
    }
}
