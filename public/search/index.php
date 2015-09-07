<? require_once '../include/config.php';

$searchTerm = isset($_GET['s']) ? trim($_GET['s']) : '';
$products = '';

if ($searchTerm) {
    require_once ROOT_PATH . 'include/products.php';
    $products = getProductsSearch($searchTerm);
}

$pageTitle = 'Search';
$section = 'search';

include ROOT_PATH . 'include/header.php'; ?>

    <div class="section shirts search page">
        <div class="wrapper">
            <h1><?= $pageTitle ?></h1>

            <form method="get" action="">
                <input type="search" name="s" value="<?= $searchTerm ? htmlspecialchars($searchTerm) : '' ?>">
                <input type="submit" value="Go">
            </form>

            <? if ($searchTerm) {
                if ($products) { ?>
                    <ul class="products">
                        <?= getShirtsListHtml($products) ?>
                    </ul>
                <? } else { ?>
                    <p>No products were found</p>
                <? }
            } ?>

        </div>
    </div>

<? include ROOT_PATH . 'include/footer.php'; ?>