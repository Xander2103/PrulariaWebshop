<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $protectedRoutes = [
        "bestelbevestiging",
        "betaling",
        "betaalbevestiging",
        "bestelgeschiedenis",
        "actiecodes",
        "nieuwereview",
        "profiel",
        "updateProfiel",
        "updateAdres",
        "deactiveerAccount"
    ];

    public function dispatch(string $action): void
    {
        // Valideer request method - alleen GET en POST toegestaan, fallback naar GET
        $method = ("POST" === $_SERVER["REQUEST_METHOD"]) ? "POST" : "GET";

        // Als action leeg of null is, ga naar home
        if (empty($action)) {
            $this->redirect("home");
            return;
        }

        // Controleer authenticatie voor beveiligde routes
        if ($this->isProtectedRoute($action)) {
            if (!$this->isAuthenticated()) {
                $this->storeRequestedAction($action);
                $this->redirectToLogin("U moet ingelogd zijn om deze pagina te bekijken.");
                return;
            }
        }

        switch ($action) {

            // ========== ALGEMENE PAGINA'S ==========
            case "home":
                // index.php?action=home -> HomeController->startpaginaAction()
                $this->call("HomeController", "startpaginaAction");
                break;

            case "detailpagina":
                // index.php?action=detailpagina&id=123 -> ProductController->detailpaginaAction()
                $this->call("ProductController", "detailpaginaAction");
                break;

            // ========== AUTHENTICATIE ==========
            case "loginformulier":
            case "login":
                // POST: verwerk login, anders: toon login formulier
                if ("POST" === $method) {
                    $this->call("AuthController", "loginAction");
                } else {
                    $this->call("AuthController", "loginformulierAction");
                }
                break;

            case "registratieformulier":
            case "register":
                // POST: verwerk registratie, anders: toon registratie formulier
                if ("POST" === $method) {
                    $this->call("AuthController", "registratieAction");
                } else {
                    $this->call("AuthController", "registratieformulierAction");
                }
                break;

            case "logout":
                // Logout -> redirect naar startpagina met melding
                $this->call("AuthController", "logoutAction");
                break;

            case "gastregistratie":
                // POST: verwerk gast registratie
                if ("POST" === $method) {
                    $this->call("AuthController", "gastregistratieAction");
                } else {
                    $this->redirect("registratieformulier");
                }
                break;

            // ========== KLANT PROFIEL ==========
            case "profiel":
                // index.php?action=profiel -> KlantController->profielAction()
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                $this->call("KlantController", "profielAction");
                break;

            case "updateProfiel":
                // POST: update profiel gegevens
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                if ("POST" === $method) {
                    $this->call("KlantController", "updateProfielAction");
                } else {
                    $this->redirect("profiel");
                }
                break;

            case "updateAdres":
                // POST: update facturatie of leveringsadres
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                if ("POST" === $method) {
                    $this->call("KlantController", "updateAdresAction");
                } else {
                    $this->redirect("profiel");
                }
                break;

            case "deactiveerAccount":
                // GET: deactiveer account en vernietig sessie                 // Beveiligde route - authenticatie al gecontroleerd hierboven
                $this->call("KlantController", "deactiveerAccountAction");
                break;

            // ========== WINKELWAGEN & BESTELLEN ==========
            case "checkout":
                $this->call("CheckoutController", "startAction");
                break;

            case "checkoutProcess":
                if ("POST" === $method) {
                    $this->call("CheckoutController", "processAction");
                } else {
                    $this->redirect("checkout");
                }
                break;

            case "bedankt":
                $this->call("CheckoutController", "bedanktAction");
                break;

            case "winkelmandje":
                // index.php?action=winkelmandje -> WinkelmandjeController->winkelmandjeAction()
                $this->call("WinkelmandjeController", "winkelmandjeAction");
                break;

            case "bestelbevestiging":
                // index.php?action=bestelbevestiging -> BestelController->bestelbevestigingAction()
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                if ("POST" === $method) {
                    $this->call("BestelController", "bestelbevestigingAction");
                } else {
                    $this->redirect("winkelmandje");
                }
                break;

            case "betaling":
                // index.php?action=betaling -> BetalingController->betalingAction()
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                if ("POST" === $method) {
                    $this->call("BetalingController", "betalingAction");
                } else {
                    $this->redirect("winkelmandje");
                }
                break;

            case "toevoegenAanWinkelmandje":
                // index.php?action=toevoegenAanWinkelmandje -> WinkelmandjeController->addAction()
                if ("POST" === $method) {
                    $this->call("WinkelmandjeController", "addAction");
                } else {
                    $this->redirect("home");
                }
                break;

            case "verwijderenUitWinkelmandje":
                if ("POST" === $method) {
                    $this->call("WinkelmandjeController", "verwijderAction");
                } else {
                    $this->redirect("winkelmandje");
                }
                break;

            case "pasActiecodeToe":
                if ("POST" === $method) {
                    $this->call("WinkelmandjeController", "pasActiecodeToeAction");
                } else {
                    $this->redirect("winkelmandje");
                }
                break;

            case "verwijderActiecode":
                if ("POST" === $method) {
                    $this->call("WinkelmandjeController", "verwijderActiecodeAction");
                } else {
                    $this->redirect("winkelmandje");
                }
                break;

            case "betaalbevestiging":
                // index.php?action=betaalbevestiging -> BetalingController->betaalbevestigingAction()
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                if ("POST" === $method) {
                    $this->call("BetalingController", "betaalbevestigingAction");
                } else {
                    $this->redirect("winkelmandje");
                }
                break;

            case "bestelgeschiedenis":
            case "overzichtbestellingen":
                // index.php?action=bestelgeschiedenis -> KlantController->bestellingenAction()
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                $this->call("KlantController", "bestellingenAction");
                break;

            case "actiecodes":
                // index.php?action=actiecodes -> KlantController->actiecodesAction()
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                $this->call("KlantController", "actiecodesAction");
                break;

            case "nieuwereview":
                // index.php?action=nieuwereview -> ReviewController->nieuweReviewAction()
                // Beveiligde route - authenticatie al gecontroleerd hierboven
                if ("POST" === $method) {
                    $this->call("ReviewController", "nieuweReviewAction");
                } else {
                    $this->call("ReviewController", "reviewFormulierAction");
                }
                break;

            // ========== INFORMATIEVE PAGINA'S ==========
            case "contactformulier":
                // POST: verwerk contact formulier, anders: toon formulier
                if ("POST" === $method) {
                    $this->call("ContactController", "verzendFormulierAction");
                } else {
                    $this->call("ContactController", "contactformulierAction");
                }
                break;

            case "overons":
                // index.php?action=overons -> InfoController->overonsAction()
                $this->call("InfoController", "overonsAction");
                break;

            case "privacybeleid":
                // index.php?action=privacybeleid -> InfoController->privacybeleidAction()
                $this->call("InfoController", "privacybeleidAction");
                break;

            case "algemenevoorwaarden":
                // index.php?action=algemenevoorwaarden -> InfoController->algemenevoorwaardenAction()
                $this->call("InfoController", "algemenevoorwaardenAction");
                break;

            case "cookiebeleid":
                // index.php?action=cookiebeleid -> InfoController->cookiebeleidAction()
                $this->call("InfoController", "cookiebeleidAction");
                break;

            case "wishlist":
                $this->call("WishlistController", "wishlistAction");
                break;

            case "togglewishlist":
                if ("POST" === $method) {
                    $this->call("WishlistController", "toggleAction");
                } else {
                    $this->redirect("home");
                }
                break;

            case "verwijderenUitWishlist":
                if ("POST" === $method) {
                    $this->call("WishlistController", "verwijderAction");
                } else {
                    $this->redirect("wishlist");
                }
                break;

            case "wishlistdelen":
                $this->call("WishlistController", "deelbareWishlistAction");
                break;

            case "clearWishlist":
                $controller = new \App\Controllers\WishlistController();
                $controller->clearWishlistAction();
                break;

            default:
                // Onbekende action? Redirect naar startpagina
                $this->redirect("home");
        }
    }

    private function isProtectedRoute(string $action): bool
    {
        return in_array($action, $this->protectedRoutes, true);
    }

    private function isAuthenticated(): bool
    {
        if (PHP_SESSION_NONE === session_status()) session_start();

        // Controleer of gebruiker in sessie staat en vereiste velden heeft
        if (!isset($_SESSION["gebruiker"])) return false;

        $gebruiker = $_SESSION["gebruiker"];

        // Verifieer dat essentiële authenticatievelden aanwezig zijn
        return isset($gebruiker["gebruikersAccountId"], $gebruiker["emailadres"]);
    }

    // Sla de gevraagde actie op in sessie voor redirect na inloggen
    private function storeRequestedAction(string $action): void
    {
        if (PHP_SESSION_NONE === session_status()) session_start();

        $_SESSION["redirect"] = $action;
    }

    private function redirectToLogin(string $errorMessage): void
    {
        if (PHP_SESSION_NONE === session_status()) session_start();

        $_SESSION["error"] = $errorMessage;
        header("Location: index.php?action=loginformulier");
        exit;
    }


    // Voorloopbackslash zorgt voor absolute namespace resolutie vanaf root
    private function call(string $controller, string $method): void
    {
        // Bouw volledig gekwalificeerde klassenaam met absolute namespace (voorloopbackslash)
        $className = "\\App\\Controllers\\" . $controller;

        // Instantieer controller en roep method aan
        $instance = new $className();
        $instance->$method();
    }

    private function redirect(string $action): void
    {
        header("Location: index.php?action={$action}");
        exit;
    }
}
