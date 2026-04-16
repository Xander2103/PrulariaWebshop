<?php
// Verwachte variabelen (vanuit ProductController):
// $artikel           — Artikel|null
// $reviews           — KlantReview[]|null
// $gemiddeldeScore   — float
// $aantalReviews     — int
// $kanReviewen       — bool
// $heeftGekocht      — bool
// $heeftAlGereviewed — bool
// $gebruiker         — array|null (sessiedata)

$artikelIdStr = htmlspecialchars((string) ($artikel?->getArtikelId() ?? 0));
$isIngelogd   = ($gebruiker !== null);
$voornaam     = htmlspecialchars($gebruiker['voornaam'] ?? '');
?>

<style>
/* CSS-only sterrenrating (Bootstrap ondersteunt dit niet) */
.star-rating { display: flex; flex-direction: row-reverse; gap: 4px; width: fit-content; }
.star-rating__input { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); }
.star-rating__label { font-size: 2rem; color: #adb5bd; cursor: pointer; line-height: 1; transition: color .1s; }
.star-rating__label:hover,
.star-rating__label:hover ~ .star-rating__label,
.star-rating__input:checked ~ .star-rating__label { color: #ffc107; }
</style>

<div class="product-detail-page">
<section class="mt-4 pt-4 border-top" id="reviews" aria-label="Klantreviews">
    <h2 class="h4 fw-bold mb-3">Klantreviews</h2>

    <?php if (isset($error) && $error !== null): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success) && $success !== null): ?>
        <div class="alert alert-success" role="status">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <!-- Gemiddelde score -->
    <div class="d-flex align-items-center gap-2 mb-4" aria-label="Gemiddelde beoordeling">
        <?php if ($aantalReviews > 0): ?>
            <span class="fs-2 fw-bold text-success lh-1">
                <?= number_format($gemiddeldeScore, 1, ',', '') ?>
            </span>
            <span aria-hidden="true">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span class="fs-5<?= $i <= round($gemiddeldeScore) ? ' text-warning' : ' text-secondary' ?>">&#9733;</span>
                <?php endfor; ?>
            </span>
            <span class=" small">
                (<?= $aantalReviews ?> <?= $aantalReviews === 1 ? 'review' : 'reviews' ?>)
            </span>
        <?php else: ?>
            <span class=" fst-italic">Nog geen beoordelingen</span>
        <?php endif; ?>
    </div>

    <!-- Lijst van reviews -->
    <div class="d-flex flex-column gap-3 mb-4">
        <?php if (empty($reviews)): ?>
            <p class=" fst-italic">Wees de eerste om dit product te beoordelen!</p>
        <?php else: ?>
            <?php foreach ($reviews as $review): ?>
                <article class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                            <span class="fw-bold">
                                <?= htmlspecialchars($review->getNickname()) ?>
                            </span>
                            <span aria-label="Score: <?= $review->getScore() ?> van 5">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="<?= $i <= $review->getScore() ? 'text-warning' : 'text-secondary' ?>" aria-hidden="true">&#9733;</span>
                                <?php endfor; ?>
                            </span>
                            <?php if ($review->getDatum() !== null): ?>
                                <time class="ms-auto text-muted small" datetime="<?= $review->getDatum()->format('Y-m-d') ?>">
                                    <?= $review->getDatum()->format('d/m/Y') ?>
                                </time>
                            <?php endif; ?>
                        </div>
                        <?php if ($review->getCommentaar() !== null): ?>
                            <p class="card-text mb-0">
                                <?= htmlspecialchars($review->getCommentaar()) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Review formulier sectie -->
    <div class="border-top pt-4">
        <?php if (!$isIngelogd): ?>
            <p class="">
                <a href="index.php?action=loginformulier" class="fw-semibold">Log in</a> om een review te plaatsen.
            </p>

        <?php elseif ($heeftAlGereviewed): ?>
            <p class="text-success fst-italic">
                U heeft dit product al beoordeeld. Dank u voor uw feedback!
            </p>

        <?php elseif (!$heeftGekocht): ?>
            <p class="text-muted">
                Alleen klanten die dit product hebben aangekocht, kunnen een review plaatsen.
            </p>

        <?php else: ?>
            <h3 class="h5 fw-bold mb-3">Schrijf uw review</h3>

            <form method="post" action="index.php?action=nieuwereview" class="d-flex flex-column gap-3" style="max-width: 560px;" novalidate>
                <input type="hidden" name="artikelId" value="<?= $artikelIdStr ?>">

                <div>
                    <label for="review-nickname" class="form-label fw-semibold">Nickname</label>
                    <input
                        type="text"
                        id="review-nickname"
                        name="nickname"
                        class="form-control"
                        value="<?= $voornaam ?>"
                        maxlength="45"
                        required
                        aria-required="true"
                    >
                </div>

                <fieldset class="border-0 p-0 m-0">
                    <legend class="form-label fw-semibold">
                        Beoordeling <span aria-hidden="true">*</span>
                    </legend>
                    <div class="star-rating" role="group" aria-label="Kies een score van 1 tot 5 sterren">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input
                                type="radio"
                                id="star<?= $i ?>"
                                name="score"
                                value="<?= $i ?>"
                                class="star-rating__input"
                                required
                                aria-label="<?= $i ?> <?= $i === 1 ? 'ster' : 'sterren' ?>"
                            >
                            <label for="star<?= $i ?>" class="star-rating__label" aria-hidden="true" title="<?= $i ?> <?= $i === 1 ? 'ster' : 'sterren' ?>">&#9733;</label>
                        <?php endfor; ?>
                    </div>
                </fieldset>

                <div>
                    <label for="review-commentaar" class="form-label fw-semibold">
                        Commentaar <span class="fw-normal text-muted small">(optioneel)</span>
                    </label>
                    <textarea
                        id="review-commentaar"
                        name="commentaar"
                        class="form-control"
                        maxlength="255"
                        rows="4"
                        placeholder="Deel uw ervaring met dit product..."
                    ></textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        Review plaatsen
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>
</div>
