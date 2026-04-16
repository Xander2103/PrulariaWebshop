<?php
$deelbareLink = null;

if (isset($gebruikersAccountId) && $gebruikersAccountId !== null) {
    $deelbareLink =
        (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http')
        . '://'
        . $_SERVER['HTTP_HOST']
        . $_SERVER['PHP_SELF']
        . '?action=wishlist&gebruikersAccountId='
        . $gebruikersAccountId;
} else {
    $gastArtikelIds = $_SESSION["wishlist"] ?? [];

    if (is_array($gastArtikelIds) && !empty($gastArtikelIds)) {
        $deelbareLink =
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http')
            . '://'
            . $_SERVER['HTTP_HOST']
            . $_SERVER['PHP_SELF']
            . '?action=wishlist&gastWishlist='
            . implode(',', array_map('intval', $gastArtikelIds));
    }
}
?>

<?php if ($deelbareLink !== null): ?>
    <div class="wishlist-share-box">
        <span class="wishlist-share-label">Deelbare link</span>

        <div class="wishlist-share-controls">
            <input
                id="wishlist-share-link"
                class="wishlist-share-input"
                type="text"
                readonly
                value="<?= htmlspecialchars($deelbareLink); ?>"
            >

            <button
                type="button"
                class="wishlist-share-button"
                onclick="navigator.clipboard.writeText(document.getElementById('wishlist-share-link').value)"
            >
                Kopieer link
            </button>
        </div>
    </div>
<?php endif; ?>