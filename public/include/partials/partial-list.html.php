<?php

// This file displays products in a list view.

?><ul class="products">
    <? foreach ($products as $product) {
        ?><li>
            <a href="<?= BASE_URL .  'shirts/' . $product["sku"] . '/' ?>">
            <img src="<?= BASE_URL . $product["img"] . '" alt="' . $product["name"] ?>">
            <p>View Details</p></a>
        </li><?
    } ?>
</ul>