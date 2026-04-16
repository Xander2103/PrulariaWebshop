export function initSpeech() {
    // Knop om voorlezen aan/uit te zetten
    var speechToggle = document.querySelector("[data-voorlezen-toggle]");

    // LocalStorage key voor voorlezen-status
    var speechStorageKey = "prularia-speech";

    // Browser ondersteunt text-to-speech?
    var canSpeak = "speechSynthesis" in window && "SpeechSynthesisUtterance" in window;

    // Houdt bij of voorlezen actief is
    var isSpeechEnabled = false;

    // Huidig element dat wordt voorgelezen
    var activeSpeechTarget = null;

    // CSS-selectors voor alle voorleesbare elementen
    var readableSelector = [
        "a",
        "button",
        "summary",
        "h1",
        "h2",
        "h3",
        "h4",
        "h5",
        "h6",
        "p",
        "label",
        "figcaption",
        "blockquote",
        "td",
        "th",
        "[data-voorlees-tekst]"
    ].join(", "); // Combineer tot één string

    // Stop alle lopende spraak
    function stopSpeech() {
        if (!canSpeak) return;
        window.speechSynthesis.cancel();
    }

    // Haal de “voorleesbare” tekst van een element op
    function getReadableText(element) {
        if (!element) return "";

        // Probeer aria-label eerst
        var ariaLabel = element.getAttribute("aria-label");
        if (ariaLabel) return ariaLabel.replace(/\s+/g, " ").trim();

        // Voor afbeeldingen: gebruik alt-tekst
        if (element.matches("img") && element.alt) {
            return element.alt.replace(/\s+/g, " ").trim();
        }

        // Voor input-buttons: gebruik value
        if (element.matches("input[type='button'], input[type='submit'], input[type='reset']") && element.value) {
            return element.value.replace(/\s+/g, " ").trim();
        }

        // Fallback: innerText / textContent
        var text = element.innerText || element.textContent || "";
        return text.replace(/\s+/g, " ").trim();
    }

    // Controleer of element zichtbaar is op scherm
    function isReadableElementVisible(element) {
        return !!(element && element.getClientRects && element.getClientRects().length);
    }

    // Update de UI van de toggle-knop
    function updateSpeechToggleState() {
        if (!speechToggle) return;
        speechToggle.classList.toggle("actief", isSpeechEnabled);
        speechToggle.setAttribute("aria-pressed", isSpeechEnabled ? "true" : "false");
        speechToggle.textContent = isSpeechEnabled ? "Voorlezen aan" : "Voorlezen uit";
    }

    // Zet voorlezen aan of uit
    function setSpeechEnabled(enabled) {
        isSpeechEnabled = !!enabled && canSpeak;
        document.body.classList.toggle("voorlezen-actief", isSpeechEnabled);
        activeSpeechTarget = null;

        updateSpeechToggleState();
        localStorage.setItem(speechStorageKey, isSpeechEnabled ? "aan" : "uit");

        if (!isSpeechEnabled) stopSpeech();
    }

    // Start het voorlezen van een tekst
    function speakText(text) {
        if (!canSpeak || !isSpeechEnabled || !text) return;

        var utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = "nl-BE";
        utterance.rate = 0.95;
        utterance.pitch = 1;

        stopSpeech();
        window.speechSynthesis.speak(utterance);
    }

    // Zoek het dichtstbijzijnde voorleesbare element vanaf het target
    function findReadableTarget(target) {
        if (!(target instanceof Element)) return null;
        return target.closest(readableSelector);
    }

    // Hover/focus handler: start voorlezen
    function handleReadableHover(target) {
        if (!isSpeechEnabled) return;

        var readableTarget = findReadableTarget(target);
        if (!readableTarget || !isReadableElementVisible(readableTarget)) return;
        if (readableTarget === activeSpeechTarget) return;

        var text = getReadableText(readableTarget);
        if (!text || text.length > 220) return; // skip lange teksten

        activeSpeechTarget = readableTarget;
        speakText(text);
    }

    // Mouseout/blur handler: stop voorlezen
    function handleReadableLeave(target, relatedTarget) {
        if (!isSpeechEnabled || !activeSpeechTarget || !(target instanceof Node)) return;
        if (!activeSpeechTarget.contains(target)) return;
        if (relatedTarget instanceof Node && activeSpeechTarget.contains(relatedTarget)) return;

        activeSpeechTarget = null;
        stopSpeech();
    }

    // Stoppen als knop niet aanwezig
    if (!speechToggle) return;

    // Browser ondersteunt geen TTS
    if (!canSpeak) {
        speechToggle.disabled = true;
        speechToggle.textContent = "Voorlezen niet beschikbaar";
        speechToggle.setAttribute("aria-pressed", "false");
        return;
    }

    // Initialiseer status uit localStorage
    setSpeechEnabled(localStorage.getItem(speechStorageKey) === "aan");

    // Toggle-knop event
    speechToggle.addEventListener("click", function () {
        setSpeechEnabled(!isSpeechEnabled);
    });

    // Globale events voor hover/focus
    document.addEventListener("mouseover", function (event) { handleReadableHover(event.target); });
    document.addEventListener("focusin", function (event) { handleReadableHover(event.target); });
    document.addEventListener("mouseout", function (event) { handleReadableLeave(event.target, event.relatedTarget); });
    document.addEventListener("focusout", function (event) { handleReadableLeave(event.target, event.relatedTarget); });

    // Stop spraak bij verlaten pagina
    window.addEventListener("beforeunload", stopSpeech);
}