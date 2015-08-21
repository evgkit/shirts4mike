<?
$pageTitle = 'Mike\'s Full Catalog of Shirts';
$section = 'shirts';

include 'include/header.php';
include 'include/products.php';
?>

<div class="section shirts page">
    <div class="wrapper">

        <h1>Mike&rsquo;s Full Catalog of Shirts</h1>

        <ul class="products">
            <? foreach($products as $product_id => $product) {
                ?><li>
                    <a href="shirt.php?id=<?= $product_id ?>">
                        <img src="<?= $product["img"] ?>" alt="<?= $product["name"] ?>">
                        <p>View Details</p></a>
                </li><?
            } ?>
        </ul>

    </div>
</div>

<? include 'include/footer.php'; ?>