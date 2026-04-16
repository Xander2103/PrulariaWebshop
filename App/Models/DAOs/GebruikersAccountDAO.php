<?php
// GebruikersAccountDAO.php - Data Access Object voor Gebruikersaccounts

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\GebruikersAccount;
use PDO;
use PDOException;
use Config\DBConfig;

class GebruikersAccountDAO
{
    private function mapToEntity(array $row): GebruikersAccount
    {
        return new GebruikersAccount(
            isset($row['gebruikersAccountId']) ? (int) $row['gebruikersAccountId'] : null,
            $row['emailadres'],
            $row['paswoord'],
            isset($row['disabled']) ? (bool) $row['disabled'] : false
        );
    }

    // Zoek gebruiker op email
    public function findByEmail(string $emailadres): ?GebruikersAccount
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM GebruikersAccounts WHERE emailadres = :emailadres";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":emailadres" => $emailadres]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Zoek gebruiker op ID
    public function findById(int $gebruikersAccountId): ?GebruikersAccount
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM GebruikersAccounts WHERE gebruikersAccountId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":id" => $gebruikersAccountId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Maak nieuwe gebruiker aan
    public function createAccount(string $emailadres, string $paswoord): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO GebruikersAccounts (emailadres, paswoord, disabled) 
                    VALUES (:emailadres, :paswoord, 0)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":emailadres" => $emailadres,
                ":paswoord" => $paswoord
            ]);
            return (int) $dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Update wachtwoord
    public function updateWachtwoord(int $gebruikersAccountId, string $nieuwPaswoord): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE GebruikersAccounts 
                    SET paswoord = :paswoord 
                    WHERE gebruikersAccountId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":paswoord" => $nieuwPaswoord,
                ":id" => $gebruikersAccountId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Deactiveer account
    public function deactivateAccount(int $gebruikersAccountId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE GebruikersAccounts 
                    SET disabled = 1 
                    WHERE gebruikersAccountId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":id" => $gebruikersAccountId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Activeer account
    public function activateAccount(int $gebruikersAccountId): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE GebruikersAccounts 
                    SET disabled = 0 
                    WHERE gebruikersAccountId = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":id" => $gebruikersAccountId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Check of email al bestaat
    public function emailExists(string $emailadres): bool
    {
        $result = $this->findByEmail($emailadres);
        return null !== $result;
    }
}
