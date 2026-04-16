<?php
// ContactpersoonDAO.php - Data Access Object voor Contactpersonen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Contactpersoon;
use PDO;
use PDOException;
use Config\DBConfig;

class ContactpersoonDAO
{

    private function mapToEntity(array $row): Contactpersoon
    {
        $contactpersoon = new Contactpersoon();
        $contactpersoon->setContactpersoonId(isset($row['contactpersoonId']) ? (int) $row['contactpersoonId'] : null);
        $contactpersoon->setVoornaam($row['voornaam']);
        $contactpersoon->setFamilienaam($row['familienaam']);
        $contactpersoon->setFunctie($row['functie']);
        $contactpersoon->setKlantId((int) $row['klantId']);
        $contactpersoon->setGebruikersAccountId((int) $row['gebruikersAccountId']);
        return $contactpersoon;
    }

    // Zoek contactpersoon op gebruikersaccount ID
    public function findByGebruikersAccountId(int $gebruikersAccountId): ?Contactpersoon
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT cp.*, k.facturatieAdresId, k.leveringsAdresId,
                            rp.naam AS bedrijfsnaam, rp.btwNummer
                    FROM Contactpersonen cp
                    INNER JOIN Klanten k ON cp.klantId = k.klantId
                    INNER JOIN Rechtspersonen rp ON cp.klantId = rp.klantId
                    WHERE cp.gebruikersAccountId = :gebruikersAccountId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":gebruikersAccountId" => $gebruikersAccountId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Zoek contactpersoon op ID
    public function findById(int $contactpersoonId): ?Contactpersoon
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Contactpersonen WHERE contactpersoonId = :contactpersoonId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":contactpersoonId" => $contactpersoonId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal alle contactpersonen van een rechtspersoon op

    public function findByKlantId(int $klantId): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Contactpersonen WHERE klantId = :klantId ORDER BY voornaam, familienaam";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":klantId" => $klantId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Maak nieuwe contactpersoon aan
    // gebruikersAccountId nullable: NULL = gastbestelling, gevuld = geregistreerde klant
    public function createContactpersoon(string $voornaam, string $familienaam, string $functie, int $klantId, ?int $gebruikersAccountId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Contactpersonen (voornaam, familienaam, functie, klantId, gebruikersAccountId) 
                    VALUES (:voornaam, :familienaam, :functie, :klantId, :gebruikersAccountId)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":voornaam" => $voornaam,
                ":familienaam" => $familienaam,
                ":functie" => $functie,
                ":klantId" => $klantId,
                ":gebruikersAccountId" => $gebruikersAccountId
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
