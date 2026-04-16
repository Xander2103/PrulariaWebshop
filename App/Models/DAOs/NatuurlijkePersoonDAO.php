<?php
// NatuurlijkePersoonDAO.php - Data Access Object voor Natuurlijke Personen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\NatuurlijkePersoon;
use PDO;
use PDOException;
use Config\DBConfig;

class NatuurlijkePersoonDAO
{
    private function mapToEntity(array $row): NatuurlijkePersoon
    {
        $persoon = new NatuurlijkePersoon();
        $persoon->setKlantId((int) $row['klantId']);
        $persoon->setVoornaam($row['voornaam']);
        $persoon->setFamilienaam($row['familienaam']);
        $persoon->setGebruikersAccountId((int) $row['gebruikersAccountId']);
        return $persoon;
    }

    // Zoek natuurlijk persoon op gebruikersaccount ID
    public function findByGebruikersAccountId(int $gebruikersAccountId): ?NatuurlijkePersoon
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT np.*, k.facturatieAdresId, k.leveringsAdresId
                    FROM NatuurlijkePersonen np
                    INNER JOIN Klanten k ON np.klantId = k.klantId
                    WHERE np.gebruikersAccountId = :gebruikersAccountId";
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

    // Zoek natuurlijk persoon op klant ID
    public function findByKlantId(int $klantId): ?NatuurlijkePersoon
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM NatuurlijkePersonen WHERE klantId = :klantId";
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

    // Maak nieuwe natuurlijk persoon aan
    // gebruikersAccountId nullable: NULL = gastbestelling, gevuld = geregistreerde klant
    public function createPersoon(int $klantId, string $voornaam, string $familienaam, ?int $gebruikersAccountId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO NatuurlijkePersonen (klantId, voornaam, familienaam, gebruikersAccountId) 
                    VALUES (:klantId, :voornaam, :familienaam, :gebruikersAccountId)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":klantId" => $klantId,
                ":voornaam" => $voornaam,
                ":familienaam" => $familienaam,
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

    // Update natuurlijk persoon gegevens
    public function updatePersoon(int $klantId, string $voornaam, string $familienaam): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE NatuurlijkePersonen 
                    SET voornaam = :voornaam, familienaam = :familienaam 
                    WHERE klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":voornaam" => $voornaam,
                ":familienaam" => $familienaam,
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
