<?php
session_start();

include "../../../acp/php/sql/Sql.php";

if(!isset($_SESSION['login'])){
    echo "Du musst eingeloggt seinen, um deinen Account verwalten zu können.";
    exit();
}

$pid =  $_GET["id"];
?>
<center><h4>Bestellung: <?php echo $pid?></h4></center>
<br/>
<br/>

<table>
    <thead>
    <tr>
        <th>Produckt-Name</th>
        <th>Stückzahl</th>
        <th>Einahmen</th>
        <th>Gesamter Einahmen</th>
    </tr>
    </thead>
    <tbody id="searchOutput">
    <?php
    foreach ($pdo->query("SELECT * FROM warenkorb_arikel_syc WHERE bestellungesid = ". $pid) as $row) {
    foreach ($pdo->query("SELECT * FROM artikel WHERE artikelnr  = " . $row["artikel"]) as $row1) {
            echo "<tr><td>". $row1['name'] ." </td><td>". $row["menge"] ." </td><td>". $row1['preis'] ." </td><td>".  $row["menge"] * $row1['preis']." </td>";
        }

    }

    ?>
    </tbody>