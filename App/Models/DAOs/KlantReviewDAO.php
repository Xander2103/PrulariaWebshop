<?php
// KlantReviewDAO.php - Data Access Object voor Klant Reviews

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\KlantReview;
use PDO;
use PDOException;
use Config\DBConfig;
use DateTime;

class KlantReviewDAO
{
    private function mapToEntity(array $row): KlantReview
    {
        $datum = isset($row['datum']) ? new DateTime($row['datum']) : null;
        
        $review = new KlantReview();
        $review->setKlantenReviewId(isset($row['klantReviewId']) ? (int) $row['klantReviewId'] : null);
        $review->setNickname($row['nickname']);
        $review->setScore((int) $row['score']);
        $review->setCommentaar($row['commentaar'] ?? null);
        $review->setDatum($datum);
        $review->setBestellijnId((int) $row['bestellijnId']);
        
        return $review;
    }

    // Haal reviews op voor een artikel
    public function findByArtikelId(int $artikelId): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT kr.* 
                    FROM KlantenReviews kr
                    INNER JOIN Bestellijnen bl ON kr.bestellijnId = bl.bestellijnId
                    WHERE bl.artikelId = :artikelId
                    ORDER BY kr.datum DESC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":artikelId" => $artikelId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal gemiddelde score voor een artikel
    public function getAverageScoreByArtikel(int $artikelId): float
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT AVG(kr.score) AS gemiddelde
                    FROM KlantenReviews kr
                    INNER JOIN Bestellijnen bl ON kr.bestellijnId = bl.bestellijnId
                    WHERE bl.artikelId = :artikelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":artikelId" => $artikelId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (float) ($result["gemiddelde"] ?? 0.0);
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0.0;
        } finally {
            $dbh = null;
        }
    }

    // Tel aantal reviews voor een artikel
    public function countByArtikel(int $artikelId): int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(*) AS aantal
                    FROM KlantenReviews kr
                    INNER JOIN Bestellijnen bl ON kr.bestellijnId = bl.bestellijnId
                    WHERE bl.artikelId = :artikelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":artikelId" => $artikelId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) ($result["aantal"] ?? 0);
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0;
        } finally {
            $dbh = null;
        }
    }

    // Voeg review toe
    public function createReview(string $nickname, int $score, ?string $commentaar, int $bestellijnId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO KlantenReviews (nickname, score, commentaar, datum, bestellijnId) 
                    VALUES (:nickname, :score, :commentaar, NOW(), :bestellijnId)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":nickname" => $nickname,
                ":score" => $score,
                ":commentaar" => $commentaar,
                ":bestellijnId" => $bestellijnId
            ]);
            return (int) $dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Check of gebruiker al review heeft geschreven voor dit artikel
    public function heeftArtikelGereviewed(int $klantId, int $artikelId): bool
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(*) AS aantal
                    FROM KlantenReviews kr
                    INNER JOIN Bestellijnen bl ON kr.bestellijnId = bl.bestellijnId
                    INNER JOIN Bestellingen b ON bl.bestelId = b.bestelId
                    WHERE b.klantId = :klantId AND bl.artikelId = :artikelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":klantId" => $klantId,
                ":artikelId" => $artikelId
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) ($result["aantal"] ?? 0) > 0;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return false;
        } finally {
            $dbh = null;
        }
    }

    // Check of gebruiker dit artikel heeft gekocht
    public function heeftArtikelGekocht(int $klantId, int $artikelId): bool
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(*) AS aantal
                    FROM Bestellingen b
                    INNER JOIN Bestellijnen bl ON b.bestelId = bl.bestelId
                    WHERE b.klantId = :klantId 
                    AND bl.artikelId = :artikelId 
                    AND b.betaald = 1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":klantId" => $klantId,
                ":artikelId" => $artikelId
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) ($result["aantal"] ?? 0) > 0;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return false;
        } finally {
            $dbh = null;
        }
    }
}
