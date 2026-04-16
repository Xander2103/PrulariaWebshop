<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DAOs\WishlistItemDAO;

class WishlistService
{
    private WishlistItemDAO $wishlistItemDAO;
    private ArtikelService $artikelService;

    public function __construct()
    {
        $this->ensureSessionStarted();
        $this->wishlistItemDAO = new WishlistItemDAO();
        $this->artikelService = new ArtikelService();
    }

    public function getWishlistOverzichtVanArtikelIds(array $artikelIds): array
    {
        $overzicht = [];

        foreach ($artikelIds as $artikelId) {
            $artikel = $this->artikelService->getArtikelById((int) $artikelId);

            if ($artikel !== null) {
                $overzicht[] = [
                    "wishlistItem" => null,
                    "artikel" => $artikel
                ];
            }
        }

        return $overzicht;
    }

    private function ensureSessionStarted(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function getWishlistByGebruikersAccountId(int $gebruikersAccountId): array
    {
        if ($gebruikersAccountId <= 0) {
            return [];
        }

        return $this->wishlistItemDAO->findByGebruikersAccountId($gebruikersAccountId);
    }

    public function getWishlistOverzicht(int $gebruikersAccountId): array
    {
        if ($gebruikersAccountId <= 0) {
            return [];
        }

        $wishlistItems = $this->wishlistItemDAO->findByGebruikersAccountId($gebruikersAccountId);
        $overzicht = [];

        foreach ($wishlistItems as $wishlistItem) {
            $artikel = $this->artikelService->getArtikelById($wishlistItem->getArtikelId());

            if ($artikel !== null) {
                $overzicht[] = [
                    "wishlistItem" => $wishlistItem,
                    "artikel" => $artikel
                ];
            }
        }

        return $overzicht;
    }

    public function addArtikel(int $gebruikersAccountId, int $artikelId): bool
    {
        if ($gebruikersAccountId <= 0 || $artikelId <= 0) {
            return false;
        }

        if ($this->wishlistItemDAO->exists($gebruikersAccountId, $artikelId)) {
            return false;
        }

        $wishlistItemId = $this->wishlistItemDAO->add($gebruikersAccountId, $artikelId);

        return $wishlistItemId !== null;
    }

    public function removeArtikel(int $gebruikersAccountId, int $artikelId): bool
    {
        if ($gebruikersAccountId <= 0 || $artikelId <= 0) {
            return false;
        }

        return $this->wishlistItemDAO->remove($gebruikersAccountId, $artikelId) > 0;
    }

    public function isArtikelInWishlist(int $gebruikersAccountId, int $artikelId): bool
    {
        if ($gebruikersAccountId <= 0 || $artikelId <= 0) {
            return false;
        }

        return $this->wishlistItemDAO->exists($gebruikersAccountId, $artikelId);
    }

    public function toggleArtikel(int $gebruikersAccountId, int $artikelId): bool
    {
        if ($gebruikersAccountId <= 0 || $artikelId <= 0) {
            return false;
        }

        if ($this->wishlistItemDAO->exists($gebruikersAccountId, $artikelId)) {
            return $this->wishlistItemDAO->remove($gebruikersAccountId, $artikelId) > 0;
        }

        return $this->wishlistItemDAO->add($gebruikersAccountId, $artikelId) !== null;
    }

    public function countWishlistItems(int $gebruikersAccountId): int
    {
        if ($gebruikersAccountId <= 0) {
            return 0;
        }

        return $this->wishlistItemDAO->countByGebruiker($gebruikersAccountId);
    }

    public function clearWishlist(int $gebruikersAccountId): int
    {
        if ($gebruikersAccountId <= 0) {
            return 0;
        }

        return $this->wishlistItemDAO->clearWishlist($gebruikersAccountId);
    }

    public function getGastWishlistArtikelIds(): array
    {
        if (!isset($_SESSION["wishlist"]) || !is_array($_SESSION["wishlist"])) {
            $_SESSION["wishlist"] = [];
        }

        return $_SESSION["wishlist"];
    }

    public function isArtikelInGastWishlist(int $artikelId): bool
    {
        if ($artikelId <= 0) {
            return false;
        }

        $artikelIds = $this->getGastWishlistArtikelIds();

        return in_array($artikelId, $artikelIds, true);
    }

    public function toggleArtikelVoorGast(int $artikelId): bool
    {
        if ($artikelId <= 0) {
            return false;
        }

        if (!isset($_SESSION["wishlist"]) || !is_array($_SESSION["wishlist"])) {
            $_SESSION["wishlist"] = [];
        }

        $index = array_search($artikelId, $_SESSION["wishlist"], true);

        if ($index !== false) {
            unset($_SESSION["wishlist"][$index]);
            $_SESSION["wishlist"] = array_values($_SESSION["wishlist"]);
            return true;
        }

        $_SESSION["wishlist"][] = $artikelId;

        return true;
    }

    public function removeArtikelVoorGast(int $artikelId): bool
    {
        if ($artikelId <= 0) {
            return false;
        }

        if (!isset($_SESSION["wishlist"]) || !is_array($_SESSION["wishlist"])) {
            $_SESSION["wishlist"] = [];
        }

        $index = array_search($artikelId, $_SESSION["wishlist"], true);

        if ($index === false) {
            return false;
        }

        unset($_SESSION["wishlist"][$index]);
        $_SESSION["wishlist"] = array_values($_SESSION["wishlist"]);

        return true;
    }

    public function getGastWishlistOverzicht(): array
    {
        $artikelIds = $this->getGastWishlistArtikelIds();
        $overzicht = [];

        foreach ($artikelIds as $artikelId) {
            $artikel = $this->artikelService->getArtikelById((int)$artikelId);

            if ($artikel !== null) {
                $overzicht[] = [
                    "wishlistItem" => null,
                    "artikel" => $artikel
                ];
            }
        }

        return $overzicht;
    }

    public function getWishlistArtikelIdsByGebruikersAccountId(int $gebruikersAccountId): array
    {
        if ($gebruikersAccountId <= 0) {
            return [];
        }

        $wishlistItems = $this->wishlistItemDAO->findByGebruikersAccountId($gebruikersAccountId);
        $artikelIds = [];

        foreach ($wishlistItems as $wishlistItem) {
            $artikelIds[] = $wishlistItem->getArtikelId();
        }

        return $artikelIds;
    }

    public function getActieveWishlistArtikelIds(?int $gebruikersAccountId): array
    {
        if ($gebruikersAccountId !== null && $gebruikersAccountId > 0) {
            return $this->getWishlistArtikelIdsByGebruikersAccountId($gebruikersAccountId);
        }

        return $this->getGastWishlistArtikelIds();
    }
}
