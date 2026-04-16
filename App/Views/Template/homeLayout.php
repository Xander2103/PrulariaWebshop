<!--homeLayout.php-->
<!--Een sub layout gebruikt voor home.php en productDetail.php-->

<?php
use App\Services\CategorieService;
use App\Models\DAOs\CategorieDAO;

require_once __DIR__ . '/../../../bootstrap.php';

$categorieDAO = new CategorieDAO();
$categorieService = new CategorieService($categorieDAO);

$categorieBoom = $categorieService->haalCategorieBoomOp();

// Categorieen kunnen 1 keer uitgelezen worden.
// Maar we hebben 2 verschillende tekenpaletten die deze dienen uit te lezen. (desktop en mobile)
// Buffer de categorieen vanuit de originele variabele zodat deze op zowel desktop als mobile getoond kunnen worden.
ob_start();
include __DIR__ . '/../Components/CategorieComponent.php';
$categorieHtml = ob_get_clean();
?>
<main class="d-grid p-1">
    <div class="row align-items-start mx-0">

        <!--categorie sidebar-->
        <div class="col-auto " style="width: 300px;">
            <!--            Desktop sidebar -->
            <aside class="d-none d-md-block p-3 categorieen">
                <h2 class="mb-3">Categorieën</h2>
                <?= $categorieHtml ?>
            </aside>

            <!--            Mobile categorie sidebar (OffCanvas) -->
            <div class="offcanvas offcanvas-start categorieen" tabIndex="-1" id="offcanvasCategorieen"
                aria-labelledby="offcanvasCategorieenLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasCategorieenLabel">Categorieën</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?= $categorieHtml ?>
                </div>
            </div>
        </div>

        <!--        Content-->
        <div class="col-12 col-md">
            <div class="w-100">
                <div class="col justify-content-center align-items-center">
                    <?php
                    if (!empty($content)) {
                        include $content;
                    }
                    include __DIR__ . '/../Components/LoginForm.php';
                    ?>

                </div>
            </div>
        </div>
</main>