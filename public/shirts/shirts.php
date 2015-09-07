<?php
require_once '../include/config.php';

$pageTitle = 'Mike\'s Full Catalog of Shirts';
$section = 'shirts';

include ROOT_PATH . 'include/header.php';
include_once ROOT_PATH . 'include/products.php';
?>

<div class="section shirts page">
    <div class="wrapper">

        <h1>Mike&rsquo;s Full Catalog of Shirts</h1>

        <ul class="products">
            <?= get_shirts_list_html($products) ?>
        </ul>

    </div>
</div>

<? include ROOT_PATH . 'include/footer.php'; ?>