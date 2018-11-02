<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 02.11.18
 * Time: 13:22
 */
echo print_r($_POST);
if (isset($_POST['user_id'])) {
    $save_data = json_decode(file_get_contents("products/products.json"), true);
    foreach ($save_data as $x => $x_value) {
        if ($x === 'orders') {
            foreach ($x_value as $user => $user_values) {
                if ($user_values['user_id'] === $_POST['user_id']) {
                    foreach ($user_values['orders'] as $s => $s_value) {
                        if (isset($save_data['orders'][$user]['orders'][$s]['name'])) {
                            if ($save_data['orders'][$user]['orders'][$s]['name'])
                            break;
                        } else {
                            array_push($save_data['orders'][$user]['orders'], array(
                                "name" => $_POST['name'],
                                "price" => $_POST['price'],
                                "amount" => $_POST['amount']));
                        }
                    }
                }
            }
        }
    }
    file_put_contents("products/products.json", json_encode($save_data));
}

// header("Location: ../produkte_fleisch_rind.php");