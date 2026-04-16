<?php
// BestellijnDAO.php - Data Access Object voor Bestellijnen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Bestellijn;
use PDO;
use PDOException;
use Config\DBConfig;

class BestellijnDAO
{

    private function mapToEntity(array $row): Bestellijn
    {
        $bestellijn = new Bestellijn();
        $bestellijn->setBestellijnId(isset($row['bestellijnId']) ? (int) $row['bestellijnId'] : null);
        $bestellijn->setBestelId((int) $row['bestelId']);
        $bestellijn->setArtikelId((int) $row['artikelId']);
        $bestellijn->setAantalBesteld((int) $row['aantalBesteld']);
        $bestellijn->setAantalGeannuleerd((int) $row['aantalGeannuleerd']);
        return $bestellijn;
    }

    // Haal alle bestellijnen op voor een bestelling
    public function findByBestelId(int $bestelId): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT bl.*, a.naam AS artikelNaam, a.prijs AS artikelPrijs
                    FROM Bestellijnen bl
                    INNER JOIN Artikelen a ON bl.artikelId = a.artikelId
                    WHERE bl.bestelId = :bestelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":bestelId" => $bestelId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Voeg bestellijn toe
    public function createBestellijn(int $bestelId, int $artikelId, int $aantalBesteld): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Bestellijnen (bestelId, artikelId, aantalBesteld, aantalGeannuleerd) 
                    VALUES (:bestelId, :artikelId, :aantalBesteld, 0)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":bestelId" => $bestelId,
                ":artikelId" => $artikelId,
                ":aantalBesteld" => $aantalBesteld
            ]);
            return (int) $dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Update aantal besteld
    public function updateAantal(int $bestellijnId, int $aantalBesteld): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Bestellijnen 
                    SET aantalBesteld = :aantalBesteld 
                    WHERE bestellijnId = :bestellijnId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":aantalBesteld" => $aantalBesteld,
                ":bestellijnId" => $bestellijnId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Annuleer (deel van) bestellijn
    public function annuleer(int $bestellijnId, int $aantalGeannuleerd): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Bestellijnen 
                    SET aantalGeannuleerd = :aantalGeannuleerd 
                    WHERE bestellijnId = :bestellijnId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":aantalGeannuleerd" => $aantalGeannuleerd,
                ":bestellijnId" => $bestellijnId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Verwijder bestellijn
    public function deleteBestellijn(int $bestellijnId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM Bestellijnen WHERE bestellijnId = :bestellijnId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":bestellijnId" => $bestellijnId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
}
