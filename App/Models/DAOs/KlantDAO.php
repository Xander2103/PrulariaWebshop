<?php
// KlantDAO.php - Data Access Object voor Klanten

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Klant;
use PDO;
use PDOException;
use Config\DBConfig;

class KlantDAO
{
    private function mapToEntity(array $row): Klant
    {
        $klant = new Klant();
        $klant->setKlantId(isset($row['klantId']) ? (int) $row['klantId'] : null);
        $klant->setFacturatieAdresId(isset($row['facturatieAdresId']) ? (int) $row['facturatieAdresId'] : null);
        $klant->setLeveringsAdresId(isset($row['leveringsAdresId']) ? (int) $row['leveringsAdresId'] : null);
        return $klant;
    }

    // Zoek klant op ID
    public function findById(int $klantId): ?Klant
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Klanten WHERE klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":klantId" => $klantId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Maak nieuwe klant aan
    public function createKlant(?int $facturatieAdresId = null, ?int $leveringsAdresId = null): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Klanten (facturatieAdresId, leveringsAdresId) 
                    VALUES (:facturatieAdresId, :leveringsAdresId)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":facturatieAdresId" => $facturatieAdresId,
                ":leveringsAdresId" => $leveringsAdresId
            ]);
            return (int) $dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Update klant adressen
    public function updateAdressen(int $klantId, ?int $facturatieAdresId, ?int $leveringsAdresId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Klanten 
                    SET facturatieAdresId = :facturatieAdresId, leveringsAdresId = :leveringsAdresId 
                    WHERE klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":facturatieAdresId" => $facturatieAdresId,
                ":leveringsAdresId" => $leveringsAdresId,
                ":klantId" => $klantId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
}