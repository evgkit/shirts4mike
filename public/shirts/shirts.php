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

$offset = (($currentPage - 1) * $productsPerPage);

$products = getProductsSubset($offset, $productsPerPage);

$pageTitle = 'Mike\'s Full Catalog of Shirts';
$section = 'shirts';

include ROOT_PATH . 'include/header.php';

?>

<div class="section shirts page">
    <div class="wrapper">

        <h1>Mike&rsquo;s Full Catalog of Shirts</h1>

        <? include ROOT_PATH . 'include/partials/partial-pagination.html.php'; ?>

        <? include ROOT_PATH . 'include/partials/partial-list.html.php'; ?>

        <? include ROOT_PATH . 'include/partials/partial-pagination.html.php'; ?>

    </div>
</div>

<? include ROOT_PATH . 'include/footer.php'; ?>