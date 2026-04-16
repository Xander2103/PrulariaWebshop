<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\WinkelmandjeService;
use App\Models\DAOs\ActiecodeDAO;

class WinkelmandjeController extends BaseController
{
    public function winkelmandjeAction(): void
    {
        $winkelmandjeService = new WinkelmandjeService();
        $winkelmandregels = $winkelmandjeService->getWinkelmandregels();
        $totaalPrijs = $winkelmandjeService->getTotaalPrijs();
        $korting = 0.0;

        if (isset($_SESSION['actiecode'])) {
            $korting = $totaalPrijs * 0.10; // 10% korting
            $totaalPrijs -= $korting;
        }

        $subLayout = __DIR__ . '/../Views/Pages/winkelmandje.php';
        require_once __DIR__ . '/../Views/Template/layout.php';
    }

    public function pasActiecodeToeAction(): void
    {
        $code = trim($_POST['actiecode'] ?? '');
        
        if (empty($code)) {
            $_SESSION['actiecode_error'] = 'Vul een actiecode in.';
        } else {
            $actiecodeDAO = new ActiecodeDAO();
            if ($actiecodeDAO->isGeldig($code)) {
                $_SESSION['actiecode'] = $code;
                unset($_SESSION['actiecode_error']);
                $_SESSION['actiecode_success'] = 'Actiecode succesvol toegepast! (10% korting)';
            } else {
                $_SESSION['actiecode_error'] = 'De ingevoerde actiecode is ongeldig of verlopen.';
                unset($_SESSION['actiecode']);
            }
        }
        
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php?action=winkelmandje';
        header('Location: ' . $referer);
        exit;
    }

    public function verwijderActiecodeAction(): void
    {
        unset($_SESSION['actiecode']);
        unset($_SESSION['actiecode_success']);
        unset($_SESSION['actiecode_error']);
        
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php?action=winkelmandje';
        header('Location: ' . $referer);
        exit;
    }

    public function addAction(): void
    {
        $artikelId = isset($_POST['artikelId']) ? (int) $_POST['artikelId'] : 0;
        $aantal = isset($_POST['aantal']) ? (int) $_POST['aantal'] : 1;

        $winkelmandjeService = new WinkelmandjeService();
        $succes = $winkelmandjeService->voegArtikelToe($artikelId, $aantal);

        if (!$succes) {
            header('Location: index.php?action=productdetail&artikelId=' . $artikelId);
            exit;
        }

        header('Location: index.php?action=winkelmandje');
        exit;
    }

    public function verwijderAction(): void
    {
        $artikelId = isset($_POST['artikelId']) ? (int) $_POST['artikelId'] : 0;

        $winkelmandjeService = new WinkelmandjeService();
        $winkelmandjeService->verwijderArtikel($artikelId);

        header('Location: index.php?action=winkelmandje');
        exit;
    }
}
