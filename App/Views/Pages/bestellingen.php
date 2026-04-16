<!-- bestellingen.php - Bestellingsoverzicht van de ingelogde klant -->

<?php
global $baseUrl;

// Defensive programming: check of bestellingen is gezet
$bestellingen = $bestellingen ?? [];
?>

<main class="container my-5">
    <div class="bestellingen-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="bestelHead">Mijn Bestellingen</h1>
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

        <?php if (empty($bestellingen)): ?>
            <!-- Geen bestellingen -->
            <div class="card text-center py-5">
                <div class="card-body">
                    <h3 class="text-muted mb-3">📦 Nog geen bestellingen</h3>
                    <p class="text-muted mb-4">
                        U heeft nog geen bestellingen geplaatst.<br>
                        Begin met winkelen en ontdek onze producten!
                    </p>
                    <a href="?action=home" class="btn btn-primary">
                        Naar de shop
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Bestellingen tabel -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light bestelHead">
                        <tr>
                            <th class="bestelHead">Bestelnummer</th>
                            <th>Datum</th>
                            <th>Status</th>
                            <th class="text-end">Totaalbedrag</th>
                            <th class="text-center">Artikelen</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bestellingen as $bestelData): ?>
                            <?php
                            $bestelling = $bestelData['bestelling'];
                            $bestelId = $bestelling->getBestelId();
                            $besteldatum = $bestelling->getBesteldatum();
                            $statusNaam = $bestelData['statusNaam'];
                            $totaalbedrag = $bestelData['totaalbedrag'];
                            $aantalArtikelen = $bestelData['aantalArtikelen'];
                            
                            // Status badge kleur bepalen
                            $statusBadgeClass = match ($statusNaam) {
                                'Lopend' => 'bg-warning text-dark',
                                'Betaald' => 'bg-success',
                                'Verzonden' => 'bg-info',
                                'Geleverd' => 'bg-primary',
                                'Geannuleerd' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                            ?>
                            <tr>
                                <td class="align-middle">
                                    <strong>#<?= htmlspecialchars((string)$bestelId) ?></strong>
                                </td>
                                <td class="align-middle">
                                    <?= $besteldatum ? $besteldatum->format('d-m-Y') : 'Onbekend' ?>
                                    <br>
                                    <small class="text-muted">
                                        <?= $besteldatum ? $besteldatum->format('H:i') : '' ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <span class="badge <?= $statusBadgeClass ?>">
                                        <?= htmlspecialchars($statusNaam) ?>
                                    </span>
                                </td>
                                <td class="align-middle text-end">
                                    <strong>&euro; <?= number_format($totaalbedrag, 2, ',', '.') ?></strong>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge bg-light text-dark">
                                        <?= $aantalArtikelen ?> artikel<?= $aantalArtikelen !== 1 ? 'en' : '' ?>
                                    </span>
                                </td>
                                <td class="align-middle text-end">
                                    <button 
                                        class="btn btn-sm btn-outline-primary"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#details-<?= $bestelId ?>"
                                        aria-expanded="false"
                                    >
                                        Details
                                    </button>
                                </td>
                            </tr>
                            <!-- Uitklapbare details rij -->
                            <tr class="collapse" id="details-<?= $bestelId ?>">
                                <td colspan="6" class="bg-light">
                                    <div class="p-3">
                                        <h6 class="mb-3">Bestelde artikelen:</h6>
                                        <table class="table table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Artikel</th>
                                                    <th class="text-center">Aantal</th>
                                                    <th class="text-end">Prijs</th>
                                                    <th class="text-end">Subtotaal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($bestelData['artikelen'] as $artikel): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($artikel['naam']) ?></td>
                                                        <td class="text-center"><?= $artikel['aantal'] ?>x</td>
                                                        <td class="text-end">&euro; <?= number_format($artikel['prijs'], 2, ',', '.') ?></td>
                                                        <td class="text-end">&euro; <?= number_format($artikel['subtotaal'], 2, ',', '.') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot class="border-top">
                                                <tr>
                                                    <th colspan="3" class="text-end">Totaal:</th>
                                                    <th class="text-end">&euro; <?= number_format($totaalbedrag, 2, ',', '.') ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <p class="small MijnBes">
                    <strong>Tip:</strong> Klik op "Details" om de bestelde artikelen te bekijken.
                </p>
            </div>
        <?php endif; ?>
    </div>
</main>
