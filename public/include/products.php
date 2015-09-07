<?php
require_once 'config.php';

/**
 * Returns product data by id
 * @param $product_id
 * @return bool
 */
function getProduct($product_id) {
    try {
        $product_id = (int) $product_id;

        if (!$product_id) {
          throw new Exception('Invalid product_id.');
        }

        $products = getProducts();

        foreach ($products as $product) {
            if ($product_id == $product['sku']) {
                return $product;
            }
        }

        throw new Exception('Product has not been found.');
    } catch (\Exception $e) {
        return false;
    }
}

/**
 * Renders all products or part of them
 * @param bool|false $last
 * @param bool|false $products
 * @return string
 */
function getShirtsListHtml($products = false, $last = false) {
    $html = '';

    $products = $products ?: getProducts();

    if (0 < (int) $last) {
        $products = array_slice($products, 0, $last, true);
    }

    foreach ($products as $product) {
        $html .=
            '<li>
                <a href="' . BASE_URL .  'shirts/' . $product["sku"] . '/">
                <img src="' . BASE_URL . $product["img"] . '" alt="' . $product["name"] . '">
                <p>View Details</p></a>
            </li>'
        ;
    }

    return $html;
}

/**
 * Returns products by search term
 * @param $searchTerm
 * @return array
 */
function getProductsSearch($searchTerm) {
    $results = [];
    $products = getProducts();

    foreach ($products as $product) {
        if (
            false !== stripos($product['name'], $searchTerm) ||
            false !== stripos($product['sku'], $searchTerm)
        ) {
            $results[] = $product;
        }
    }
    return $results;
}

/**
 * Returns all products data
 * @return array
 */
function getProducts() {
    $products = [];
    require ROOT_PATH . 'include/products_data.php';

    foreach ($products as $product_id => $product) {
        $products[$product_id]['sku'] = $product_id;
    }

    $products = array_reverse($products);

    return $products;
}

/**
 * Return products count
 * @return int
 */
function getProductsCount() {
    return count(getProducts());
}

