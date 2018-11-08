<?php
if (count($_SESSION['items']) === 0) {
    echo "<h2>Dein Einkaufswagen ist leer.</h2>";
} else {
    foreach ($_SESSION['items'] as $key => $value) {
        $total_value += $value['amount'] * $value['price'];
        $rows .= '<tr>';
        $rows .= '<td style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray;">' . $value['name'] . '</td>';
        $rows .= '<td style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray;">' . $value['amount'] . '</td>';
        $rows .= '<td style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray;">' . "CHF " . number_format((float)($value['amount'] * $value['price']), 2, '.', '') . '</td>';
        $rows .= '<td> <form action="../shopping_cart_remover.php" method="post"><input type="hidden" name="item" value="' . $value['name'] . '""><button style="width: 300px; height: 25px; background-color: lightcoral;" type="submit">Artikel entfernen</button></form></td>';
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
                <th style="padding: 8px 8px 8px 0; border-bottom: 1px solid gray; text-align: left;">Artikel entfernen
                </th>
            </tr>
            <?php echo $rows; ?>
        </table>
        <?php echo "Total: CHF " . number_format((float)$total_value, 2, '.', ''); ?>
        <br/>
        <br/>
        <hr/>
        <br/>
        <h2>Adresse</h2>
        <form action="../done.php" method="post">
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
            <h2>Versand</h2>
            <label>
                <input type="radio" name="versand" value="normal" required>
            </label> B Post (+ CHF 5.00)<br>
            <label>
                <input type="radio" name="versand" value="priority" required>
            </label> A Post(+ CHF 10.00)<br>
            <label>
                <input type="radio" name="versand" value="pickup" required>
            </label> Abholung<br>
            <br/>
            <hr/>
            <br/>
            <h2>Währungsrechner</h2>
            <?php
            echo "<p>CHF: " . number_format((float)$total_value, 2, '.', '') . "</p>";
            $save_data = json_decode(file_get_contents("products/products.json"), true);
            foreach ($save_data as $x => $x_value) {
                if ($x === "currency") {
                    foreach ($x_value as $currency => $currency_value) {
                        echo "<p>" . $currency . ": " . number_format((float)($currency_value * $total_value), 2, '.', '') . "</p>";
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
    </div>
    <?php
}
?>