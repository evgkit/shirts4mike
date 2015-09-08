<?php

$config = [];

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=shirts4mike;port=8889',
        'root',
        '1'
    );

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("SET NAMES 'utf8'");

    $results = $db->query(
        "SELECT name, price FROM products ORDER BY sku ASC"
    );

} catch (\Exception $e) {
    echo $e->getMessage();
    exit();
}