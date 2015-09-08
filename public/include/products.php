<?php
require_once 'config.php';

/**
 * Returns all products data
 * @return array
 */
function getProducts() {
    require ROOT_PATH . 'include/database.php';

    /* @var $db */
    try {
        $results = $db->query('
          SELECT *
          FROM products
          ORDER BY sku ASC
        ');

        $products = $results->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo 'Data could not be retrieved from database';
        exit();
    }

    return array_reverse($products);
}

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
        $result = $db->prepare(
            'SELECT * FROM products WHERE sku = :sku'
        );
        $result->bindParam('sku', $product_id);
        $result->execute();

        if (!$product = $result->fetch(PDO::FETCH_ASSOC)) {
            throw new Exception('Product has been not found.');
        }

        $result = $db->prepare('
            SELECT size
            FROM products_sizes ps
            INNER JOIN sizes s ON ps.size_id = s.id
            WHERE product_sku = :sku
            ORDER BY `order`
        ');
        $result->bindParam('sku', $product_id);
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $product['sizes'][] = $row['size'];
        };

        return $product;
    } catch (\Exception $e) {
        return false;
    }
}

/**
 * Returns recent products
 * @param int $limit
 * @return string
 */
function getRecentProducts($limit) {
    require ROOT_PATH . 'include/database.php';

    /* @var $db */
    try {
        $limit = (int) $limit;
        if (!$limit) {
            throw new \Exception('Invalid function argument.');
        }

        $result = $db->prepare('
          SELECT *
          FROM products
          ORDER BY sku DESC
          LIMIT :limit
        ');
        $result->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo 'Data could not be retrieved from database';
        exit();
    }
}

/**
 * Returns products by search term
 * @param $searchTerm
 * @return array
 */
function getProductsSearch($searchTerm) {
    require ROOT_PATH . 'include/database.php';

    /* @var $db */
    try {
        $result = $db->prepare("
          SELECT *
          FROM products
          WHERE name LIKE :term OR sku LIKE :term
          ORDER BY sku DESC
        ");
        $result->bindValue(':term', '%' . $searchTerm . '%');
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo 'Data could not be retrieved from database';
        exit();
    }
}

/**
 * Returns products count
 * @return int
 */
function getProductsCount() {
    require ROOT_PATH . 'include/database.php';

    /* @var $db */
    try {
        $result = $db->prepare('
          SELECT COUNT(sku)
          FROM products
          ORDER BY sku ASC
        ');
        $result->execute();

        return $result->fetchColumn(0);
    } catch (\Exception $e) {
        echo 'Data could not be retrieved from database';
        exit();
    }
}

/**
 * Returns subset of products for pagination
 * @param $offset
 * @param $length
 * @return array
 */
function getProductsSubset($offset, $length) {
    require ROOT_PATH . 'include/database.php';

    /* @var $db */
    try {
        $result = $db->prepare('
          SELECT *
          FROM products
          ORDER BY sku DESC
          LIMIT :offset, :length
        ');
        $result->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $result->bindValue(':length', (int) $length, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo 'Data could not be retrieved from database';
        exit();
    }
}

