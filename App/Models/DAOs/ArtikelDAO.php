<?php
// ArtikelDAO.php - Data Access Object voor Artikelen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Artikel;
use PDO;
use PDOException;
use Config\DBConfig;

class ArtikelDAO
{

    private function mapToEntity(array $row): Artikel
    {
        $artikel = new Artikel(
            isset($row['artikelId']) ? (int) $row['artikelId'] : null,
            $row['ean'] ?? null,
            $row['naam'],
            $row['beschrijving'] ?? null,
            (float) $row['prijs'],
            (int) $row['gewichtInGram'],
            (int) $row['bestelpeil'],
            (int) $row['voorraad'],
            (int) $row['minimumVoorraad'],
            (int) $row['maximumVoorraad'],
            (int) $row['levertijd'],
            (int) $row['aantalBesteldLeverancier'],
            (int) ($row['maxAantalInMagazijnPlaats'] ?? 0),
            isset($row['leveranciersId']) ? (int) $row['leveranciersId'] : null
        );

        // Optionele velden
        if (isset($row['categorienamen'])) {
            $categorieNamen = explode(', ', $row['categorienamen']);
            $artikel->setCategorieen($categorieNamen);
        }

        if (isset($row['afbeeldingUrl'])) {
            $artikel->setAfbeeldingUrl($row['afbeeldingUrl']);
        }

        return $artikel;
    }

    // Zoek artikel op ID met categorie informatie
    public function findById(int $artikelId): ?Artikel
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT a.*, GROUP_CONCAT(c.naam SEPARATOR ', ') AS categorienamen
                    FROM Artikelen a
                    LEFT JOIN ArtikelCategorieen ac ON a.artikelId = ac.artikelId
                    LEFT JOIN Categorieen c ON ac.categorieId = c.categorieId
                    WHERE a.artikelId = :artikelId
                    GROUP BY a.artikelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":artikelId" => $artikelId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }


    // Haal alle artikelen op met paginering

    public function findAll(int $limit, int $offset): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT a.*, GROUP_CONCAT(c.naam SEPARATOR ', ') AS categorienamen 
                    FROM Artikelen a
                    LEFT JOIN ArtikelCategorieen ac ON a.artikelId = ac.artikelId
                    LEFT JOIN Categorieen c ON ac.categorieId = c.categorieId
                    GROUP BY a.artikelId
                    ORDER BY a.naam ASC
                    LIMIT :limit OFFSET :offset";
            $stmt = $dbh->prepare($sql);
            // LIMIT en OFFSET moeten als integer gebonden worden, niet als string
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    public function findAllArtikelen(): int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT COUNT(*) FROM Artikelen";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            return (int) $stmt->fetchColumn();

        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0;
        } finally {
            $dbh = null;
        }
    }


    // Zoek artikelen op basis van zoekterm (fuzzy search)

    public function searchByTerm(string $searchTerm, int $limit = 20): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $searchPattern = "%" . $searchTerm . "%";

            $sql = "SELECT DISTINCT a.*, 
                    CASE 
                        WHEN LOWER(a.naam) = LOWER(:exactTerm) THEN 1
                        WHEN LOWER(a.naam) LIKE LOWER(:startsWith) THEN 2
                        WHEN LOWER(a.naam) LIKE LOWER(:contains) THEN 3
                        WHEN LOWER(a.beschrijving) LIKE LOWER(:contains) THEN 4
                        ELSE 5
                    END AS relevantie
                    FROM Artikelen a
                    LEFT JOIN ArtikelCategorieen ac ON a.artikelId = ac.artikelId
                    LEFT JOIN Categorieen c ON ac.categorieId = c.categorieId
                    WHERE LOWER(a.naam) LIKE LOWER(:contains)
                        OR LOWER(a.beschrijving) LIKE LOWER(:contains)
                        OR LOWER(c.naam) LIKE LOWER(:contains)
                    ORDER BY relevantie ASC, a.naam ASC
                    LIMIT :limit";

            $params = [
                ":exactTerm" => $searchTerm,
                ":startsWith" => $searchTerm . "%",
                ":contains" => $searchPattern
                // limit kan hier niet wegens aanpassing naar string, dus apart te binden (zie hieronder)
            ];

            $stmt = $dbh->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
            // BELANGRIJK: :limit mag NIET in de execute() array!
            // PDO zet parameters standaard als strings (met quotes), maar LIMIT vereist een raw integer.
            // Gebruik daarom bindValue() met PDO::PARAM_INT om de waarde als integer te binden.
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal artikelen op per categorie met filters

    public function findByFilters(array $filters, int $limit, int $offset): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Basisquery
            $sql = "SELECT DISTINCT a.* FROM Artikelen a
                LEFT JOIN ArtikelCategorieen ac ON a.artikelId = ac.artikelId
                WHERE 1=1";

            // Filters
            if (isset($filters["categorieId"])) {
                $sql .= " AND ac.categorieId = :categorieId";
            }

            if (isset($filters["opVoorraad"]) && $filters["opVoorraad"] === true) {
                $sql .= " AND a.voorraad > 0";
            }

            // if (isset($filters["minPrijs"])) {
            //     $sql .= " AND a.prijs >= :minPrijs";
            // }

            // if (isset($filters["maxPrijs"])) {
            //     $sql .= " AND a.prijs <= :maxPrijs";
            // }

            if (isset($filters["minPrijs"]) && isset($filters["maxPrijs"])) {
                $sql .= " AND a.prijs BETWEEN :minPrijs AND :maxPrijs";
            }

            if (isset($filters["zoektekst"]) && !empty(trim($filters["zoektekst"]))) {
                $sql .= " AND (a.naam LIKE :zoektekst OR a.beschrijving LIKE :zoektekst)";
            }

            // Sortering
            if (isset($filters["sorteer"])) {
                switch ($filters["sorteer"]) {
                    case "prijs_asc":
                        $sql .= " ORDER BY a.prijs ASC";
                        break;
                    case "prijs_desc":
                        $sql .= " ORDER BY a.prijs DESC";
                        break;
                    case "naam_desc":
                        $sql .= " ORDER BY a.naam DESC";
                        break;
                    default:
                        $sql .= " ORDER BY a.naam ASC";
                        break;
                }
            } else {
                $sql .= " ORDER BY a.naam ASC";
            }

            // LIMIT & OFFSET
            $sql .= " LIMIT :limit OFFSET :offset";

            $stmt = $dbh->prepare($sql);

            // Bind parameters
            if (isset($filters["categorieId"])) {
                $stmt->bindParam(":categorieId", $filters["categorieId"], PDO::PARAM_INT);
            }
            if (isset($filters["minPrijs"])) {
                $stmt->bindParam(":minPrijs", $filters["minPrijs"]);
            }
            if (isset($filters["maxPrijs"])) {
                $stmt->bindParam(":maxPrijs", $filters["maxPrijs"]);
            }
            if (isset($filters["zoektekst"]) && !empty(trim($filters["zoektekst"]))) {
                $zoektekst = "%" . trim($filters["zoektekst"]) . "%";
                $stmt->bindParam(":zoektekst", $zoektekst, PDO::PARAM_STR);
            }

            // Bind limit & offset altijd als integer
            $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;

        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // tellen van artikelen per filter
    public function countByFilters(array $filters): int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Basisquery
            $sql = "SELECT COUNT(DISTINCT a.artikelId) AS totaal
                FROM Artikelen a
                LEFT JOIN ArtikelCategorieen ac ON a.artikelId = ac.artikelId
                WHERE 1=1";

            // Filters
            if (isset($filters["categorieId"])) {
                $sql .= " AND ac.categorieId = :categorieId";
            }

            if (isset($filters["opVoorraad"]) && $filters["opVoorraad"] === true) {
                $sql .= " AND a.voorraad > 0";
            }

            if (isset($filters["minPrijs"])) {
                $sql .= " AND a.prijs >= :minPrijs";
            }

            if (isset($filters["maxPrijs"])) {
                $sql .= " AND a.prijs <= :maxPrijs";
            }

            if (isset($filters["zoektekst"]) && !empty(trim($filters["zoektekst"]))) {
                $sql .= " AND (a.naam LIKE :zoektekst OR a.beschrijving LIKE :zoektekst)";
            }

            $stmt = $dbh->prepare($sql);

            // Bind parameters
            if (isset($filters["categorieId"])) {
                $stmt->bindParam(":categorieId", $filters["categorieId"], PDO::PARAM_INT);
            }

            if (isset($filters["minPrijs"])) {
                $stmt->bindParam(":minPrijs", $filters["minPrijs"]);
            }

            if (isset($filters["maxPrijs"])) {
                $stmt->bindParam(":maxPrijs", $filters["maxPrijs"]);
            }

            if (isset($filters["zoektekst"]) && !empty(trim($filters["zoektekst"]))) {
                $zoektekst = "%" . trim($filters["zoektekst"]) . "%";
                $stmt->bindParam(":zoektekst", $zoektekst, PDO::PARAM_STR);
            }

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int) $result["totaal"];

        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0;
        } finally {
            $dbh = null;
        }
    }

    // Tel artikelen per categorie
    public function countByCategorie(int $categorieId): int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(DISTINCT a.artikelId) AS aantal
                    FROM Artikelen a
                    INNER JOIN ArtikelCategorieen ac ON a.artikelId = ac.artikelId
                    WHERE ac.categorieId = :categorieId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":categorieId" => $categorieId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) ($result["aantal"] ?? 0);
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return 0;
        } finally {
            $dbh = null;
        }
    }

    // Update voorraad
    public function updateVoorraad(int $artikelId, int $nieuweVoorraad): ?int
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Artikelen 
                    SET voorraad = :voorraad 
                    WHERE artikelId = :artikelId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ":voorraad" => $nieuweVoorraad,
                ":artikelId" => $artikelId
            ]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
    public function findArtikelAndCategory(int $categorieId)
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * , categorieen.categorieId
            FROM artikelen
            JOIN artikelcategorieen ON artikelen.artikelId = artikelcategorieen.artikelId
            JOIN categorieen ON artikelcategorieen.categorieId = categorieen.categorieId
            WHERE categorieen.categorieId = :categorieId";
            $stmt = $dbh->prepare($sql);
            $recordSet = $stmt->execute([":categorieId" => $categorieId]);
            return $recordSet;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    public function findArtikelMaxPrijs()
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT *
            FROM artikelen
            WHERE prijs = (SELECT MAX(prijs) FROM artikelen) LIMIT 1;";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $recordSet = $stmt->fetch(PDO::FETCH_ASSOC);
            return $recordSet;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }
}
