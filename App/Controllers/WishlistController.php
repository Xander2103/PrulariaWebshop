<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\WishlistService;

class WishlistController
{
    private WishlistService $wishlistService;

    public function __construct()
    {
        $this->wishlistService = new WishlistService();

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    private function getGebruikersAccountIdOfNull(): ?int
    {
        $gebruiker = $_SESSION["gebruiker"] ?? null;

        if (
            $gebruiker === null ||
            !isset($gebruiker["gebruikersAccountId"]) ||
            (int)$gebruiker["gebruikersAccountId"] <= 0
        ) {
            return null;
        }

        return (int)$gebruiker["gebruikersAccountId"];
    }

    public function wishlistAction(): void
    {
        $gebruikersAccountId = null;

        if (
            isset($_GET["gebruikersAccountId"]) &&
            !empty($_GET["gebruikersAccountId"]) &&
            (int) $_GET["gebruikersAccountId"] > 0
        ) {
            $gebruikersAccountId = (int) $_GET["gebruikersAccountId"];
            $wishlistOverzicht = $this->wishlistService->getWishlistOverzicht($gebruikersAccountId);
        } elseif (!empty($_GET["gastWishlist"])) {
            $artikelIds = array_filter(
                array_map('intval', explode(',', (string) $_GET["gastWishlist"])),
                fn(int $artikelId): bool => $artikelId > 0
            );

            $wishlistOverzicht = $this->wishlistService->getWishlistOverzichtVanArtikelIds($artikelIds);
        } else {
            $gebruikersAccountId = $this->getGebruikersAccountIdOfNull();

            if ($gebruikersAccountId !== null) {
                $wishlistOverzicht = $this->wishlistService->getWishlistOverzicht($gebruikersAccountId);
            } else {
                $wishlistOverzicht = $this->wishlistService->getGastWishlistOverzicht();
            }
        }

        $subLayout = __DIR__ . '/../Views/Pages/wishlist.php';
        require_once __DIR__ . '/../Views/Template/layout.php';
    }

    public function toggleAction(): void
    {
        $artikelId = isset($_POST["artikelId"]) ? (int)$_POST["artikelId"] : 0;

        if ($artikelId <= 0) {
            header("Location: index.php?action=home");
            exit;
        }

        $gebruikersAccountId = $this->getGebruikersAccountIdOfNull();

        if ($gebruikersAccountId !== null) {
            $this->wishlistService->toggleArtikel($gebruikersAccountId, $artikelId);
        } else {
            $this->wishlistService->toggleArtikelVoorGast($artikelId);
        }

        $redirectUrl = $_POST["redirect_url"] ?? "index.php?action=home";

        header("Location: " . $redirectUrl);
        exit;
    }

    public function verwijderAction(): void
    {
        $artikelId = isset($_POST["artikelId"]) ? (int)$_POST["artikelId"] : 0;

        if ($artikelId <= 0) {
            header("Location: index.php?action=wishlist");
            exit;
        }

        $gebruikersAccountId = $this->getGebruikersAccountIdOfNull();

        if ($gebruikersAccountId !== null) {
            $this->wishlistService->removeArtikel($gebruikersAccountId, $artikelId);
        } else {
            $this->wishlistService->removeArtikelVoorGast($artikelId);
        }

        header("Location: index.php?action=wishlist");
        exit;
    }

    public function deelbareWishlistAction(): void
    {
        $gebruikersAccountId = isset($_GET["gebruikersAccountId"]) ? (int)$_GET["gebruikersAccountId"] : 0;

        if ($gebruikersAccountId > 0) {
            $wishlistOverzicht = $this->wishlistService->getWishlistOverzicht($gebruikersAccountId);
        } else {
            $wishlistOverzicht = [];
        }

        $subLayout = __DIR__ . '/../Views/Pages/wishlist.php';
        require_once __DIR__ . '/../Views/Template/layout.php';
    }

    public function clearWishlistAction(): void
    {
        $gebruikersAccountId = $this->getGebruikersAccountIdOfNull();

        if ($gebruikersAccountId !== null) {
            $this->wishlistService->clearWishlist($gebruikersAccountId);
        } else {
            $_SESSION["wishlist"] = [];
        }

        header("Location: ?action=wishlist");
        exit;
    }
}
