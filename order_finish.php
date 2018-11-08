<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 05.11.18
 * Time: 18:57
 */
session_start();


if (isset($_SESSION['items'])) {
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
    switch ($_POST['versand']) {
        case 'priority':
            {
                $total_value += 10;
                break;
            }
        case 'normal':
            {
                $total_value += 5;
                break;
            }
    }
    $lines = "";
    $lines .= "<h2>Danke für Ihre Bestellung.</h2>";
    $lines .= "<h3>Ihre Bestellung</h3>";
    $lines .= $orders;
    $lines .= "<h3>Versandart</h3>";
    $lines .= $_POST['versand'];
    $lines .= "<h3>Total</h3>";
    $lines .= "CHF: " . number_format((float)$total_value, 2, '.', '');
    $lines .= "<br />";
    $lines .= "<p>Zusätzlich erhalten Sie eine Bestätiguns email.</p>";

    echo $lines;
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
    foreach ($save_data as $key => $value) {
        if ($key === "orders") {
            array_push($save_data[$key], array(
                "Name" => $_POST['name'],
                "Surname" => $_POST['surname'],
                "Birthday" => $_POST['birthday'],
                "Strasse" => $_POST['street'],
                "Postleitzahl" => $_POST['plz'],
                "Ort" => $_POST['place'],
                "Email" => $_POST['email'],
                "Versand" => $_POST['versand'],
                "Total" => $total_value,
                "Bestellung" => $_SESSION['items']
            ));
        }
    }
    file_put_contents("products/products.json", json_encode($save_data));
    session_destroy();
} else {
    header("Location: index.php");
}