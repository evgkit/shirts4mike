<?php
require_once 'config.php';

/**
 * Рендерит список свежих товаров
 * @param bool|false $last
 * @return string
 */
function getShirtsListHtml($last = false) {
    $html = '';

    $products = getProducts();
    $products = array_reverse($products);

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
 * Даёт все товары
 * @return array
 */
function getProducts() {
    $products = [];
    $products[101] = [
        "name" => "Logo Shirt, Red",
        "img" => "img/shirts/shirt-101.jpg",
        "price" => 18,
        "paypal" => "9P7DLECFD4LKE",
        "sizes" => [ "Small","Medium","Large","X-Large" ]
    ];
    $products[102] = [
        "name" => "Mike the Frog Shirt, Black",
        "img" => "img/shirts/shirt-102.jpg",
        "price" => 20,
        "paypal" => "SXKPTHN2EES3J",
        "sizes" => [ "Small","Medium","Large","X-Large" ]
    ];
    $products[103] = [
        "name" => "Mike the Frog Shirt, Blue",
        "img" => "img/shirts/shirt-103.jpg",
        "price" => 20,
        "paypal" => "7T8LK5WXT5Q9J",
        "sizes" => [ "Small","Medium","Large","X-Large" ]
    ];
    $products[104] = [
        "name" => "Logo Shirt, Green",
        "img" => "img/shirts/shirt-104.jpg",
        "price" => 18,
        "paypal" => "YKVL5F87E8PCS",
        "sizes" => [ "Small","Medium","Large","X-Large" ]
    ];
    $products[105] = [
        "name" => "Mike the Frog Shirt, Yellow",
        "img" => "img/shirts/shirt-105.jpg",
        "price" => 25,
        "paypal" => "4CLP2SCVYM288",
        "sizes" => [ "Small","Medium","Large","X-Large" ]
    ];
    $products[106] = [
        "name" => "Logo Shirt, Gray",
        "img" => "img/shirts/shirt-106.jpg",
        "price" => 20,
        "paypal" => "TNAZ2RGYYJ396",
        "sizes" => [ "Small","Medium","Large","X-Large" ]
    ];
    $products[107] = [
        "name" => "Logo Shirt, Teal",
        "img" => "img/shirts/shirt-107.jpg",
        "price" => 20,
        "paypal" => "S5FMPJN6Y2C32",
        "sizes" => [ "Small","Medium","Large","X-Large" ]
    ];
    $products[108] = [
        "name" => "Mike the Frog Shirt, Orange",
        "img" => "img/shirts/shirt-108.jpg",
        "price" => 25,
        "paypal" => "JMFK7P7VEHS44",
        "sizes" => [ "Large","X-Large" ]
    ];

    foreach($products as $product_id => $product) {
        $products[$product_id]['sku'] = $product_id;
    }

    return $products;
}

