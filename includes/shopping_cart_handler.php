<?php
$save_data = json_decode(file_get_contents("products/products.json"), true);
foreach ($save_data as $x => $x_value) {
if ($x === "orders") {
foreach ($x_value as $user => $user_values) {
if ($_SESSION['id'] === $user_values['user_id']) {
foreach ($user_values['orders'] as $key => $value) {
    $total_value += $value['amount'] * $value['price'];
    $rows .= '<tr>';
    $rows .= '<td style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray;">' . $value['name'] . '</td>';
    $rows .= '<td style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray;">' . $value['amount'] . '</td>';
    $rows .= '<td style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray;">' . $value['amount'] * $value['price'] . '</td>';
    $rows .= '<td> <form action="../shopping_cart_remover.php" method="post"><input type="hidden" name="item" value=' . $value['name'] . '><input type="hidden" name="id" value=' . $_SESSION['id'] . '><button style="width: 300px; height: 25px; background-color: lightcoral;" type="submit">Entfernen</button></form></td>';
    $rows .= '<tr>';
}
?>

<div style="width: 905px; border: 1px solid #FFFFFF; border-radius: 5px; padding: 20px;">
    <h2>Artikel</h2>
        <table style="border-collapse: collapse; width: 100%;">
            <tr>
                <th style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray; text-align: left;">Artikel</th>
                <th style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray; text-align: left;">Anzahl</th>
                <th style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray; text-align: left;">Preis</th>
                <th style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray; text-align: left;">Artikel entfernen</th>
            </tr>
            <?php echo $rows;
            ?>
        </table>
    <?php
    echo "Total: " . $total_value . "CHF";
    ?>
        <br/>
        <br/>
        <hr/>
        <br/>
        <h2>Post details</h2>
        <form action="" method="post">
            <p>Anrede</p>
            <label>
                <select style="width: 300px; height: 25px" name="anrede">
                    <option value="Herr">Herr</option>
                    <option value="Frau">Frau</option>
                </select>
            </label>
            <br/>
            <br/>
            <p>Vorname*</p>
            <label>
                <input style="width: 300px; height: 25px" type="text" name="surname" value="" required>
            </label>
            <br/>
            <br/>
            <p>Nachname*</p>
            <label>
                <input style="width: 300px; height: 25px" type="text" name="name" value="" required>
            </label>
            <br/>
            <br/>
            <p>Geburtstag</p>
            <label>
                <input style="width: 300px; height: 25px" type="date" name="birthday" value="">
            </label>
            <br/>
            <br/>
            <p>Strasse*</p>
            <label>
                <input style="width: 300px; height: 25px" type="text" name="street" value="" required>
            </label>
            <br/>
            <br/>
            <p>Postleitzahl*</p>
            <label>
                <input style="width: 300px; height: 25px" type="text" name="plz" value="" required>
            </label>
            <br/>
            <br/>
            <p>Ort*</p>
            <label>
                <input style="width: 300px; height: 25px" type="text" name="place" value="" required>
            </label>
            <br/>
            <br/>
            <p>E-Mail*</p>
            <label>
                <input style="width: 300px; height: 25px" type="text" name="email" value="" required>
            </label>
            <br/>
            <br/>
            <p>(Mit Stern (*) markierte Felder müssen ausgefüllt werden.)</p>
            <br/>
            <hr/>
            <br/>
            <h2>Währungsrechner</h2>
            <?php
            echo "<p>CHF: " . $total_value . "<p/>";
            foreach ($save_data as $x => $x_value) {
                if ($x === "currency") {
                    foreach ($x_value as $currency => $currency_value) {
                        echo "<p>" . $currency . ": " . $currency_value * $total_value . "</p>";
                    }
                }
            }
            ?>
            <br/>
            <hr/>
            <br/>
            <button style="width: 300px; height: 50px; background-color: orange; font-size: 20px;" type="submit">
                Bestellung abgeben
            </button>
        </form>
        <?php
        break;
        } else {
            echo "<h2>Dein Einkaufswagen ist leer.<h2/>";
            break;
        }
        }
        }
        }
        ?>
</div>