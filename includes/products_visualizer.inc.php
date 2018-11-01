<?php
$data = file_get_contents("products/products.json");
$products = json_decode($data, true);


foreach ($products as $x => $x_value) {
	if ($x === "products") {
		foreach ($x_value as $product => $product_value) {
			if ($product_value["category"] === $category) {
				echo $product_value["name"] . "<br />";
				echo '<div class="shopartikel">';
				echo '<img src="' . $product_value['image'] . '" class="shoppic"/>';
				echo '<h2>' . $product_value['name'] . '</h2>';
				echo '<p>' . $product_value['description'] .'</p>';
				echo '<p>CHF ' . $product_value['price'] . '</p>';
				echo '</div>';
			}
		}
	}
}