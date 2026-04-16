<?php

declare(strict_types=1);

namespace App\Services;

class WinkelmandjeService
{
    private ArtikelService $artikelService;

    public function __construct()
    {
        $this->ensureSessionStarted();
        $this->artikelService = new ArtikelService();
    }

    private function ensureSessionStarted(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function voegArtikelToe(int $artikelId, int $aantal): bool
    {
        if ($artikelId <= 0 || $aantal <= 0) {
            return false;
        }

        $artikel = $this->artikelService->getArtikelById($artikelId);

        if ($artikel === null) {
            return false;
        }

        if ($artikel->getVoorraad() <= 0) {
            return false;
        }

        if (!isset($_SESSION['winkelmand'])) {
            $_SESSION['winkelmand'] = [];
        }

        if (!isset($_SESSION['winkelmand'][$artikelId])) {
            $_SESSION['winkelmand'][$artikelId] = 0;
        }

        $nieuwTotaal = $_SESSION['winkelmand'][$artikelId] + $aantal;

        if ($nieuwTotaal > $artikel->getVoorraad()) {
            return false;
        }

        $_SESSION['winkelmand'][$artikelId] = $nieuwTotaal;

        return true;
    }

    public function getWinkelmandregels(): array
    {
        if (!isset($_SESSION['winkelmand'])) {
            return [];
        }

        $winkelmandregels = [];

        foreach ($_SESSION['winkelmand'] as $artikelId => $aantal) {
            $artikel = $this->artikelService->getArtikelById((int) $artikelId);

            if ($artikel !== null) {
                $winkelmandregels[] = [
                    'artikel' => $artikel,
                    'aantal' => (int) $aantal,
                    'subtotaal' => $artikel->getPrijs() * (int) $aantal,
                ];
            }
        }

        return $winkelmandregels;
    }

    public function verwijderArtikel(int $artikelId): bool
    {
        if ($artikelId <= 0) {
            return false;
        }

        if (!isset($_SESSION['winkelmand'][$artikelId])) {
            return false;
        }

        unset($_SESSION['winkelmand'][$artikelId]);

        return true;
    }

    public function getTotaalPrijs(): float
    {
        $totaalPrijs = 0.0;

        foreach ($this->getWinkelmandregels() as $winkelmandregel) {
            $totaalPrijs += (float) $winkelmandregel['subtotaal'];
        }

        return $totaalPrijs;
    }
}
