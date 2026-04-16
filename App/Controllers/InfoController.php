<?php

declare(strict_types=1);

namespace App\Controllers;

class InfoController extends BaseController
{
    public function overonsAction(): void
    {
        // Data voor de Over Ons pagina
        $bedrijfsInfo = [
            "naam" => "Prularia",
            "slogan" => "Jouw partner voor kwalitatieve huishoudelijke artikelen",
            "beschrijving" => "Prularia is een toonaangevende webshop gespecialiseerd in huishoudelijke artikelen. 
                              Van emmers tot keukengerei, wij bieden een breed assortiment van kwaliteitsproducten 
                              voor al uw huishoudelijke behoeften.",
            "missie" => "Onze missie is om iedereen toegang te geven tot betaalbare, kwaliteitsvolle huishoudelijke 
                        producten met een snelle en betrouwbare service.",
            "visie" => "We streven ernaar de eerste keuze te zijn voor klanten die op zoek zijn naar 
                       betrouwbare huishoudelijke artikelen, met een focus op klanttevredenheid en duurzaamheid.",
            "email" => "info@prularia.be",
            "telefoon" => "+32 123 45 67",
            "adres" => "Prulariastraat 12, 1000 Brussel, België",
        ];

        $this->renderAction('Pages/over_ons', [
            'title' => 'Over Ons',
            'bedrijfsInfo' => $bedrijfsInfo
        ]);
    }

    public function privacybeleidAction(): void
    {
        $this->renderAction('Pages/privacybeleid', ['title' => 'Privacybeleid']);
    }

    public function algemenevoorwaardenAction(): void
    {
        $this->renderAction('Pages/algemenevoorwaarden', ['title' => 'Algemene voorwaarden']);
    }

    public function cookiebeleidAction(): void
    {
        $this->renderAction('Pages/cookiebeleid', ['title' => 'Cookiebeleid']);
    }
}
