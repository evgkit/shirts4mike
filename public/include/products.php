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

        require ROOT_PATH . 'include/database.php';

        /* @var $db */
        $result = $db->prepare('SELECT * FROM products WHERE sku = :sku');
        $result->bindParam('sku', $product_id);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);

    } catch (\Exception $e) {
        return false;
    }
}

/**
 * Returns all products or part of them
 * @param bool|false $last
 * @param bool|false $products
 * @return string
 */
function getProductsList($products = false, $last = false) {
    $products = $products ?: getProducts();

    if (0 < (int) $last) {
        $products = array_slice($products, 0, $last, true);
    }

    return $products;
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
    require ROOT_PATH . 'include/database.php';

    /* @var $db */
    try {
        $results = $db->query(
            "SELECT * FROM products ORDER BY sku ASC"
        );

        $products = $results->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo 'Data could not be retrieved from database';
        exit();
    }

    $products = array_reverse($products);

    return $products;
}

/**
 * Returns products count
 * @return int
 */
function getProductsCount() {
    return count(getProducts());
}

/**
 * Returns subset of products for pagination
 * @param $offset
 * @param $length
 * @return array
 */
function getProductsSubset($offset, $length) {
    return array_slice(getProducts(), $offset, $length, true);
}

