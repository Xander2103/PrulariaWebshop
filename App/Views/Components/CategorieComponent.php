<?php
// Verwacht variabele $categorieBoom: de array met (hoofd)categorieën en hun subcategorieën.

if (!isset($categorieBoom) || empty($categorieBoom)) {
    ?>
    <p>Geen categorieën gevonden.</p>
    <?php
    return;
}

function heeftActieveCategorie($categorie, $actieveId)
{
    if ($categorie->getCategorieId() == $actieveId) {
        return true;
    }

    $subcategorieen = $categorie->getSubcategorieen();
    if ($subcategorieen) {
        foreach ($subcategorieen as $sub) {
            if (heeftActieveCategorie($sub, $actieveId)) {
                return true;
            }
        }
    }
    return false;
}

//functie om subcategorieen te filteren
function renderCategorieBoom($categorieen)
{
    global $baseUrl;

    // Toevoegen keuze schermweergave

    if (empty($categorieen)) {
        return '';
    }

    $html = '<ul class="categorie-lijst">';
    foreach ($categorieen as $cat) {

        $html .= '<li class="my-1 py-2 px-3">';
        $subcategorieen = $cat->getSubcategorieen();
        if (!empty($subcategorieen)) {
            $isOpen = heeftActieveCategorie($cat, $_GET['categorieId'] ?? null);

            $html .= '<details class="mb-3"' . ($isOpen ? ' open' : '') . '>';
            $html .= '<summary class="py-3 px-3">' . htmlspecialchars($cat->getNaam()) . ($cat->getAantalArtikelen() > 0 ? ' <span class="badge bg-secondary ms-1">'.$cat->getAantalArtikelen().'</span>' : '') . '</summary>';
            $html .= renderCategorieBoom($subcategorieen);
            $html .= '</details>';
        } else {
            $isActive = ($cat->getCategorieId() == ($_GET['categorieId'] ?? null));

            $html .= '<a class="' . ($isActive ? 'actief' : '') . '" href="'
                    . $baseUrl . '/?action=home&categorieId=' . urlencode((string)$cat->getCategorieId()) . '">';
            $html .= htmlspecialchars($cat->getNaam()) . ($cat->getAantalArtikelen() > 0 ? ' <span class="badge bg-light text-dark ms-1">'.$cat->getAantalArtikelen().'</span>' : '');
            $html .= '</a>';
        }
        $html .= '</li>';
    }

    $html .= '</ul>';
    return $html;
}
?>

<div class="categorie-boom-component categorieen">
    <!-- Toevoegen keuze schermweergave -->
    <!--    Filter de hoofdcategorieen-->
    <?php
    $hoofdCategorieen = array_filter($categorieBoom, function ($cat) {
        return $cat->isHoofdCategorie();
    });

    foreach ($hoofdCategorieen as $hoofd) {
        $isOpen = heeftActieveCategorie($hoofd, $_GET['categorieId'] ?? null);

        echo '<details class="mb-3"' . ($isOpen ? ' open' : '') . '>';
        echo '<summary class="py-3 px-3">' . htmlspecialchars($hoofd->getNaam()) . ($hoofd->getAantalArtikelen() > 0 ? ' <span class="badge bg-secondary ms-1">'.$hoofd->getAantalArtikelen().'</span>' : '') . '</summary>';
        echo renderCategorieBoom($hoofd->getSubcategorieen());
        echo '</details>';
    }?>
</div>