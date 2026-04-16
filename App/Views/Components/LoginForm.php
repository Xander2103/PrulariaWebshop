<div class="container mt-5 loginForm">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="card-title text-center mb-0 mt-2">Inloggen</h3>
                </div>
                <div class="card-body p-4">
                    <form action="?action=login" method="POST">
                        <div class="mb-3">
                            <label for="emailadres" class="form-label">E-mailadres</label>
                            <input type="email" class="form-control" id="emailadres" name="emailadres" placeholder="naam@voorbeeld.be" required>
                        </div>
                        <div class="mb-3">
                            <label for="paswoord" class="form-label">Wachtwoord</label>
                            <input type="password" class="form-control" id="paswoord" name="paswoord" required placeholder="wachtwoord123!">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Onthoud mij</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn text-white w-100 buttonLogin">Inloggen</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-light">
                    <small><b>Nog geen account? </b><a href="?action=registratieformulier"><span class="registreerHier">Registreer hier</span></a></small>
                </div>
            </div>
        </div>
    </div>
</div>