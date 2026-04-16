// profielformulier.js - Real-time validatie voor profiel bewerkingsformulieren

document.addEventListener("DOMContentLoaded", function() {
    
    // === PERSOONLIJKE GEGEVENS VALIDATIE ===
    const voornaam = document.getElementById("voornaam");
    const familienaam = document.getElementById("familienaam");
    const bedrijfsnaam = document.getElementById("bedrijfsnaam");
    const btwNummer = document.getElementById("btwNummer");
    
    // Helper functie voor tekst validatie (niet leeg, min 2 karakters)
    function validateTextField(field) {
        if (!field) return;
        
        const value = field.value.trim();
        
        if (value.length === 0) {
            field.classList.remove("is-invalid", "is-valid");
            return;
        }
        
        if (value.length < 2) {
            field.classList.add("is-invalid");
            field.classList.remove("is-valid");
        } else {
            field.classList.remove("is-invalid");
            field.classList.add("is-valid");
        }
    }
    
    // Voornaam validatie
    if (voornaam) {
        voornaam.addEventListener("input", function() {
            validateTextField(voornaam);
        });
    }
    
    // Familienaam validatie
    if (familienaam) {
        familienaam.addEventListener("input", function() {
            validateTextField(familienaam);
        });
    }
    
    // Bedrijfsnaam validatie
    if (bedrijfsnaam) {
        bedrijfsnaam.addEventListener("input", function() {
            validateTextField(bedrijfsnaam);
        });
    }
    
    // BTW nummer validatie (min 10 karakters voor BE format)
    if (btwNummer) {
        btwNummer.addEventListener("input", function() {
            const value = btwNummer.value.trim();
            
            if (value.length === 0) {
                btwNummer.classList.remove("is-invalid", "is-valid");
                return;
            }
            
            if (value.length < 10) {
                btwNummer.classList.add("is-invalid");
                btwNummer.classList.remove("is-valid");
            } else {
                btwNummer.classList.remove("is-invalid");
                btwNummer.classList.add("is-valid");
            }
        });
    }
    
    // === FACTURATIEADRES VALIDATIE ===
    const factStraat = document.getElementById("facturatie_straat");
    const factHuisNummer = document.getElementById("facturatie_huisNummer");
    const factPostcode = document.getElementById("facturatie_postcode");
    
    if (factStraat) {
        factStraat.addEventListener("input", function() {
            validateTextField(factStraat);
        });
    }
    
    if (factHuisNummer) {
        factHuisNummer.addEventListener("input", function() {
            const value = factHuisNummer.value.trim();
            
            if (value.length === 0) {
                factHuisNummer.classList.remove("is-invalid", "is-valid");
                return;
            }
            
            if (value.length < 1) {
                factHuisNummer.classList.add("is-invalid");
                factHuisNummer.classList.remove("is-valid");
            } else {
                factHuisNummer.classList.remove("is-invalid");
                factHuisNummer.classList.add("is-valid");
            }
        });
    }
    
    if (factPostcode) {
        factPostcode.addEventListener("input", function() {
            validatePostcode(factPostcode);
        });
    }
    
    // === LEVERINGSADRES VALIDATIE ===
    const leverStraat = document.getElementById("levering_straat");
    const leverHuisNummer = document.getElementById("levering_huisNummer");
    const leverPostcode = document.getElementById("levering_postcode");
    
    if (leverStraat) {
        leverStraat.addEventListener("input", function() {
            validateTextField(leverStraat);
        });
    }
    
    if (leverHuisNummer) {
        leverHuisNummer.addEventListener("input", function() {
            const value = leverHuisNummer.value.trim();
            
            if (value.length === 0) {
                leverHuisNummer.classList.remove("is-invalid", "is-valid");
                return;
            }
            
            if (value.length < 1) {
                leverHuisNummer.classList.add("is-invalid");
                leverHuisNummer.classList.remove("is-valid");
            } else {
                leverHuisNummer.classList.remove("is-invalid");
                leverHuisNummer.classList.add("is-valid");
            }
        });
    }
    
    if (leverPostcode) {
        leverPostcode.addEventListener("input", function() {
            validatePostcode(leverPostcode);
        });
    }
    
    // === POSTCODE VALIDATIE FUNCTIE ===
    function validatePostcode(field) {
        if (!field) return;
        
        const value = field.value.trim();
        
        if (value.length === 0) {
            field.classList.remove("is-invalid", "is-valid");
            return;
        }
        
        // Belgische postcode: exact 4 cijfers
        const postcodePattern = /^[0-9]{4}$/;
        
        if (!postcodePattern.test(value)) {
            field.classList.add("is-invalid");
            field.classList.remove("is-valid");
        } else {
            field.classList.remove("is-invalid");
            field.classList.add("is-valid");
        }
    }
    
    // === FORM SUBMIT VALIDATIE ===
    const forms = document.querySelectorAll('form[method="POST"]');
    
    forms.forEach(function(form) {
        form.addEventListener("submit", function(event) {
            // Browser's eigen validatie laten werken
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            // Bootstrap validatie classes toevoegen aan alle velden
            const inputs = form.querySelectorAll('input[required]:not([disabled])');
            inputs.forEach(function(input) {
                if (input.value.trim().length === 0) {
                    input.classList.add("is-invalid");
                    input.classList.remove("is-valid");
                } else {
                    // Check pattern indien aanwezig
                    if (input.hasAttribute("pattern")) {
                        const pattern = new RegExp(input.getAttribute("pattern"));
                        if (pattern.test(input.value)) {
                            input.classList.remove("is-invalid");
                            input.classList.add("is-valid");
                        } else {
                            input.classList.add("is-invalid");
                            input.classList.remove("is-valid");
                        }
                    } else {
                        input.classList.remove("is-invalid");
                        input.classList.add("is-valid");
                    }
                }
            });
            
            form.classList.add("was-validated");
        });
    });
});
