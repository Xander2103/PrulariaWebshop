<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ArtikelService;
use App\Services\WishlistService;


class HomeController extends BaseController
{
    public function startpaginaAction()
    {
        $ArtikelService = new ArtikelService();

        // Filters
        $filters = [];
        if (isset($_GET['categorieId'])) {
            $filters['categorieId'] = (int) $_GET['categorieId'];
        }
        if (isset($_GET['opVoorraad'])) {
            $filters['opVoorraad'] = true;
        }
        if (isset($_GET['minPrijs'])) {
            $filters['minPrijs'] = (float) $_GET['minPrijs'];
        }
        if (isset($_GET['maxPrijs'])) {
            $filters['maxPrijs'] = (float) $_GET['maxPrijs'];
        }
        if (isset($_GET['zoektekst'])) {
            $filters['zoektekst'] = trim($_GET['zoektekst']);
        }
        if (isset($_GET['sorteer'])) {
            $filters['sorteer'] = trim($_GET['sorteer']);
        }

        // Paginatie
        $limit = 20;
        $pagina = isset($_GET["pagina"]) ? (int) $_GET["pagina"] : 1;

        // Artikelen ophalen
        if (!empty($filters)) {
            $artikelen = $ArtikelService->vindGefilterdeArtikelenPerArtikelen($pagina, $filters);
            $aantalArtikelen = $ArtikelService->HaalGefilterdeAantallenOp($filters);
            $aantalPagina = ceil($aantalArtikelen / 20);
        } else {
            $artikelen = $ArtikelService->vindArtikelenPerPagina($pagina);
            $aantalArtikelen = $ArtikelService->haalTotaalAantalOp();
            $aantalPagina = ceil($aantalArtikelen / 20);
        }
        // Wishlist artikelIds ophalen
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $maxArtikelPrijs = $ArtikelService->haalArtikelMaxPrijsOp();
        

        $wishlistService = new WishlistService();

        $gebruiker = $_SESSION["gebruiker"] ?? null;
        $gebruikersAccountId = null;

        if (
            $gebruiker !== null &&
            isset($gebruiker["gebruikersAccountId"]) &&
            (int)$gebruiker["gebruikersAccountId"] > 0
        ) {
            $gebruikersAccountId = (int)$gebruiker["gebruikersAccountId"];
        }

        $wishlistArtikelIds = $wishlistService->getActieveWishlistArtikelIds($gebruikersAccountId);

        // View renderen via renderAction voor flash message support
        $this->renderAction('Pages/home', [
            'artikelen' => $artikelen,
            'aantalArtikelen' => $aantalArtikelen,
            'aantalPagina' => $aantalPagina,
            'wishlistArtikelIds' => $wishlistArtikelIds,
            'filters' => $filters,
            'pagina' => $pagina,
            'maxArtikelPrijs' => $maxArtikelPrijs,
            'limit' => $limit
        ]);
    }
}
