<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 05.11.18
 * Time: 18:57
 */
session_start();
$save_data = json_decode(file_get_contents("products/products.json"), true);
$orders = "";
$total_value = 0;
foreach ($_SESSION['items'] as $key => $value) {
    $orders .= "Artikel: " . $value['name'] . '<br>';
    $orders .= "Anzahl: " . $value['amount'] . '<br>';
    $orders .= "Preis: " . $value['price'] * $value['amount'] . '<br>';
    $orders .= "<hr/>";
    $total_value += $value['price'] * $value['amount'];
}


$to = $_POST['email'];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = 'To: ' . $_POST['surname'] . ' <' . $_POST['email'] . '>';
$headers[] = 'From: Order Reminder <no-reply@muellersofladen.com>';
$headers[] = 'Cc: ' . $save_data['email'];
$message = '
<html>
<head>
  <title>Ihre Bestellung bei Müller\'s Hofladen.</title>
</head>
<body>
    ' . $orders . "<br/><hr/><br/>" . "Total: " . $total_value . '
</body>
</html>
';
mail($to, "Ihre Bestellung bei Müller's Hofladen.", $message, implode("\r\n", $headers));

session_destroy();

header("Location: index.php" . $_POST['source']);