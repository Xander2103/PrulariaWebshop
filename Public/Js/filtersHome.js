document.addEventListener("DOMContentLoaded", function () {

    // ── Checkbox “Alleen op voorraad” ──
    const checkbox = document.getElementById("opVoorraad");
    if (checkbox) {
        const params = new URLSearchParams(window.location.search);
        if (params.get("opVoorraad") === "1") checkbox.checked = true;

        checkbox.addEventListener("change", function () {
            const url = new URL(window.location.href); // fresh URL
            if (this.checked) {
                url.searchParams.set("opVoorraad", "1");
            } else {
                url.searchParams.delete("opVoorraad");
            }
            window.location.href = url.toString();
        });
    }

    // ── Min/Max prijs sliders ──
    const minSlider = document.getElementById("minPrijs");
    const maxSlider = document.getElementById("maxPrijs");
    const minValue = document.getElementById("minValue");
    const maxValue = document.getElementById("maxValue");

    if (minSlider && maxSlider && minValue && maxValue) {
        const params = new URLSearchParams(window.location.search);
        if (params.get("minPrijs")) minSlider.value = params.get("minPrijs");
        if (params.get("maxPrijs")) maxSlider.value = params.get("maxPrijs");

        minValue.textContent = minSlider.value;
        maxValue.textContent = maxSlider.value;

        function checkSliders() {
            const minVal = parseInt(minSlider.value, 10);
            let maxVal = parseInt(maxSlider.value, 10);
            if (maxVal < minVal) {
                maxVal = minVal;
                maxSlider.value = maxVal;
            }
            minValue.textContent = minVal;
            maxValue.textContent = maxVal;
        }

        minSlider.addEventListener("input", checkSliders);
        maxSlider.addEventListener("input", checkSliders);

        function updateSlidersURL() {
            const url = new URL(window.location.href); // fresh URL
            url.searchParams.set("minPrijs", minSlider.value);
            url.searchParams.set("maxPrijs", maxSlider.value);
            window.location.href = url.toString();
        }

        minSlider.addEventListener("change", updateSlidersURL);
        maxSlider.addEventListener("change", updateSlidersURL);

        checkSliders(); // initial check
    }

    // ── Zoekveld ──
    const zoekveld = document.getElementById("zoekveld");
    if (zoekveld) {
        // Vul bij pageload uit GET
        const params = new URLSearchParams(window.location.search);
        if (params.get("zoektekst")) zoekveld.value = params.get("zoektekst");

        zoekveld.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                const zoekTerm = zoekveld.value.trim();
                const url = new URL(window.location.href); // fresh URL
                if (zoekTerm) {
                    url.searchParams.set("zoektekst", zoekTerm);
                } else {
                    url.searchParams.delete("zoektekst");
                }
                window.location.href = url.toString();
            }
        });
    }

    // ── Reset filters knop ──
    const resetBtn = document.getElementById("resetFilters");
    if (resetBtn) {
        resetBtn.addEventListener("click", function (e) {
            e.preventDefault();
            const url = new URL(window.location.href); // fresh URL
            ["opVoorraad", "minPrijs", "maxPrijs", "zoektekst", "sorteer"].forEach(param => url.searchParams.delete(param));
            window.location.href = url.toString();
        });
    }

});