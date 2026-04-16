import { initTheme } from "./theme.js";
import { initSpeech } from "./speech.js";

//Voer deze code pas uit als de HTML volledig geladen is
document.addEventListener("DOMContentLoaded", function () {
    initTheme();
    initSpeech();
});