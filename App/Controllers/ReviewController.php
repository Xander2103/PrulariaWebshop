<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ReviewService;

class ReviewController extends BaseController
{
    private ReviewService $reviewService;

    public function __construct()
    {
        parent::__construct();
        $this->reviewService = new ReviewService();
    }

    // GET ?action=nieuwereview → redirect terug naar de productpagina
    public function reviewFormulierAction(): void
    {
        $artikelId = isset($_GET['artikelId']) ? (int) $_GET['artikelId'] : 0;

        if ($artikelId > 0) {
            $this->redirectAction("detailpagina&artikelId={$artikelId}");
        } else {
            $this->redirectAction("home");
        }
    }

    // POST ?action=nieuwereview
    public function nieuweReviewAction(): void
    {
        $this->requireLogin();

        $gebruiker = $this->getIngelogdeGebruiker();
        $klantId = (int) ($gebruiker['klantId'] ?? 0);

        $artikelId = isset($_POST['artikelId']) ? (int) $_POST['artikelId'] : 0;
        $nickname  = trim($_POST['nickname'] ?? '');
        $score     = isset($_POST['score']) ? (int) $_POST['score'] : 0;
        $commentaar = isset($_POST['commentaar']) && trim($_POST['commentaar']) !== ''
            ? trim($_POST['commentaar'])
            : null;

        // Validatie
        if ($artikelId <= 0 || $klantId <= 0) {
            $this->redirectAction("home", "Ongeldig verzoek.");
            return;
        }

        if ($score < 1 || $score > 5) {
            $this->redirectAction(
                "detailpagina&artikelId={$artikelId}",
                "Geef een geldige sterrenrating (1–5) op.",
                null,
                "reviews"
            );
            return;
        }

        if ($nickname === '') {
            $this->redirectAction(
                "detailpagina&artikelId={$artikelId}",
                "Vul een nickname in.",
                null,
                "reviews"
            );
            return;
        }

        // Controleer of gebruiker mag reviewen (gekocht + nog niet gereviewed)
        if (!$this->reviewService->kanReviewPlaatsen($klantId, $artikelId)) {
            $heeftGekocht = $this->reviewService->heeftArtikelGekocht($klantId, $artikelId);
            if (!$heeftGekocht) {
                $this->redirectAction(
                    "detailpagina&artikelId={$artikelId}",
                    "U kunt alleen producten reviewen die u heeft aangekocht.",
                    null,
                    "reviews"
                );
            } else {
                $this->redirectAction(
                    "detailpagina&artikelId={$artikelId}",
                    "U heeft dit product al beoordeeld.",
                    null,
                    "reviews"
                );
            }
            return;
        }

        // Haal bestellijnId server-side op (nooit vertrouwen op POST-waarde)
        $bestellijnId = $this->reviewService->haalBestellijnIdOpVoorReview($klantId, $artikelId);
        if ($bestellijnId === null) {
            $this->redirectAction(
                "detailpagina&artikelId={$artikelId}",
                "Er is een fout opgetreden. Probeer het later opnieuw.",
                null,
                "reviews"
            );
            return;
        }

        // Sla review op
        $reviewId = $this->reviewService->voegReviewToe($nickname, $score, $commentaar, $bestellijnId);

        if ($reviewId === null) {
            $this->redirectAction(
                "detailpagina&artikelId={$artikelId}",
                "Er is een fout opgetreden bij het opslaan van uw review.",
                null,
                "reviews"
            );
            return;
        }

        $this->redirectAction(
            "detailpagina&artikelId={$artikelId}",
            null,
            "Uw review is succesvol geplaatst. Bedankt!",
            "reviews"
        );
    }
}
