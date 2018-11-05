<?php
session_start();
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 02.11.18
 * Time: 13:22
 */
$DoesItemExist = false;
foreach ($_SESSION['items'] as $key => $value) {
    if ($_POST['name'] === $value['name']) {
        $_SESSION['items'][$key]['amount'] += $_POST['amount'];
        $DoesItemExist = true;
    }
}

if (!$DoesItemExist) {
    array_push($_SESSION['items'], array(
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'amount' => $_POST['amount']
    ));
}
print_r($_SESSION);

header("Location: ../" . $_POST['source']);