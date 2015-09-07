<?php
require_once '../include/config.php';

require_once ROOT_PATH . 'include/products.php';

$product = isset($_GET['id']) ? getProduct($_GET['id']) : '';

if (!$product) {
    header('Location: ' . BASE_URL . 'shirts.php');
    exit();
}

$section = 'shirts';
$pageTitle = $product['name'];

include ROOT_PATH . 'include/header.php'; ?>

    <div class="section page">
        <div class="wrapper">
            <div class="breadcrumb"><a href="<?= BASE_URL ?>shirts/">Shirts</a> &gt; <?= $product["name"] ?></div>

            <div class="shirt-picture">
                <span>
                    <img src="<?= BASE_URL . $product["img"] ?>" alt="<?= $product["name"] ?>">
                </span>
            </div>

            <div class="shirt-details">
                <h1><span class="price">$<?= $product["price"] ?></span> <?= $product["name"] ?></h1>

                <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="<?= $product["paypal"] ?>">
                    <input type="hidden" name="item_name" value="<?= $product["name"] ?>">
                    <table>
                        <tr>
                            <th>
                                <input type="hidden" name="on0" value="Size">
                                <label for="os0">Size</label>
                            </th>
                            <td>
                                <select name="os0" id="os0">
                                    <? foreach ($product["sizes"] as $size) { ?>
                                        <option value="<?= $size ?>"><?= $size ?></option>
                                    <? } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Add to Cart" name="submit">
                </form>

                <p class="note-designer">* All shirts are designed by Mike the Frog.</p>
            </div>
        </div>
    </div>

<? include ROOT_PATH . 'include/footer.php'; ?>