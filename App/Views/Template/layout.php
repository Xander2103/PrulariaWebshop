<!--Layout.php-->
<!--Een root layout gebruikt in home.php, productDetail.php, winkelmandje.php-->

<?php global $baseUrl; ?>

<!doctype html>
<html lang="nl-BE">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
    <!-- dyslexic font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/open-dyslexic@1.0.3/open-dyslexic-regular.css">

    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/contact.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/productdetail.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/index.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/categorieen.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/artikelen.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/winkelmandje.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/infopagina.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/wishlist.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/registratie.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/bestellingen.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/theme-hoogcontrast.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/theme-leesvriendelijk.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/Public/css/toegankelijkheid.css">

    <!-- Toevoegen keuze schermweergave -->
    <script type="module" src="<?= $baseUrl ?>/Public/Js/toegankelijkheid.js"></script>
    <script type="module" src="<?= $baseUrl ?>/Public/Js/filtersHome.js"></script>
    <script type="module" src="<?= $baseUrl ?>/Public/Js/sorteerOp.js"></script>
    <script type="module" src="<?= $baseUrl ?>/Public/Js/resetPrijs.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prularia</title>
</head>
<body>

<div class="container-fluid p-0 d-grid">
    <div class="row me-0 pe-0">
        <div class="col me-0 pe-0">
            <?php require __DIR__ . '/../Components/header.php'; ?>

            <!-- Flash Messages (Error & Success) -->
            <?php if (isset($error) && null !== $error): ?>
                <div class="container mt-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($success) && null !== $success): ?>
                <div class="container mt-3">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($success) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            if (!empty($subLayout)) {
                include $subLayout;
            }
            ?>

            <?php require __DIR__ . '/../Components/footer.php'; ?>
        </div>
    </div>
</div>
</body>
</html>