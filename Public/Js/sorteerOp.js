document.addEventListener("DOMContentLoaded", function () {

    const sorteer = document.getElementById("sorteer");
    if (!sorteer) return; // check of element bestaat

    // ── Zet bij pageload de geselecteerde optie op basis van URL ──
    const params = new URLSearchParams(window.location.search);
    if (params.get("sorteer")) {
        sorteer.value = params.get("sorteer");
    }

    // ── Luister naar wijziging van de dropdown ──
    sorteer.addEventListener("change", function () {
        const url = new URL(window.location.href); // fresh URL object
        const waarde = this.value;

        if (waarde) {
            url.searchParams.set("sorteer", waarde);
        } else {
            url.searchParams.delete("sorteer");
        }

        // Pagina herladen met nieuwe parameter
        window.location.href = url.toString();
    });

    const resetBtn = document.getElementById("resetFilters");
    if (resetBtn) {
        resetBtn.addEventListener("click", function (e) {
            e.preventDefault();
            const url = new URL(window.location.href);

            // Alle filterparameters verwijderen
            ["opVoorraad", "minPrijs", "maxPrijs", "zoektekst", "sorteer"].forEach(param => {
                url.searchParams.delete(param);
            });

            // Pagina herladen zonder filters
            window.location.href = url.toString();
        });
    }


});