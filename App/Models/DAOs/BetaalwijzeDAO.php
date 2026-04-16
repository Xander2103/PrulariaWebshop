<?php
// BetaalwijzeDAO.php - Data Access Object voor Betaalwijzes

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Betaalwijze;
use PDO;
use PDOException;
use Config\DBConfig;

class BetaalwijzeDAO
{
    private function mapToEntity(array $row): Betaalwijze
    {
        $betaalwijze = new Betaalwijze();
        $betaalwijze->setBetaalwijzeId((int) $row['betaalwijzeId']);
        $betaalwijze->setNaam($row['naam']);
        return $betaalwijze;
    }

    // Haal alle selecteerbare betaalwijzes op (exclusief 'Niet betaald')
    public function findAll(): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Betaalwijzes WHERE naam != 'Niet betaald' ORDER BY naam ASC";
            $stmt = $dbh->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Zoek betaalwijze op ID
    public function findById(int $betaalwijzeId): ?Betaalwijze
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Betaalwijzes WHERE betaalwijzeId = :betaalwijzeId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":betaalwijzeId" => $betaalwijzeId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Zoek betaalwijze op naam
    public function findByNaam(string $naam): ?Betaalwijze
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Betaalwijzes WHERE naam = :naam";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":naam" => $naam]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
}
