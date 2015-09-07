<?php
require_once '../include/config.php';
require_once ROOT_PATH . 'include/products.php';

$productsPerPage = 8;
$totalProducts = getProductsCount();
$totalPages = (int) ceil($totalProducts / $productsPerPage);

$currentPage = (int) $_GET['page'] ?: 1;
$currentPage = $totalPages < $currentPage ? $totalPages : $currentPage;

if ($currentPage != (int) $_GET['page'] ) {
    header('Location: ./?page=' . $currentPage);
}

$subset['start'] = (($currentPage - 1) * $productsPerPage) + 1;
$subset['end'] = $currentPage * $productsPerPage < $totalProducts ?
    $currentPage * $productsPerPage : $totalProducts;

var_dump($_GET['page'], $totalProducts, $totalPages, $currentPage, $subset['start'], $subset['end']);

$pageTitle = 'Mike\'s Full Catalog of Shirts';
$section = 'shirts';

include ROOT_PATH . 'include/header.php';

?>

<div class="section shirts page">
    <div class="wrapper">

        <h1>Mike&rsquo;s Full Catalog of Shirts</h1>

        <ul class="products">
            <?= getShirtsListHtml() ?>
        </ul>

    </div>
</div>

<? include ROOT_PATH . 'include/footer.php'; ?>