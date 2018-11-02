<?php
$data = file_get_contents("products/products.json");
$products = json_decode($data, true);
$lines = "";

foreach ($products as $x => $x_value) {
    if ($x === "products") {
        foreach ($x_value as $product => $product_value) {
            if ($product_value["category"] === $category) {
                echo $product_value["name"] . "<br />";
                echo '<div class="shopartikel">';
                echo '<img src="' . $product_value['image'] . '" class="shoppic"/>';
                echo '<h2>' . $product_value['name'] . '</h2>';
                echo '<p>' . $product_value['description'] . '</p>';
                echo '<p>CHF ' . $product_value['price'] . '</p>';
                echo '<form action="../shopping_cart_adder.php" method="post">';
                echo '<input style="margin-right: 5px;" type="number" name="amount" value="1" min="1" max="10">';
                echo '<input type="hidden" name="name" value=' . $product_value['name'] . '>';
                echo '<input type="hidden" name="price" value=' . $product_value['price'] . '>';
                echo '<input type="hidden" name="user_id" value=' . $_SESSION['id'] . '>';
                echo '<button style="width: 300px; height: 25px; background-color: orange;" type="submit">Dem Einkaufswagen hinzufügen</button>';
                echo '</form>';
                echo '</div>';
            }
        }
    }
}