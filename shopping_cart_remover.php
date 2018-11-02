<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 02.11.18
 * Time: 11:07
 */

if (isset($_POST['item'])) {
    $save_data = json_decode(file_get_contents("products/products.json"), true);
    foreach ($save_data as $x => $x_value) {
        if ($x === 'orders') {
            foreach ($x_value as $user => $user_values) {
                if ($user_values['user_id'] === $_POST['id']) {
                    foreach ($user_values['orders'] as $y => $y_values) {
                        if ($y_values['name'] === $_POST['item']) {
                            if ($y_values['amount'] > 1) {
                                $save_data[$x][$user]['orders'][$y]['amount']--;
                                break;
                            } else if ($y_values['amount'] == 1) {
                                unset($save_data[$x][$user]['orders'][$y]);

                            }
                            file_put_contents("products/products.json", json_encode($save_data));
                            break;
                        }
                    }
                }
            }
        }
    }
}

header("Location: shopping_cart.php");