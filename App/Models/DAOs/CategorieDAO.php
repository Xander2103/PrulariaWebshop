<?php
// CategorieDAO.php - Data Access Object voor Categorieen

declare(strict_types=1);

namespace App\Models\DAOs;

use App\Models\Entities\Categorie;
use PDO;
use PDOException;
use Config\DBConfig;

class CategorieDAO
{

    private function mapToEntity(array $row): Categorie
    {
        $categorie = new Categorie(
            isset($row['categorieId']) ? (int) $row['categorieId'] : null,
            $row['naam'],
            isset($row['hoofdCategorieId']) ? (int) $row['hoofdCategorieId'] : null
        );

        // Optionele velden
        if (isset($row['aantalArtikelen'])) {
            $categorie->setAantalArtikelen((int) $row['aantalArtikelen']);
        }

        return $categorie;
    }

    // Haal alle hoofdcategorieën op

    public function findHoofdCategorieen(): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT c.categorieId, c.naam, c.hoofdCategorieId,
                            COUNT(DISTINCT ac.artikelId) AS aantalArtikelen
                    FROM Categorieen c
                    LEFT JOIN ArtikelCategorieen ac ON c.categorieId = ac.categorieId
                    WHERE c.hoofdCategorieId IS NULL
                    GROUP BY c.categorieId, c.naam, c.hoofdCategorieId
                    ORDER BY c.naam ASC";
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

    // Haal subcategorieën op voor een hoofdcategorie
    public function findSubcategorieen(int $hoofdCategorieId): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT c.categorieId, c.naam, c.hoofdCategorieId,
                        COUNT(DISTINCT ac.artikelId) AS aantalArtikelen
                    FROM Categorieen c
                    LEFT JOIN ArtikelCategorieen ac ON c.categorieId = ac.categorieId
                    WHERE c.hoofdCategorieId = :hoofdCategorieId
                    GROUP BY c.categorieId, c.naam, c.hoofdCategorieId
                    ORDER BY c.naam ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":hoofdCategorieId" => $hoofdCategorieId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }




    // Zoek categorie op ID
    public function findById(int $categorieId): ?Categorie
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT c.*, COUNT(DISTINCT ac.artikelId) AS aantalArtikelen
                    FROM Categorieen c
                    LEFT JOIN ArtikelCategorieen ac ON c.categorieId = ac.categorieId
                    WHERE c.categorieId = :categorieId
                    GROUP BY c.categorieId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":categorieId" => $categorieId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->mapToEntity($result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal categorieën op voor een artikel
    public function findByArtikelId(int $artikelId): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT c.*
                    FROM Categorieen c
                    INNER JOIN ArtikelCategorieen ac ON c.categorieId = ac.categorieId
                    WHERE ac.artikelId = :artikelId
                    ORDER BY c.naam ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":artikelId" => $artikelId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Haal meest aangekochte categorieën op voor een klant
    public function findMeestAangekochteCategorieen(int $klantId, int $limit = 3): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT c.categorieId, c.naam, COUNT(*) AS aantalAankopen
                    FROM Bestellingen b
                    INNER JOIN Bestellijnen bl ON b.bestelId = bl.bestelId
                    INNER JOIN ArtikelCategorieen ac ON bl.artikelId = ac.artikelId
                    INNER JOIN Categorieen c ON ac.categorieId = c.categorieId
                    WHERE b.klantId = :klantId AND b.betaald = 1
                    GROUP BY c.categorieId
                    ORDER BY aantalAankopen DESC
                    LIMIT :limit";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([":klantId" => $klantId, ":limit" => $limit]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? array_map([$this, 'mapToEntity'], $result) : null;
        } catch (PDOException $e) {
            error_log("DB-Fout: {$e->getMessage()}");
            return null;
        } finally {
            $dbh = null;
        }
    }

    // Zoek categorieën op naam (voor autocomplete)

    public function searchByNaam(string $zoekterm, int $limit = 5): ?array
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $searchPattern = "%" . $zoekterm . "%";

            $sql = "SELECT c.categorieId, c.naam, c.hoofdCategorieId,
                        COUNT(DISTINCT ac.artikelId) AS aantalArtikelen
                    FROM Categorieen c
                    LEFT JOIN ArtikelCategorieen ac ON c.categorieId = ac.categorieId
                    WHERE LOWER(c.naam) LIKE LOWER(:zoekterm)
                    GROUP BY c.categorieId, c.naam, c.hoofdCategorieId
                    ORDER BY c.naam ASC
                    LIMIT :limit";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':zoekterm', $searchPattern, PDO::PARAM_STR);
            // BELANGRIJK: :limit mag NIET in de execute() array!
            // PDO zet parameters standaard als strings (met quotes), maar LIMIT vereist een raw integer.
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
}
