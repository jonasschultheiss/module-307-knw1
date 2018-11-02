<?php
$data = file_get_contents("products/products.json");
$products = json_decode($data, true);

echo print_r($products);