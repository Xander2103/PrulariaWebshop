<?php
// BestellingDAO.php - Data Access Object voor Bestellingen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Bestelling;
use PDO;
use PDOException;
use Config\DBConfig;
use DateTime;

class BestellingDAO
{

    private function mapToEntity(array $row): Bestelling
    {
        $besteldatum = isset($row['besteldatum']) ? new DateTime($row['besteldatum']) : null;
        $annulatiedatum = isset($row['annulatiedatum']) ? new DateTime($row['annulatiedatum']) : null;
        
        $bestelling = new Bestelling();
        $bestelling->setBestelId(isset($row['bestelId']) ? (int) $row['bestelId'] : null);
        $bestelling->setBesteldatum($besteldatum);
        $bestelling->setKlantId((int) $row['klantId']);
        $bestelling->setBetaald(isset($row['betaald']) ? (bool) $row['betaald'] : false);
        $bestelling->setBetalingscode($row['betalingscode'] ?? null);
        $bestelling->setBetaalwijzeId((int) $row['betaalwijzeId']);
        $bestelling->setAnnulatie(isset($row['annulatie']) ? (bool) $row['annulatie'] : false);
        $bestelling->setAnnulatiedatum($annulatiedatum);
        $bestelling->setTerugbetalingscode($row['terugbetalingscode'] ?? null);
        $bestelling->setBestellingsStatusId((int) $row['bestellingsStatusId']);
        $bestelling->setActiecodeGebruikt(isset($row['actiecodeGebruikt']) ? (bool) $row['actiecodeGebruikt'] : false);
        $bestelling->setVoornaam($row['voornaam']);
        $bestelling->setFamilienaam($row['familienaam']);
        $bestelling->setFacturatieAdresId((int) $row['facturatieAdresId']);
        $bestelling->setLeveringsAdresId((int) $row['leveringsAdresId']);
        
        return $bestelling;
    }

    // Zoek bestelling op ID
    public function findById(int $bestelId): ?Bestelling
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Bestellingen WHERE bestelId = :bestelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":bestelId" => $bestelId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal alle bestellingen op voor een klant
    public function findByKlantId(int $klantId): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Bestellingen 
                    WHERE klantId = :klantId 
                    ORDER BY besteldatum DESC";
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

    // Maak nieuwe bestelling aan
    public function createBestelling(int $klantId, int $betaalwijzeId, int $bestellingsStatusId, string $voornaam, string $familienaam, int $facturatieAdresId, int $leveringsAdresId, bool $betaald = false): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Bestellingen (besteldatum, klantId, betaald, betaalwijzeId, annulatie,
                                                    actiecodeGebruikt, bestellingsStatusId, voornaam, familienaam,
                                                    facturatieAdresId, leveringsAdresId)
                                        VALUES (NOW(), :klantId, :betaald, :betaalwijzeId, 0,
                                                0, :bestellingsStatusId, :voornaam, :familienaam, :facturatieAdresId,
                                                :leveringsAdresId)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":klantId" => $klantId,
                ":betaald" => $betaald ? 1 : 0,
                ":betaalwijzeId" => $betaalwijzeId,
                ":bestellingsStatusId" => $bestellingsStatusId,
                ":voornaam" => $voornaam,
                ":familienaam" => $familienaam,
                ":facturatieAdresId" => $facturatieAdresId,
                ":leveringsAdresId" => $leveringsAdresId
            ]);
            return (int)$dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Update betaalstatus
    public function updateBetaalStatus(int $bestelId, bool $betaald, ?string $betalingscode = null): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Bestellingen 
                    SET betaald = :betaald, betalingscode = :betalingscode 
                    WHERE bestelId = :bestelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":betaald" => $betaald ? 1 : 0,
                ":betalingscode" => $betalingscode,
                ":bestelId" => $bestelId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Update bestellingsstatus
    public function updateStatus(int $bestelId, int $statusId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Bestellingen 
                    SET bestellingsStatusId = :statusId 
                    WHERE bestelId = :bestelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":statusId" => $statusId,
                ":bestelId" => $bestelId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Annuleer bestelling
    public function annuleer(int $bestelId, ?string $terugbetalingscode = null): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Bestellingen 
                    SET annulatie = 1, annulatiedatum = NOW(), terugbetalingscode = :terugbetalingscode 
                    WHERE bestelId = :bestelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":terugbetalingscode" => $terugbetalingscode,
                ":bestelId" => $bestelId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Update actiecode gebruik
    public function updateActiecodeGebruikt(int $bestelId, bool $actiecodeGebruikt): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Bestellingen 
                    SET actiecodeGebruikt = :actiecodeGebruikt 
                    WHERE bestelId = :bestelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":actiecodeGebruikt" => $actiecodeGebruikt ? 1 : 0,
                ":bestelId" => $bestelId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Tel aantal bestellingen met actiecodes voor een klant
    public function countBestellingenMetActiecodesByKlantId(int $klantId): int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(*) as aantal 
                    FROM Bestellingen 
                    WHERE klantId = :klantId AND actiecodeGebruikt = 1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":klantId" => $klantId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) ($result["aantal"] ?? 0);
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0;
        } finally {
            $dbh = null;
        }
    }
}
