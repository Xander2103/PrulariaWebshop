export function initTheme() {
    // Voeg de actieve thema-class toe aan <html> en <body>
    // Zo werken bestaande CSS-regels (bv. Bootstrap) overal
    var pageRoot = document.documentElement;
    var bodyRoot = document.body;

    // Alle thema-knoppen in de header (<button class="weergave-knop" data-theme="...">)
    var themeButtons = document.querySelectorAll(".weergave-knop[data-theme]");

    // LocalStorage key voor het opslaan van het geselecteerde thema
    var storageKey = "prularia-theme";

    // Toegestane thema's
    var themes = ["standaard", "hoog-contrast", "leesvriendelijk"];

    // Functie om een thema toe te passen
    function setTheme(theme) {
        // Kies standaard-thema als het opgegeven thema niet bestaat
        var activeTheme = themes.includes(theme) ? theme : "standaard";

        // Verwijder alle thema-classes op <html> en <body> ter voorbereiding om een gekozen thema toe te voegen
        themes.forEach(function (themeName) {
            pageRoot.classList.remove("theme-" + themeName);
            bodyRoot.classList.remove("theme-" + themeName);
        });

        // Voeg de nieuwe actieve thema-class toe
        pageRoot.classList.add("theme-" + activeTheme);
        bodyRoot.classList.add("theme-" + activeTheme);

        // Update de actieve status van de knoppen
        themeButtons.forEach(function (button) {
            var isActive = button.dataset.theme === activeTheme;
            button.classList.toggle("actief", isActive);
        });
    }

    // Haal uit localStorage en pas het opgeslagen thema toe bij het laden van de pagina
    var savedTheme = localStorage.getItem(storageKey) || "standaard";
    setTheme(savedTheme);

    // Voeg klik-events toe aan de knoppen om thema te wijzigen en sla op in LocalStorage
    themeButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var nextTheme = button.dataset.theme;
            setTheme(nextTheme);
            localStorage.setItem(
                storageKey,
                themes.includes(nextTheme) ? nextTheme : "standaard"
            );
        });
    });
}