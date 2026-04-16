<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DAOs\KlantReviewDAO;
use PDO;
use PDOException;
use Config\DBConfig;

class ReviewService
{
    private KlantReviewDAO $klantReviewDAO;

    public function __construct()
    {
        $this->klantReviewDAO = new KlantReviewDAO();
    }

    public function getReviewsByArtikelId(int $artikelId): ?array
    {
        if ($artikelId <= 0) {
            return null;
        }

        return $this->klantReviewDAO->findByArtikelId($artikelId);
    }

    public function getAverageScore(int $artikelId): float
    {
        if ($artikelId <= 0) {
            return 0.0;
        }

        return $this->klantReviewDAO->getAverageScoreByArtikel($artikelId);
    }

    public function kanReviewPlaatsen(int $klantId, int $artikelId): bool
    {
        if ($klantId <= 0 || $artikelId <= 0) {
            return false;
        }

        $heeftGekocht = $this->klantReviewDAO->heeftArtikelGekocht($klantId, $artikelId);
        if (!$heeftGekocht) {
            return false;
        }

        $heeftAlGereviewed = $this->klantReviewDAO->heeftArtikelGereviewed($klantId, $artikelId);

        return !$heeftAlGereviewed;
    }

    public function heeftAlGereviewed(int $klantId, int $artikelId): bool
    {
        if ($klantId <= 0 || $artikelId <= 0) {
            return false;
        }

        return $this->klantReviewDAO->heeftArtikelGereviewed($klantId, $artikelId);
    }

    public function heeftArtikelGekocht(int $klantId, int $artikelId): bool
    {
        if ($klantId <= 0 || $artikelId <= 0) {
            return false;
        }

        return $this->klantReviewDAO->heeftArtikelGekocht($klantId, $artikelId);
    }

    public function voegReviewToe(string $nickname, int $score, ?string $commentaar, int $bestellijnId): ?int
    {
        if (empty(trim($nickname)) || $score < 1 || $score > 5 || $bestellijnId <= 0) {
            return null;
        }

        $nickname = trim($nickname);
        $commentaar = ($commentaar !== null && trim($commentaar) !== '') ? trim($commentaar) : null;

        return $this->klantReviewDAO->createReview($nickname, $score, $commentaar, $bestellijnId);
    }

    public function haalBestellijnIdOpVoorReview(int $klantId, int $artikelId): ?int
    {
        if ($klantId <= 0 || $artikelId <= 0) {
            return null;
        }

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT bl.bestellijnId
                    FROM Bestellijnen bl
                    INNER JOIN Bestellingen b ON bl.bestelId = b.bestelId
                    WHERE b.klantId = :klantId
                    AND bl.artikelId = :artikelId
                    AND b.betaald = 1
                    ORDER BY b.besteldatum DESC
                    LIMIT 1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":klantId" => $klantId,
                ":artikelId" => $artikelId,
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ? (int) $result['bestellijnId'] : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
}
