<main class="container my-5">
    <div class="text-center mb-5">
        <div class="display-1 text-success mb-3">&#10003;</div>
        <h1 class="mb-2">Bedankt voor uw bestelling!</h1>
        <?php if ($orderId): ?>
            <p class="fs-5">Uw bestelling met referentie <strong>#<?= htmlspecialchars((string)$orderId) ?></strong> is succesvol geplaatst.</p>
        <?php endif; ?>
        <?php if ($leverdatum): ?>
            <p class="text-muted bedanktBestelling">Verwachte leverdatum: <strong><?= $leverdatum->format('d/m/Y') ?></strong></p>
        <?php endif; ?>
    </div>

    <?php if (!empty($bestellijnDetails)): ?>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Overzicht bestelling</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Aantal</th>
                                <th class="text-end">Subtotaal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bestellijnDetails as $detail): ?>
                            <?php $artikel = $detail['artikel']; $lijn = $detail['lijn']; ?>
                            <tr>
                                <td><?= htmlspecialchars($artikel ? $artikel->getNaam() : 'Onbekend') ?></td>
                                <td class="text-center"><?= $lijn->getAantalBesteld() ?></td>
                                <td class="text-end">&euro; <?= number_format(($artikel ? $artikel->getPrijs() : 0) * $lijn->getAantalBesteld(), 2, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <?php if ($bestelling && $bestelling->isActiecodeGebruikt()): ?>
                            <tr class="text-danger">
                                <td colspan="2">Korting (10% actiecode)</td>
                                <td class="text-end">- 10%</td>
                            </tr>
                            <?php endif; ?>
                            <tr class="fw-bold">
                                <td colspan="2">Totaal</td>
                                <td class="text-end">&euro; <?= number_format($totaalPrijs, 2, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="text-center mt-3">
        <a href="index.php?action=home" class="btn btn-lg btn-checkout">Terug naar homepage</a>
    </div>
</main>
