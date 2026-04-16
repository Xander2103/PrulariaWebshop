<?php

declare(strict_types=1);

use App\Services\WishlistService;

$wishlistService = new WishlistService();
$gebruikersAccountId = $_SESSION["gebruiker"]["gebruikersAccountId"] ?? null;

if ($gebruikersAccountId !== null) {
    $aantalWishlistItems = $wishlistService->countWishlistItems((int) $gebruikersAccountId);
} else {
    $aantalWishlistItems = count($wishlistService->getGastWishlistArtikelIds());
}
?>

<?php if ($aantalWishlistItems > 0): ?>
    <span class="buttonNav-badge">
        <?= htmlspecialchars((string) $aantalWishlistItems); ?>
    </span>
<?php endif; ?>