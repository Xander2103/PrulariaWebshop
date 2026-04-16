<!--loginLayout.php-->
<!--Een sub layout gebruikt voor login.php-->

<?php
require_once __DIR__ . '/../../../bootstrap.php';
?>

<main class="d-grid p-1">
    <div class="row">
        <div class="col">
            <!--        Content-->
            <div class="col-12 col-md">
                <div class="w-100">
                    <div class="col justify-content-center align-items-center">
                        <?php
                        if (!empty($content)) {
                            include $content;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
</main>