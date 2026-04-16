// registratieformulier.js - formulier: Account of Gast registratie

document.addEventListener("DOMContentLoaded", function() {
    // Haal elementen op
    const form = document.getElementById("registratieForm");
    const radioAccount = document.getElementById("radioAccount");
    const radioGast = document.getElementById("radioGast");
    const radioParticulier = document.getElementById("radioParticulier");
    const radioBedrijf = document.getElementById("radioBedrijf");
    const sectieParticulier = document.getElementById("sectieParticulier");
    const sectieBedrijf = document.getElementById("sectieBedrijf");
    const verschillendAdres = document.getElementById("verschillendAdres");
    const leveringsadresVelden = document.getElementById("leveringsadresVelden");
    
    // Account vs Gast elementen
    const wachtwoordSectie = document.getElementById("wachtwoordSectie");
    const accountPromo = document.getElementById("accountPromo");
    const maakAccountAan = document.getElementById("maakAccountAan");
    const gastWachtwoordVelden = document.getElementById("gastWachtwoordVelden");
    const submitButton = document.getElementById("submitButton");
    const submitTextAccount = document.getElementById("submitTextAccount");
    const submitTextGast = document.getElementById("submitTextGast");
    
    // Wachtwoord velden (account)
    const paswoord = document.getElementById("paswoord");
    const paswoordBevestiging = document.getElementById("paswoordBevestiging");
    const paswoordFeedback = document.getElementById("paswoordFeedback");
    const paswoordMatchFeedback = document.getElementById("paswoordMatchFeedback");
    
    // Wachtwoord velden (gast optioneel)
    const gastPaswoord = document.getElementById("gastPaswoord");
    const gastPaswoordBevestiging = document.getElementById("gastPaswoordBevestiging");
    const gastPaswoordFeedback = document.getElementById("gastPaswoordFeedback");
    const gastPaswoordMatchFeedback = document.getElementById("gastPaswoordMatchFeedback");
    
    // === REGISTRATIE TYPE: ACCOUNT OF GAST ===
    function updateRegistratieType() {
        if (radioAccount && radioAccount.checked) {
            // Account aanmaken: toon wachtwoord sectie, verberg gast promo
            if (wachtwoordSectie) {
                wachtwoordSectie.style.display = "block";
                paswoord.required = true;
                paswoordBevestiging.required = true;
            }
            if (accountPromo) {
                accountPromo.style.display = "none";
                if (maakAccountAan) maakAccountAan.checked = false;
                if (gastWachtwoordVelden) gastWachtwoordVelden.style.display = "none";
                if (gastPaswoord) gastPaswoord.required = false;
                if (gastPaswoordBevestiging) gastPaswoordBevestiging.required = false;
            }
            if (submitTextAccount) submitTextAccount.style.display = "inline";
            if (submitTextGast) submitTextGast.style.display = "none";
            
            // Zet form action naar register
            form.action = "index.php?action=register";
            
        } else if (radioGast && radioGast.checked) {
            // Als gast: verberg wachtwoord sectie, toon promo
            if (wachtwoordSectie) {
                wachtwoordSectie.style.display = "none";
                paswoord.required = false;
                paswoordBevestiging.required = false;
            }
            if (accountPromo) {
                accountPromo.style.display = "block";
            }
            if (submitTextAccount) submitTextAccount.style.display = "none";
            if (submitTextGast) submitTextGast.style.display = "inline";
            
            // Zet form action naar gastregistratie
            form.action = "index.php?action=gastregistratie";
        }
    }
    
    if (radioAccount) radioAccount.addEventListener("change", updateRegistratieType);
    if (radioGast) radioGast.addEventListener("change", updateRegistratieType);
    
    // === GAST: ACCOUNT AANMAKEN OPTIE ===
    if (maakAccountAan && gastWachtwoordVelden && gastPaswoord && gastPaswoordBevestiging) {
        function updateGastAccountOptie() {
            if (maakAccountAan.checked) {
                gastWachtwoordVelden.style.display = "block";
                gastPaswoord.required = true;
                gastPaswoordBevestiging.required = true;
                
                // Kopieer wachtwoord naar normale velden voor backend
                gastPaswoord.name = "paswoord";
                gastPaswoordBevestiging.name = "paswoordBevestiging";
            } else {
                gastWachtwoordVelden.style.display = "none";
                gastPaswoord.required = false;
                gastPaswoordBevestiging.required = false;
                
                // Reset validatie feedback
                gastPaswoord.classList.remove("is-invalid", "is-valid");
                gastPaswoordBevestiging.classList.remove("is-invalid", "is-valid");
                if (gastPaswoordFeedback) gastPaswoordFeedback.style.display = "none";
                if (gastPaswoordMatchFeedback) gastPaswoordMatchFeedback.style.display = "none";
                
                // Reset name attributes
                gastPaswoord.name = "gastPaswoord";
                gastPaswoordBevestiging.name = "gastPaswoordBevestiging";
            }
        }
        
        maakAccountAan.addEventListener("change", updateGastAccountOptie);
    }
    
    // === PARTICULIER VS BEDRIJF TOGGLE ===
    if (radioParticulier && radioBedrijf && sectieParticulier && sectieBedrijf) {
        function updateSecties() {
            if (radioParticulier.checked) {
                sectieParticulier.style.display = "block";
                sectieBedrijf.style.display = "none";
                
                // Maak particulier velden verplicht
                document.getElementById("voornaam").required = true;
                document.getElementById("familienaam").required = true;
                
                // Maak bedrijf velden niet verplicht
                document.getElementById("bedrijfsnaam").required = false;
                document.getElementById("btwNummer").required = false;
                document.getElementById("contactVoornaam").required = false;
                document.getElementById("contactFamilienaam").required = false;
                document.getElementById("functie").required = false;
            } else {
                sectieParticulier.style.display = "none";
                sectieBedrijf.style.display = "block";
                
                // Maak particulier velden niet verplicht
                document.getElementById("voornaam").required = false;
                document.getElementById("familienaam").required = false;
                
                // Maak bedrijf velden verplicht
                document.getElementById("bedrijfsnaam").required = true;
                document.getElementById("btwNummer").required = true;
                document.getElementById("contactVoornaam").required = true;
                document.getElementById("contactFamilienaam").required = true;
            }
        }
        
        radioParticulier.addEventListener("change", updateSecties);
        radioBedrijf.addEventListener("change", updateSecties);
        updateSecties(); // Initialiseer
    }
    
    // === LEVERINGSADRES TOGGLE ===
    if (verschillendAdres && leveringsadresVelden) {
        function updateLeveringsadres() {
            if (verschillendAdres.checked) {
                leveringsadresVelden.style.display = "block";
                const leverStraat = document.getElementById("leverStraat");
                const leverHuisNummer = document.getElementById("leverHuisNummer");
                const leverPostcode = document.getElementById("leverPostcode");
                const leverPlaats = document.getElementById("leverPlaats");
                
                if (leverStraat) leverStraat.required = true;
                if (leverHuisNummer) leverHuisNummer.required = true;
                if (leverPostcode) leverPostcode.required = true;
                if (leverPlaats) leverPlaats.required = true;
            } else {
                leveringsadresVelden.style.display = "none";
                const leverStraat = document.getElementById("leverStraat");
                const leverHuisNummer = document.getElementById("leverHuisNummer");
                const leverPostcode = document.getElementById("leverPostcode");
                const leverPlaats = document.getElementById("leverPlaats");
                
                if (leverStraat) leverStraat.required = false;
                if (leverHuisNummer) leverHuisNummer.required = false;
                if (leverPostcode) leverPostcode.required = false;
                if (leverPlaats) leverPlaats.required = false;
            }
        }
        
        verschillendAdres.addEventListener("change", updateLeveringsadres);
        updateLeveringsadres(); // Initialiseer
    }
    
    // === WACHTWOORD VALIDATIE (ACCOUNT) ===
    if (paswoord && paswoordBevestiging && paswoordFeedback && paswoordMatchFeedback) {
        function validatePaswoord() {
            // Skip als gastkeuze actief is
            if (radioGast && radioGast.checked) return;
            
            const value = paswoord.value;
            const hasUppercase = /[A-Z]/.test(value);
            const hasDigit = /[0-9]/.test(value);
            const hasMinLength = value.length >= 8;
            
            if (value.length === 0) {
                paswoordFeedback.textContent = "";
                paswoord.classList.remove("is-invalid", "is-valid");
                return;
            }
            
            if (!hasMinLength || !hasUppercase || !hasDigit) {
                paswoord.classList.add("is-invalid");
                paswoord.classList.remove("is-valid");
                
                let errors = [];
                if (!hasMinLength) errors.push("minimaal 8 karakters");
                if (!hasUppercase) errors.push("1 hoofdletter");
                if (!hasDigit) errors.push("1 cijfer");
                
                paswoordFeedback.textContent = "Ontbrekend: " + errors.join(", ");
                paswoordFeedback.style.display = "block";
            } else {
                paswoord.classList.remove("is-invalid");
                paswoord.classList.add("is-valid");
                paswoordFeedback.style.display = "none";
            }
            
            validatePaswoordMatch();
        }
        
        function validatePaswoordMatch() {
            if (radioGast && radioGast.checked) return;
            
            if (paswoordBevestiging.value.length === 0) {
                paswoordMatchFeedback.textContent = "";
                paswoordBevestiging.classList.remove("is-invalid", "is-valid");
                return;
            }
            
            if (paswoord.value !== paswoordBevestiging.value) {
                paswoordBevestiging.classList.add("is-invalid");
                paswoordBevestiging.classList.remove("is-valid");
                paswoordMatchFeedback.textContent = "Wachtwoorden komen niet overeen";
                paswoordMatchFeedback.style.display = "block";
            } else {
                paswoordBevestiging.classList.remove("is-invalid");
                paswoordBevestiging.classList.add("is-valid");
                paswoordMatchFeedback.style.display = "none";
            }
        }
        
        paswoord.addEventListener("input", validatePaswoord);
        paswoordBevestiging.addEventListener("input", validatePaswoordMatch);
    }
    
    // === WACHTWOORD VALIDATIE (GAST OPTIONEEL) ===
    if (gastPaswoord && gastPaswoordBevestiging && gastPaswoordFeedback && gastPaswoordMatchFeedback) {
        function validateGastPaswoord() {
            if (!maakAccountAan || !maakAccountAan.checked) return;
            
            const value = gastPaswoord.value;
            const hasUppercase = /[A-Z]/.test(value);
            const hasDigit = /[0-9]/.test(value);
            const hasMinLength = value.length >= 8;
            
            if (value.length === 0) {
                gastPaswoordFeedback.textContent = "";
                gastPaswoord.classList.remove("is-invalid", "is-valid");
                return;
            }
            
            if (!hasMinLength || !hasUppercase || !hasDigit) {
                gastPaswoord.classList.add("is-invalid");
                gastPaswoord.classList.remove("is-valid");
                
                let errors = [];
                if (!hasMinLength) errors.push("minimaal 8 karakters");
                if (!hasUppercase) errors.push("1 hoofdletter");
                if (!hasDigit) errors.push("1 cijfer");
                
                gastPaswoordFeedback.textContent = "Ontbrekend: " + errors.join(", ");
                gastPaswoordFeedback.style.display = "block";
            } else {
                gastPaswoord.classList.remove("is-invalid");
                gastPaswoord.classList.add("is-valid");
                gastPaswoordFeedback.style.display = "none";
            }
            
            validateGastPaswoordMatch();
        }
        
        function validateGastPaswoordMatch() {
            if (!maakAccountAan || !maakAccountAan.checked) return;
            
            if (gastPaswoordBevestiging.value.length === 0) {
                gastPaswoordMatchFeedback.textContent = "";
                gastPaswoordBevestiging.classList.remove("is-invalid", "is-valid");
                return;
            }
            
            if (gastPaswoord.value !== gastPaswoordBevestiging.value) {
                gastPaswoordBevestiging.classList.add("is-invalid");
                gastPaswoordBevestiging.classList.remove("is-valid");
                gastPaswoordMatchFeedback.textContent = "Wachtwoorden komen niet overeen";
                gastPaswoordMatchFeedback.style.display = "block";
            } else {
                gastPaswoordBevestiging.classList.remove("is-invalid");
                gastPaswoordBevestiging.classList.add("is-valid");
                gastPaswoordMatchFeedback.style.display = "none";
            }
        }
        
        gastPaswoord.addEventListener("input", validateGastPaswoord);
        gastPaswoordBevestiging.addEventListener("input", validateGastPaswoordMatch);
    }
    
    // === INITIALISATIE ===
    updateRegistratieType();
});
