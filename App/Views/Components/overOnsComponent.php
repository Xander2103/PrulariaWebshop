<div class="info-page">

    <div class="info-page__container">

        <h1>Over Prularia</h1>
        <p class="text-center mb-5 ingangsDatum">Uw partner in huishoudelijke kwaliteit</p>

        <h2><?= htmlspecialchars($bedrijfsInfo['slogan']) ?></h2>
        <p>
            <?= nl2br(htmlspecialchars($bedrijfsInfo['beschrijving'])) ?>
        </p>

        <h2>Onze Missie</h2>
        <p>
            <?= nl2br(htmlspecialchars($bedrijfsInfo['missie'])) ?>
        </p>

        <h2>Onze Visie</h2>
        <p>
            <?= nl2br(htmlspecialchars($bedrijfsInfo['visie'])) ?>
        </p>

        <h2>Waarom kiezen voor Prularia?</h2>
        <p><strong>Kwaliteit:</strong> Alleen de beste producten voor uw huishouden</p>
        <p><strong>Snelle Levering:</strong> Uw bestelling snel bij u thuis</p>
        <p><strong>Klantenservice:</strong> Altijd klaar om u te helpen</p>

        <h2>Contact</h2>
        <p>
            E-mail:
            <a href="mailto:<?= htmlspecialchars($bedrijfsInfo['email']) ?>">
                <?= htmlspecialchars($bedrijfsInfo['email']) ?>
            </a>
        </p>

        <p>
            Telefoon:
            <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $bedrijfsInfo['telefoon'])) ?>">
                <?= htmlspecialchars($bedrijfsInfo['telefoon']) ?>
            </a>
        </p>

        <p>
            <?= nl2br(htmlspecialchars($bedrijfsInfo['adres'])) ?>
        </p>

        <p>
            <a href="?action=home">Terug naar Home</a>
        </p>

    </div>

</div>