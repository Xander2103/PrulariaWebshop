<?php

namespace App\Services;

class ContactService
{
    public function verzendContactformulier(string $naam, string $email, string $onderwerp, string $bericht): void
    {
        //bedrijfsmail moet nog ingevoerd worden!!
        //Momenteel krijg je mail niet want is lokaal en kan Gmail/Outlook soms moeilijk doen, omdat jij zogezegd mailt “vanuit” een willekeurig user-adres.
        $ontvanger = 'ZetUwMail@VDABCampus.be';
        $mailOnderwerp = sprintf('Nieuw bericht via contactformulier: %s', $onderwerp);

        $inhoud = sprintf(
            "Naam: %s\nE-mail: %s\nOnderwerp: %s\n\nBericht:\n%s",
            $naam,
            $email,
            $onderwerp,
            $bericht
        );

        $headers = sprintf(
            "From: %s\r\nReply-To: %s\r\n",
            $email,
            $email
        );

        mail($ontvanger, $mailOnderwerp, $inhoud, $headers);
    }
}
