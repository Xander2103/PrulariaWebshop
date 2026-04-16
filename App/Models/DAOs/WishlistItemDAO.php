<?php

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\WishlistItem;
use PDO;
use PDOException;
use Config\DBConfig;
use DateTime;

class WishlistItemDAO
{
    private function mapToEntity(array $row): WishlistItem
    {
        $aanvraagDatum = isset($row["aanvraagDatum"]) ? new DateTime($row["aanvraagDatum"]) : null;
        $emailGestuurdDatum = isset($row["emailGestuurdDatum"]) && $row["emailGestuurdDatum"] !== null
            ? new DateTime($row["emailGestuurdDatum"])
            : null;

        return new WishlistItem(
            isset($row["wishListItemId"]) ? (int)$row["wishListItemId"] : null,
            (int)$row["gebruikersAccountId"],
            (int)$row["artikelId"],
            $aanvraagDatum,
            isset($row["aantal"]) ? (int)$row["aantal"] : 1,
            $emailGestuurdDatum
        );
    }

    public function findByGebruikersAccountId(int $gebruikersAccountId): array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT *
                    FROM wishlistitems
                    WHERE gebruikersAccountId = :gebruikersAccountId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":gebruikersAccountId" => $gebruikersAccountId
            ]);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map([$this, "mapToEntity"], $result);
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return [];
        } finally {
            $dbh = null;
        }
    }

    public function add(int $gebruikersAccountId, int $artikelId): ?int
    {
        if ($this->exists($gebruikersAccountId, $artikelId)) {
            return null;
        }

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO wishlistitems (gebruikersAccountId, artikelId, aanvraagDatum, aantal)
                    VALUES (:gebruikersAccountId, :artikelId, NOW(), 1)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":gebruikersAccountId" => $gebruikersAccountId,
                ":artikelId" => $artikelId
            ]);

            return (int)$dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    public function remove(int $gebruikersAccountId, int $artikelId): int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM wishlistitems
                    WHERE gebruikersAccountId = :gebruikersAccountId
                    AND artikelId = :artikelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":gebruikersAccountId" => $gebruikersAccountId,
                ":artikelId" => $artikelId
            ]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0;
        } finally {
            $dbh = null;
        }
    }

    public function exists(int $gebruikersAccountId, int $artikelId): bool
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT COUNT(*) AS aantal
                    FROM wishlistitems
                    WHERE gebruikersAccountId = :gebruikersAccountId
                    AND artikelId = :artikelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":gebruikersAccountId" => $gebruikersAccountId,
                ":artikelId" => $artikelId
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int)($result["aantal"] ?? 0) > 0;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return false;
        } finally {
            $dbh = null;
        }
    }

    public function countByGebruiker(int $gebruikersAccountId): int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT COUNT(*) AS aantal
                    FROM wishlistitems
                    WHERE gebruikersAccountId = :gebruikersAccountId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":gebruikersAccountId" => $gebruikersAccountId
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int)($result["aantal"] ?? 0);
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0;
        } finally {
            $dbh = null;
        }
    }

    public function clearWishlist(int $gebruikersAccountId): int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM wishlistitems
                    WHERE gebruikersAccountId = :gebruikersAccountId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":gebruikersAccountId" => $gebruikersAccountId
            ]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0;
        } finally {
            $dbh = null;
        }
    }
}
