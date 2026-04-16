<!-- login.php - Login formulier voor klanten -->

<main class="container">
    <div class="login-container">
        <h1>Inloggen</h1>

        <?php if (isset($error) && null !== $error): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success) && null !== $success): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=login" class="login-form">
            <div class="form-group">
                <label for="emailadres">E-mailadres:</label>
                <input 
                    type="email" 
                    id="emailadres" 
                    name="emailadres" 
                    class="form-control" 
                    required 
                    placeholder="voorbeeld@email.com"
                    value="<?= htmlspecialchars($_POST['emailadres'] ?? '') ?>"
                >
            </div>

            <div class="form-group">
                <label for="paswoord">Wachtwoord:</label>
                <input 
                    type="password" 
                    id="paswoord" 
                    name="paswoord" 
                    class="form-control" 
                    required 
                    placeholder="Uw wachtwoord"
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Inloggen</button>
                <a href="index.php?action=registratieformulier" class="btn btn-secondary">Nog geen account? Registreer</a>
            </div>
        </form>

        <div class="login-info">
            <h3>Testgegevens</h3>
            <p><strong>Natuurlijke persoon:</strong></p>
            <ul>
                <li>Email: alpha.klant@bestaatniet.be</li>
                <li>Wachtwoord: KlantVanPrularia</li>
            </ul>
            <p><strong>Rechtspersoon (VDAB):</strong></p>
            <ul>
                <li>Email: ad.ministrateur@vdab.be</li>
                <li>Wachtwoord: KlantVanPrularia</li>
            </ul>
        </div>
    </div>
</main>
