<?php
// AdresDAO.php - Data Access Object voor Adressen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Adres;
use PDO;
use PDOException;
use Config\DBConfig;

class AdresDAO
{
    private function mapToEntity(array $row): Adres
    {
        $adres = new Adres();
        $adres->setAdresId(isset($row['adresId']) ? (int) $row['adresId'] : null);
        $adres->setStraat($row['straat']);
        $adres->setHuisNummer($row['huisNummer']);
        $adres->setBus($row['bus'] ?? null);
        $adres->setPlaatsId((int) $row['plaatsId']);
        $adres->setActief(isset($row['actief']) ? (bool) $row['actief'] : true);

        // Als plaats informatie aanwezig is, voeg deze toe
        if (isset($row['postcode'])) {
            $adres->setPostcode($row['postcode']);
        }
        if (isset($row['plaatsNaam'])) {
            $adres->setPlaatsNaam($row['plaatsNaam']);
        }

        return $adres;
    }

    // Zoek adres op ID met plaats informatie
    public function findById(int $adresId): ?Adres
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT a.*, p.postcode, p.plaats AS plaatsNaam
                    FROM Adressen a
                    INNER JOIN Plaatsen p ON a.plaatsId = p.plaatsId
                    WHERE a.adresId = :adresId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":adresId" => $adresId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Maak nieuw adres aan
    public function createAdres(string $straat, string $huisNummer, ?string $bus, int $plaatsId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Adressen (straat, huisNummer, bus, plaatsId, actief) 
                    VALUES (:straat, :huisNummer, :bus, :plaatsId, 1)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":straat" => $straat,
                ":huisNummer" => $huisNummer,
                ":bus" => $bus,
                ":plaatsId" => $plaatsId
            ]);
            return (int) $dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Update adres
    public function updateAdres(int $adresId, string $straat, string $huisNummer, ?string $bus, int $plaatsId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Adressen 
                    SET straat = :straat, huisNummer = :huisNummer, bus = :bus, plaatsId = :plaatsId 
                    WHERE adresId = :adresId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":straat" => $straat,
                ":huisNummer" => $huisNummer,
                ":bus" => $bus,
                ":plaatsId" => $plaatsId,
                ":adresId" => $adresId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Deactiveer adres (niet verwijderen)
    public function deactivate(int $adresId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Adressen SET actief = 0 WHERE adresId = :adresId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":adresId" => $adresId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Activeer adres
    public function activate(int $adresId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Adressen SET actief = 1 WHERE adresId = :adresId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":adresId" => $adresId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
}
