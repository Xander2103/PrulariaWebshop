<section class="wishlist-page">
    <div class="wishlist-container">

        <div class="wishlist-header">
            <h1 class="wishlist-title">Mijn wishlist</h1>

            <div class="wishlist-header-actions">
                <?php require __DIR__ . '/../Components/WishlistDeelbareLinkComponent.php'; ?>

                <form method="post" action="?action=clearWishlist" class="wishlist-clear-form">
                    <button type="submit" class="wishlist-clear-button">
                        Clear all
                    </button>
                </form>
            </div>
        </div>

        <?php require __DIR__ . '/../Components/WishlistOverzichtComponent.php'; ?>

    </div>
</section>