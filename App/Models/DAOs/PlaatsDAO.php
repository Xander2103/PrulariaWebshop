<?php
// PlaatsDAO.php - Data Access Object voor Plaatsen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Plaats;
use PDO;
use PDOException;
use Config\DBConfig;

class PlaatsDAO
{
    private function mapToEntity(array $row): Plaats
    {
        $plaats = new Plaats();
        $plaats->setPlaatsId((int) $row['plaatsId']);
        $plaats->setPostcode($row['postcode']);
        $plaats->setPlaats($row['plaats']);
        return $plaats;
    }

    // Zoek plaats op ID
    public function findById(int $plaatsId): ?Plaats
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Plaatsen WHERE plaatsId = :plaatsId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":plaatsId" => $plaatsId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Zoek plaats op postcode en plaatsnaam
    public function findByPostcodeAndPlaats(string $postcode, string $plaats): ?Plaats
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Plaatsen WHERE postcode = :postcode AND LOWER(plaats) = LOWER(:plaats)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":postcode" => $postcode, ":plaats" => $plaats]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Zoek plaatsen op naam
    public function searchByPlaatsNaam(string $plaatsNaam): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $searchPattern = "%" . $plaatsNaam . "%";
            
            $sql = "SELECT * FROM Plaatsen 
                    WHERE LOWER(plaats) LIKE LOWER(:plaatsNaam)
                    ORDER BY plaats ASC
                    LIMIT 20";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":plaatsNaam" => $searchPattern]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal alle plaatsen op
    public function findAll(): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Plaatsen ORDER BY postcode ASC";
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

    // Maak nieuwe plaats aan
    public function createPlaats(string $postcode, string $plaats): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Plaatsen (postcode, plaats) VALUES (:postcode, :plaats)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":postcode" => $postcode,
                ":plaats" => $plaats
            ]);
            return (int) $dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
}
