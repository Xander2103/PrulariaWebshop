<?php
// ActiecodeDAO.php - Data Access Object voor Actiecodes

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Actiecode;
use PDO;
use PDOException;
use Config\DBConfig;
use DateTime;

class ActiecodeDAO
{

    private function mapToEntity(array $row): Actiecode
    {
        $geldigVanDatum = isset($row['geldigVanDatum']) ? new DateTime($row['geldigVanDatum']) : null;
        $geldigTotDatum = isset($row['geldigTotDatum']) ? new DateTime($row['geldigTotDatum']) : null;
        
        $actiecode = new Actiecode();
        $actiecode->setActiecodeId(isset($row['actiecodeId']) ? (int) $row['actiecodeId'] : null);
        $actiecode->setNaam($row['naam']);
        $actiecode->setGeldigVanDatum($geldigVanDatum);
        $actiecode->setGeldigTotDatum($geldigTotDatum);
        $actiecode->setIsEenmalig(isset($row['isEenmalig']) ? (bool) $row['isEenmalig'] : false);
        return $actiecode;
    }

    // Zoek actiecode op naam
    public function findByNaam(string $naam): ?Actiecode
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Actiecodes WHERE naam = :naam";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":naam" => $naam]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout in ActiecodeDAO: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal alle geldige actiecodes op

    public function findGeldigeActiecodes(): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Actiecodes 
                    WHERE geldigVanDatum <= NOW() 
                    AND geldigTotDatum >= NOW()
                    ORDER BY geldigTotDatum ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout in ActiecodeDAO: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Check of actiecode geldig is
    public function isGeldig(string $naam): bool
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(*) AS aantal FROM Actiecodes 
                    WHERE naam = :naam 
                    AND geldigVanDatum <= NOW() 
                    AND geldigTotDatum >= NOW()";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":naam" => $naam]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) ($result["aantal"] ?? 0) > 0;
        } catch (PDOException $e) {
            error_log("DB-Fout in ActiecodeDAO: {$e->getMessage()}");
            return false;
        } finally {
            $dbh = null;
        }
    }

    // Verwijder eenmalige actiecode na gebruik
    public function verwijderEenmalige(string $naam): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM Actiecodes WHERE naam = :naam AND isEenmalig = 1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":naam" => $naam]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout in ActiecodeDAO: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal actiecodes van afgelopen X maanden op
    public function findActiecodesVanAfgelopenMaanden(int $aantalMaanden = 6): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Actiecodes 
                    WHERE geldigTotDatum >= DATE_SUB(NOW(), INTERVAL :maanden MONTH)
                    ORDER BY geldigTotDatum DESC, geldigVanDatum DESC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":maanden" => $aantalMaanden]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : [];
        } catch (PDOException $e) {
            error_log("DB-Fout in ActiecodeDAO: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
}
