<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 02.11.18
 * Time: 11:07
 */

session_start();

foreach ($_SESSION['items'] as $key => $value) {
    if ($value['name'] === $_POST['item']) {
        if ($value['amount'] > 1) {
            $_SESSION['items'][$key]['amount'] -= 1;
        } else {
            unset($_SESSION['items'][$key]);
        }
    }
}

header("Location: shopping_cart.php");