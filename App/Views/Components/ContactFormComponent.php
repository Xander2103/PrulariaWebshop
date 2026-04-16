<section class="contact-card">
    <h2>Contactformulier naar bedrijf</h2>

    <?php if (isset($_GET['success'])): ?>
        <p class="contact-message success-message">Uw bericht werd succesvol verzonden.</p>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <p class="contact-message error-message">Gelieve alle velden correct in te vullen.</p>
    <?php endif; ?>

    <form method="post" action="index.php?action=contactformulier" class="contact-form">
        <div class="form-group">
            <label for="naam">Naam</label>
            <input type="text" id="naam" name="naam">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="onderwerp">Onderwerp</label>
            <input type="text" id="onderwerp" name="onderwerp">
        </div>

        <div class="form-group">
            <label for="bericht">Bericht</label>
            <textarea id="bericht" name="bericht" rows="6"></textarea>
        </div>

        <button type="submit" class="contact-button">Versturen</button>
    </form>
</section>