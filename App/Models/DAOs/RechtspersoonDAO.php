<?php
// RechtspersoonDAO.php - Data Access Object voor Rechtspersonen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Rechtspersoon;
use PDO;
use PDOException;
use Config\DBConfig;

class RechtspersoonDAO
{
    private function mapToEntity(array $row): Rechtspersoon
    {
        $rechtspersoon = new Rechtspersoon();
        $rechtspersoon->setKlantId((int) $row['klantId']);
        $rechtspersoon->setNaam($row['naam']);
        $rechtspersoon->setBtwNummer($row['btwNummer']);
        return $rechtspersoon;
    }

    // Zoek rechtspersoon op klant ID
    public function findRechtspersoonByKlantId(int $klantId): ?Rechtspersoon
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT rp.*, k.facturatieAdresId, k.leveringsAdresId
                    FROM Rechtspersonen rp
                    INNER JOIN Klanten k ON rp.klantId = k.klantId
                    WHERE rp.klantId = :klantId";
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

    // Maak nieuwe rechtspersoon aan
    public function createRechtspersoon(int $klantId, string $naam, string $btwNummer): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Rechtspersonen (klantId, naam, btwNummer) 
                    VALUES (:klantId, :naam, :btwNummer)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":klantId" => $klantId,
                ":naam" => $naam,
                ":btwNummer" => $btwNummer
            ]);
            return (int) $dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Update rechtspersoon gegevens
    public function updateRechtspersoon(int $klantId, string $naam, string $btwNummer): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Rechtspersonen 
                    SET naam = :naam, btwNummer = :btwNummer 
                    WHERE klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":naam" => $naam,
                ":btwNummer" => $btwNummer,
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
