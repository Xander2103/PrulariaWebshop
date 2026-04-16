<?php
use App\Services\CategorieService;
use App\Models\DAOs\CategorieDAO;
use App\Services\ArtikelService;
use App\Models\DAOs\ArtikelDAO;


require_once __DIR__ . '/../../../bootstrap.php';

$categorieDAO = new CategorieDAO();
$categorieService = new CategorieService($categorieDAO);

$categorieBoom = $categorieService->haalCategorieBoomOp();

$artikelDAO = new ArtikelDAO();
$artikelService = new ArtikelService();
$limit = 20;
$offset = isset($_GET['offset']) ? max(0, (int) $_GET['offset']) : 0;
$artikelen = $artikelService->haalAlleArtikelenOp($limit, $offset);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Prularia Webshop - Categorieën</title>
    <!-- Voeg Bootstrap CSS toe -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
    <link rel="stylesheet" href="/App/Views/Assets/styles.css">
</head>

<body>
    
    <div class="container">

        <h1>Welkom bij Prularia Webshop</h1>
        <div style="display: flex; gap: 2rem; align-items: flex-start;">
            <aside style="flex: 0 0 250px;">
                <?php include_once __DIR__ . '/../Components/CategorieComponent.php'; ?>
            </aside>
            <main style="flex: 1;">
                <?php include_once __DIR__ . '/../Components/ProductOverzichtComponent.php'; ?>

                <div class="mt-5">
                    <?php include_once __DIR__ . '/../Components/LoginForm.php'; ?>
                </div>
            </main>
        </div>
    </div>
    <section>
 
        <?php include_once __DIR__ . '/../Components/CategorieComponent.php'; ?>
    </section>
</body>

</html>