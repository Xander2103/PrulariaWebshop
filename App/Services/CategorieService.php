<?php
namespace App\Services;

use App\Models\DAOs\CategorieDAO;

class CategorieService
{
    private CategorieDAO $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO)
    {
        $this->categorieDAO = $categorieDAO;
    }

    public function haalCategorieBoomOp(): ?array
    {
        $hoofdCategorieen = $this->categorieDAO->findHoofdCategorieen();        

        if ($hoofdCategorieen === null) {
            return null;
        }

        foreach ($hoofdCategorieen as $hoofdCategorie) {
            $subcategorieen = $this->haalSubcategorieenRecursief($hoofdCategorie->getCategorieId());
            $hoofdCategorie->setSubcategorieen($subcategorieen);
        }

        return $hoofdCategorieen;
    }

    /**
     * Haalt recursief alle subcategorieën (en hun subcategorieën) op.
     */
    private function haalSubcategorieenRecursief(int $parentId): array
    {
        $subcategorieen = $this->categorieDAO->findSubcategorieen($parentId);
        
        if ($subcategorieen === null) {
            return [];
        }

        foreach ($subcategorieen as $subcategorie) {
            // Zoek verder naar nog diepere niveaus
            $diepereSubcategorieen = $this->haalSubcategorieenRecursief($subcategorie->getCategorieId());
            $subcategorie->setSubcategorieen($diepereSubcategorieen);
        }

        return $subcategorieen;
    }
}
