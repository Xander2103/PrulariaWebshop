<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DAOs\ArtikelDAO;
use App\Models\Entities\Artikel;

class ArtikelService
{
    private ArtikelDAO $artikelDAO;

    public function __construct()
    {
        $this->artikelDAO = new ArtikelDAO();
    }

    public function getArtikelById(int $artikelId): ?Artikel
    {
        if ($artikelId <= 0) {
            return null;
        }

        return $this->artikelDAO->findById($artikelId);
    }

    public function haalAlleArtikelenOp(int $limit = 50, int $offset = 0): ?array
    {
        return $this->artikelDAO->findAll($limit, $offset);
    }
    public function vindArtikelenPerPagina(int $pagina): ?array
    {
        $limit = 20;
        $offset = ($pagina - 1) * $limit;
        $artikelDAO = new ArtikelDAO();
        $recordSet = $artikelDAO->findAll($limit, $offset);
        return $recordSet;
    }

    public function haalTotaalAantalOp() {
        $artikelDAO = new ArtikelDAO();
        $aantalArtikelen = $artikelDAO->findAllArtikelen();
        return $aantalArtikelen;
    }
    public function vindGefilterdeArtikelenPerArtikelen(int $pagina, array $filters = []): ?array
    {
        $limit = 20;
        $offset = ($pagina - 1) * $limit;
        $artikelDAO = new ArtikelDAO();
        $recordSet = $artikelDAO->findByFilters($filters, $limit, $offset);
        return $recordSet;
    }

    public function HaalGefilterdeAantallenOp($filters) {
        $artikelDAO = new ArtikelDAO();
        $aantalArtikelen = $artikelDAO->countByFilters($filters);
        return $aantalArtikelen;
    }

    public function haalArtikelMaxPrijsOp() {
        $artikelDAO = new ArtikelDAO();
        $artikelMaxPrijs = $artikelDAO->findArtikelMaxPrijs();
        return $artikelMaxPrijs;
    }
}