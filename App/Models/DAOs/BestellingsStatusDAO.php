<?php
// BestellingsStatusDAO.php - Data Access Object voor Bestellingsstatussen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\BestellingsStatus;
use PDO;
use PDOException;
use Config\DBConfig;

class BestellingsStatusDAO
{
    private function mapToEntity(array $row): BestellingsStatus
    {
        $status = new BestellingsStatus();
        $status->setBestellingsStatusId((int) $row['bestellingsStatusId']);
        $status->setNaam($row['naam']);
        return $status;
    }

    // Haal alle bestellingsstatussen op
    public function findAll(): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM BestellingsStatussen ORDER BY naam ASC";
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

    // Zoek bestellingsstatus op ID
    public function findById(int $bestellingsStatusId): ?BestellingsStatus
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM BestellingsStatussen WHERE bestellingsStatusId = :bestellingsStatusId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":bestellingsStatusId" => $bestellingsStatusId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Zoek bestellingsstatus op naam
    public function findByNaam(string $naam): ?BestellingsStatus
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM BestellingsStatussen WHERE naam = :naam";
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
