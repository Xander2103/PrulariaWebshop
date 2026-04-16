<!-- actiecodes.php - Overzicht van actiecodes -->

<?php
global $baseUrl;

// Defensive programming: check of actiecodes is gezet
$actiecodes = $actiecodes ?? [];
$aantalBestellingenMetActiecodes = $aantalBestellingenMetActiecodes ?? 0;
?>

<main class="container my-5">
    <div class="actiecodes-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Mijn Actiecodes</h1>
                <p class=" mb-0">
                    <small>Overzicht van actiecodes van afgelopen 6 maanden</small>
                </p>
            </div>
            <a href="?action=home" class="btn btn-outline-secondary">
                &larr; Terug naar shop
            </a>
        </div>

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

        <!-- Info over gebruikte actiecodes -->
        <?php if ($aantalBestellingenMetActiecodes > 0): ?>
            <div class="alert alert-info mb-4">
                <strong>🎉 Geweldig!</strong> U heeft al <strong><?= $aantalBestellingenMetActiecodes ?></strong> 
                keer een actiecode gebruikt bij uw bestellingen.
            </div>
        <?php endif; ?>

        <?php if (empty($actiecodes)): ?>
            <!-- Geen actiecodes -->
            <div class="card text-center py-5">
                <div class="card-body">
                    <h3 class="text-muted mb-3">🏷️ Geen actiecodes beschikbaar</h3>
                    <p class="text-muted mb-4">
                        Er zijn momenteel geen actiecodes beschikbaar van de afgelopen 6 maanden.<br>
                        Blijf onze nieuwsbrief volgen voor nieuwe acties!
                    </p>
                    <a href="?action=home" class="btn btn-primary">
                        Naar de shop
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Actiecodes tabel -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Actiecode</th>
                            <th>Geldig vanaf</th>
                            <th>Geldig tot</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($actiecodes as $actiecode): ?>
                            <?php
                            $naam = $actiecode->getNaam();
                            $geldigVan = $actiecode->getGeldigVanDatum();
                            $geldigTot = $actiecode->getGeldigTotDatum();
                            $isEenmalig = $actiecode->isEenmalig();
                            $isGeldig = $actiecode->isGeldig();
                            
                            // Status badge kleur bepalen
                            $now = new DateTime();
                            if ($now < $geldigVan) {
                                $statusTekst = 'Binnenkort';
                                $statusBadgeClass = 'bg-secondary';
                            } elseif ($isGeldig) {
                                $statusTekst = 'Actief';
                                $statusBadgeClass = 'bg-success';
                            } else {
                                $statusTekst = 'Verlopen';
                                $statusBadgeClass = 'bg-danger';
                            }
                            
                            // Row styling voor verlopen codes
                            $rowClass = !$isGeldig && $now > $geldigTot ? 'text-muted' : '';
                            ?>
                            <tr class="<?= $rowClass ?>">
                                <td class="align-middle">
                                    <strong><?= htmlspecialchars($naam) ?></strong>
                                    <?php if ($isGeldig): ?>
                                        <br>
                                        <small class="text-success">
                                            <i class="bi bi-check-circle-fill"></i> Nu te gebruiken
                                        </small>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle">
                                    <?= $geldigVan->format('d-m-Y') ?>
                                </td>
                                <td class="align-middle">
                                    <?= $geldigTot->format('d-m-Y') ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if ($isEenmalig): ?>
                                        <span class="badge bg-warning text-dark">
                                            Eenmalig
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-info">
                                            Meervoudig
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge <?= $statusBadgeClass ?>">
                                        <?= $statusTekst ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Info sectie -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">ℹ️ Hoe werken actiecodes?</h5>
                    <ul class="mb-0">
                        <li><strong>Actief:</strong> Deze actiecodes kunnen nu worden gebruikt bij het afrekenen.</li>
                        <li><strong>Binnenkort:</strong> Deze actiecodes worden binnenkort actief.</li>
                        <li><strong>Verlopen:</strong> Deze actiecodes zijn niet meer geldig.</li>
                        <li><strong>Eenmalig:</strong> Deze actiecodes kunnen maar 1 keer gebruikt worden.</li>
                        <li><strong>Meervoudig:</strong> Deze actiecodes kunnen meerdere keren gebruikt worden.</li>
                        <li>Actiecodes geven <strong>10% korting</strong> op uw gehele bestelling.</li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>
