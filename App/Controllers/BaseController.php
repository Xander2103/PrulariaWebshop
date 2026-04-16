<?php
// BaseController.php - Base class voor alle controllers

declare(strict_types=1);

namespace App\Controllers;

abstract class BaseController
{
    protected ?string $error = null;
    protected ?string $success = null;
    protected mixed $gebruiker = null;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $this->checkSessionTimeout();
        $this->loadFlashMessages();
        $this->gebruiker = $_SESSION["gebruiker"] ?? null;
    }

    private function checkSessionTimeout(): void
    {
        // Check of er een gebruiker ingelogd is
        if (!isset($_SESSION["gebruiker"])) {
            return;
        }

        // Check of laatste activiteit is geregistreerd
        if (!isset($_SESSION["last_activity"])) {
            $_SESSION["last_activity"] = time();
            return;
        }

        // Bereken hoeveel tijd er verstreken is sinds laatste activiteit
        $inactiveTime = time() - $_SESSION["last_activity"];

        // Als timeout bereikt is, log uit
        if ($inactiveTime > \Config\AppConfig::SESSION_TIMEOUT) {
            unset($_SESSION["gebruiker"]);
            unset($_SESSION["last_activity"]);
            $_SESSION["error"] = "Uw sessie is verlopen door inactiviteit. Log opnieuw in.";
            return;
        }

        // Update laatste activiteit
        $_SESSION["last_activity"] = time();
    }


    private function loadFlashMessages(): void
    {
        $this->error = $_SESSION["error"] ?? null;
        $this->success = $_SESSION["success"] ?? null;
        unset($_SESSION["error"], $_SESSION["success"]);
    }

    protected function renderAction(string $template, array $data = []): void
    {
        // Maak controller eigenschappen en interne variabelen EERST beschikbaar
        // Dit beschermt ze tegen overschrijven door extract()
        $error = $this->error;
        $success = $this->success;
        $gebruiker = $this->gebruiker;
        
        // Extraheer data array met EXTR_SKIP om overschrijven van bestaande variabelen te voorkomen
        // Dit beschermt: $error, $success, $gebruiker, $template
        extract($data, EXTR_SKIP);
        
        // Voeg automatisch .php toe als er geen extensie is
        if (!str_contains($template, '.')) {
            $template .= '.php';
        }
        
        // Layout.php verwacht $subLayout in plaats van $viewFile
        $subLayout = __DIR__ . "/../Views/" . $template;
        require __DIR__ . "/../Views/Template/layout.php";
    }

    protected function redirectAction(string $action, ?string $error = null, ?string $success = null, ?string $hash = null): void
    {
        if (null !== $error && "" !== trim($error)) $_SESSION["error"] = $error;
        if (null !== $success && "" !== trim($success)) $_SESSION["success"] = $success;

        $url = "index.php?action={$action}";
        if (null !== $hash && "" !== trim($hash))  $url .= "#{$hash}";

        header("Location: {$url}");
        exit;
    }

    protected function getIdFromGetOrPostAction(string $paramName = "id"): int
    {
        return (int) ($_GET[$paramName] ?? $_POST[$paramName] ?? 0);
    }

    protected function getStringFromPostAction(string $paramName): string
    {
        return trim($_POST[$paramName] ?? "");
    }

    // redirect na login/registratie: 1) sessie redirect, 2) GET param, 3) POST param
    protected function getRedirectTargetAction(): ?string
    {
        // Prioriteit: 1) Sessie (auto-redirect), 2) GET param, 3) POST param
        $redirect = $_SESSION["redirect"] ?? $_GET["redirect"] ?? $_POST["redirect"] ?? null;
        
        // Wis sessie redirect na lezen om herhaalde redirects te voorkomen
        if (isset($_SESSION["redirect"])) unset($_SESSION["redirect"]);
        
        return $redirect;
    }

    protected function isIngelogd(): bool
    {
        return isset($_SESSION["gebruiker"]);
    }

    protected function getIngelogdeGebruiker(): ?array
    {
        return $_SESSION["gebruiker"] ?? null;
    }

    protected function requireLogin(string $redirectAction = "loginformulier", string $errorMessage = "U moet ingelogd zijn om deze pagina te bekijken."): void
    {
        if (!$this->isIngelogd()) {
            $this->redirectAction($redirectAction, $errorMessage);
        }
    }

}