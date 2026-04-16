<?php

namespace App\Controllers;

use App\Services\ContactService;

class ContactController extends BaseController
{
    private ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function contactformulierAction(): void
    {
        $subLayout = __DIR__ . '/../Views/Pages/contactformulier.php';
        require_once __DIR__ . '/../Views/Template/layout.php';
    }

    public function verzendFormulierAction(): void
    {
        $naam = $_POST['naam'] ?? '';
        $email = $_POST['email'] ?? '';
        $bericht = $_POST['bericht'] ?? '';
        $onderwerp = $_POST['onderwerp'] ?? '';

        if (empty($naam) || empty($email) || empty($onderwerp) || empty($bericht)) {
            header('Location: index.php?action=contactformulier&error=1');
            exit;
        }

        $this->contactService->verzendContactformulier($naam, $email, $onderwerp, $bericht);

        header('Location: index.php?action=contactformulier&success=1');
        exit;
    }
}
