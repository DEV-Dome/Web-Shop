<?php
session_start();

include "../../acp/php/sql/Sql.php";

if(!isset($_SESSION['login'])){
    echo "Du musst eingeloggt seinen, um deinen Account verwalten zu können.";
    exit();
}

?>
<table>
    <thead>
    <tr>
        <th>Bestellnummer Nummer</th>
        <th>Gesamt Preis</th>
        <th>Sendenummer</th>
        <th>Alle Artikel Anzeige</th>
        <th>Rechung</th>
    </tr>
    </thead>
    <tbody id="such_output">
    <?php
    foreach ($pdo->query("SELECT * FROM bestellungen WHERE user = ". $_SESSION['id']) as $row) {
        $preis = 0;

        foreach ($pdo->query("SELECT * FROM warenkorb_arikel_syc WHERE bestellungesid  = ". $row['ID']) as $row1) {
            foreach ($pdo->query("SELECT * FROM artikel WHERE artikelnr = ". $row1['artikel'] . " LIMIT 1") as $row2) {
                $preis += ($row2["preis"] * $row1["menge"]);
            }
        }

        $sendeverfolgung = $row['sendeverfolung'];
        if($sendeverfolgung == "") $sendeverfolgung = "Es wurde noch keine sendeverfolung angeben.";

        echo "<tr><td>".$row['ID']."</td><td>$preis €</td><td>".$sendeverfolgung."</td><td>
              <a class=\"waves-effect waves-light btn-small green  \" onclick='loadSubPageAccount(\"pages/user/Bestellung/Bestellung.php?id=". $row1["bestellungesid"] ."\")'><i class=\"material-icons left\">border_color</i>Alle Artikel</a></td>;
              <td><a class=\"waves-effect waves-light btn-small green  \" onclick=''><i class=\"material-icons left\">border_color</i>Rechung</a></td>";
    }

    ?>
    </tbody>
</table>
