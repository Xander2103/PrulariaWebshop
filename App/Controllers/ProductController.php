<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ArtikelService;
use App\Services\ReviewService;
use App\Controllers\BaseController;

class ProductController extends BaseController
{
    public function detailpaginaAction(): void
    {
        $artikelId = isset($_GET['artikelId']) ? (int) $_GET['artikelId'] : 0;

        $artikelService = new ArtikelService();
        $artikel = $artikelService->getArtikelById($artikelId);

        $reviewService = new ReviewService();
        $reviews        = $reviewService->getReviewsByArtikelId($artikelId);
        $gemiddeldeScore = $reviewService->getAverageScore($artikelId);
        $aantalReviews  = count($reviews ?? []);

        $kanReviewen       = false;
        $heeftGekocht      = false;
        $heeftAlGereviewed = false;

        $gebruiker = $this->getIngelogdeGebruiker();
        if ($gebruiker !== null) {
            $klantId = (int) ($gebruiker['klantId'] ?? 0);
            if ($klantId > 0 && $artikelId > 0) {
                $heeftGekocht      = $reviewService->heeftArtikelGekocht($klantId, $artikelId);
                $heeftAlGereviewed = $reviewService->heeftAlGereviewed($klantId, $artikelId);
                $kanReviewen       = $heeftGekocht && !$heeftAlGereviewed;
            }
        }

        $subLayout = __DIR__ . '/../Views/Pages/productDetail.php';
        require_once __DIR__ . '/../Views/Template/layout.php';
    }

    public function productdetailAction(): void
    {
        $this->detailpaginaAction();
    }
}